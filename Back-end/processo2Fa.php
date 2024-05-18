<?php
session_start();
ob_start();  // Inicia o buffer de saída para capturar qualquer saída precoce.

// Configura cabeçalhos apenas para respostas JSON.
header('Content-Type: application/json');

require __DIR__ . '/../Front-end/PHP/connect.php';

// Verifica se o método de requisição é POST para processar o formulário.
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  echo json_encode(['success' => false, 'message' => 'Método de requisição inválido.']);
  exit;
}

// Verifica se o usuário está logado e se a pergunta de segurança está definida.
if (!isset($_SESSION['usuario_id'], $_SESSION['security_question'])) {
  echo json_encode(['success' => false, 'message' => 'Sessão expirada. Por favor, faça login novamente.']);
  ob_end_flush(); // Envio e limpeza do buffer.
  exit;
}

$respostaUsuario = $_POST['resposta'] ?? '';
if (empty($respostaUsuario)) {
  echo json_encode(['success' => false, 'message' => 'A resposta deve ser preenchida.']);
  exit;
}

$respostaEsperada = getExpectedAnswer($pdo, $_SESSION['usuario_id'], $_SESSION['security_question']);

if ($respostaUsuario === $respostaEsperada) {
  // Registrar a pergunta secreta usada e respondida pelo usuário
  if (registrarPerguntaSecreta($pdo, $_SESSION['usuario_id'], $_SESSION['security_question'], $respostaUsuario)) {
    // Registrar login no histórico e em arquivo
    if (registrarLogin($pdo, $_SESSION['usuario_id'], $_SESSION['security_question'])) {
      registrarLogArquivo($_SESSION['usuario_id'], $_SESSION['usuario_nome'], $_SESSION['security_question']);
      echo json_encode([
        'success' => true,
        'message' => 'Resposta correta. Acesso concedido.',
        'userType' => $_SESSION['usuario_tipo']
      ]);
    } else {
      echo json_encode([
        'success' => false,
        'message' => 'Falha ao registrar o login no histórico.'
      ]);
    }
  } else {
    echo json_encode([
      'success' => false,
      'message' => 'Falha ao registrar a pergunta secreta.'
    ]);
  }
} else {
  handleIncorrectAnswer();
}

// Função para obter a resposta esperada com base na pergunta de segurança.
function getExpectedAnswer($pdo, $userId, $question)
{
  $query = match ($question) {
    "Qual o nome da sua mãe?" => "SELECT nome_materno FROM usuario WHERE idUsuario = ?",
    "Qual a data do seu nascimento?" => "SELECT data_nascimento FROM usuario WHERE idUsuario = ?",
    "Qual o CEP do seu endereço?" => "SELECT cep FROM endereco_completo WHERE idUsuario = ?",
    default => null
  };

  if ($query) {
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
  }
  return null; // Em caso de pergunta desconhecida.
}

// Função para registrar a pergunta secreta.
function registrarPerguntaSecreta($pdo, $userId, $pergunta, $resposta)
{
  $insertQuery = "INSERT INTO pergunta_secreta (pergunta, resposta, id_usuario) VALUES (?, ?, ?)";
  $insertStmt = $pdo->prepare($insertQuery);
  if ($insertStmt->execute([$pergunta, $resposta, $userId])) {
    return true;
  } else {
    error_log("Erro ao inserir a pergunta secreta no banco de dados: " . json_encode($insertStmt->errorInfo()));
    return false;
  }
}

// Função para registrar o login no histórico.
function registrarLogin($pdo, $userId, $question)
{
  $horarioLogin = date('Y-m-d H:i:s');

  // Obter o id da pergunta secreta
  $stmt = $pdo->prepare("SELECT id FROM pergunta_secreta WHERE id_usuario = ? AND pergunta = ?");
  if (!$stmt->execute([$userId, $question])) {
    error_log("Erro ao executar consulta para obter id_pergunta_secreta: " . json_encode($stmt->errorInfo()));
    return false;
  }
  $id_pergunta_secreta = $stmt->fetchColumn();

  if ($id_pergunta_secreta) {
    $insertQuery = "INSERT INTO historico_login (horarioLogin, id_usuario, id_pergunta_secreta) VALUES (?, ?, ?)";
    $insertStmt = $pdo->prepare($insertQuery);
    if ($insertStmt->execute([$horarioLogin, $userId, $id_pergunta_secreta])) {
      return true;
    } else {
      error_log("Erro ao inserir no banco de dados: " . json_encode($insertStmt->errorInfo()));
    }
  } else {
    error_log("Erro ao obter id_pergunta_secreta: " . json_encode($stmt->errorInfo()));
  }
  return false;
}

// Função para registrar o login em um arquivo de log.
function registrarLogArquivo($userId, $username, $securityQuestion)
{
  $horarioLogin = date('Y-m-d H:i:s');
  $logEntry = "Usuário ID: $userId, Nome de Usuário: $username, Horário de Login: $horarioLogin, Pergunta Secreta: $securityQuestion\n";

  // Verificar e criar o diretório de logs se não existir
  $logDir = __DIR__ . '/../logs';
  if (!is_dir($logDir)) {
    mkdir($logDir, 0777, true);
  }

  $logFile = fopen($logDir . '/historico_login.log', 'a'); // Caminho para o arquivo de log
  if ($logFile) {
    fwrite($logFile, $logEntry);
    fclose($logFile);
  } else {
    // Tratar erro caso o arquivo de log não possa ser aberto
    error_log("Falha ao abrir o arquivo de log.");
  }
}

// Função para lidar com respostas incorretas.
function handleIncorrectAnswer()
{
  $_SESSION['attempts'] = ($_SESSION['attempts'] ?? 0) + 1;
  if ($_SESSION['attempts'] >= 3) {
    session_destroy();
    echo json_encode([
      'success' => false,
      'message' => '3 tentativas sem sucesso! Favor realizar Login novamente.',
      'attemptsFailed' => true
    ]);
  } else {
    echo json_encode([
      'success' => false,
      'message' => 'Resposta incorreta.'
    ]);
  }
}
?>

<?php
session_start();
ob_start();  // Inicia o buffer de saída para capturar qualquer saída precoce.

// Configura cabeçalhos apenas para respostas JSON.
header('Content-Type: application/json');

require __DIR__ . '/../Front-end/PHP/connect.php';

// Definir o fuso horário para garantir que o horário seja registrado corretamente
date_default_timezone_set('America/Sao_Paulo');


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

// Ajuste para permitir respostas de data no formato dd/mm/yyyy ou dd-mm-yyyy
if ($_SESSION['security_question'] === "Qual a data do seu nascimento?" && !empty($respostaUsuario)) {
  $respostaUsuario = str_replace('/', '-', $respostaUsuario);
  $respostaUsuario = date('Y-m-d', strtotime($respostaUsuario));
}

if (strcasecmp($respostaUsuario, $respostaEsperada) === 0) {
  // Completa a autenticação e define 'usuario_tipo'
  $_SESSION['usuario_tipo'] = $_SESSION['pre_auth_tipo'];
  unset($_SESSION['pre_auth']);
  unset($_SESSION['pre_auth_tipo']);

  // Registrar a pergunta secreta usada e respondida pelo usuário
  $id_pergunta_secreta = registrarPerguntaSecreta($pdo, $_SESSION['usuario_id'], $_SESSION['security_question'], $respostaUsuario);
  if ($id_pergunta_secreta) {
    // Registrar login no histórico e em arquivo
    if (registrarLogin($pdo, $_SESSION['usuario_id'], $id_pergunta_secreta)) {
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
// Ajuste para permitir respostas de data no formato dd/mm/yyyy ou dd-mm-yyyy
if ($_SESSION['security_question'] === "Qual a data do seu nascimento?" && !empty($respostaUsuario)) {
  $respostaUsuario = str_replace('/', '-', $respostaUsuario);
  $respostaUsuario = date('Y-m-d', strtotime($respostaUsuario));
}

if (strcasecmp($respostaUsuario, $respostaEsperada) === 0) {
  // Completa a autenticação e define 'usuario_tipo'
  $_SESSION['usuario_tipo'] = $_SESSION['pre_auth_tipo'];
  unset($_SESSION['pre_auth']);
  unset($_SESSION['pre_auth_tipo']);

  echo json_encode([
    'success' => true,
    'message' => 'Resposta correta. Acesso concedido.',
    'userType' => $_SESSION['usuario_tipo']
  ]);
} else {
  handleIncorrectAnswer();
}

// Função para obter a resposta esperada com base na pergunta de segurança.
function getExpectedAnswer($pdo, $userId, $question)
{
  $query = match ($question) {
    "Qual o nome da sua mãe?" => "SELECT LOWER(nome_materno) FROM usuario WHERE idUsuario = ?",
    "Qual o nome da sua mãe?" => "SELECT LOWER(nome_materno) FROM usuario WHERE idUsuario = ?",
    "Qual a data do seu nascimento?" => "SELECT data_nascimento FROM usuario WHERE idUsuario = ?",
    "Qual o CEP do seu endereço?" => "SELECT cep FROM endereco_completo WHERE idUsuario = ?",
    default => null
  };

  if ($query) {
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId]);
    return strtolower($stmt->fetchColumn());
    return strtolower($stmt->fetchColumn());
  }
  return null; // Em caso de pergunta desconhecida.
}

// Função para registrar a pergunta secreta.
function registrarPerguntaSecreta($pdo, $userId, $pergunta, $resposta)
{
  // Verificar se a pergunta já está registrada
  $checkQuery = "SELECT id FROM pergunta_secreta WHERE id_usuario = ? AND pergunta = ?";
  $checkStmt = $pdo->prepare($checkQuery);
  $checkStmt->execute([$userId, $pergunta]);
  $existingId = $checkStmt->fetchColumn();

  if ($existingId) {
    // Atualizar a resposta existente
    $updateQuery = "UPDATE pergunta_secreta SET resposta = ? WHERE id = ?";
    $updateStmt = $pdo->prepare($updateQuery);
    if ($updateStmt->execute([$resposta, $existingId])) {
      return $existingId;
    } else {
      error_log("Erro ao atualizar a resposta da pergunta secreta no banco de dados: " . json_encode($updateStmt->errorInfo()));
      return false;
    }
  } else {
    // Inserir uma nova pergunta secreta
    $insertQuery = "INSERT INTO pergunta_secreta (pergunta, resposta, id_usuario) VALUES (?, ?, ?)";
    $insertStmt = $pdo->prepare($insertQuery);
    if ($insertStmt->execute([$pergunta, $resposta, $userId])) {
      return $pdo->lastInsertId();
    } else {
      error_log("Erro ao inserir a pergunta secreta no banco de dados: " . json_encode($insertStmt->errorInfo()));
      return false;
    }
  }
}

// Função para registrar o login no histórico.
function registrarLogin($pdo, $userId, $id_pergunta_secreta)
{
  $horarioLogin = date('Y-m-d H:i:s');

  $insertQuery = "INSERT INTO historico_login (horarioLogin, id_usuario, id_pergunta_secreta) VALUES (?, ?, ?)";
  $insertStmt = $pdo->prepare($insertQuery);
  if ($insertStmt->execute([$horarioLogin, $userId, $id_pergunta_secreta])) {
    return true;
  } else {
    error_log("Erro ao inserir no banco de dados: " . json_encode($insertStmt->errorInfo()));
    return false;
  }
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

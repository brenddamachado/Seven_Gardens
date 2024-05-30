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
    "Qual a data do seu nascimento?" => "SELECT data_nascimento FROM usuario WHERE idUsuario = ?",
    "Qual o CEP do seu endereço?" => "SELECT cep FROM endereco_completo WHERE idUsuario = ?",
    default => null
  };

  if ($query) {
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId]);
    return strtolower($stmt->fetchColumn());
  }
  return null; // Em caso de pergunta desconhecida.
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

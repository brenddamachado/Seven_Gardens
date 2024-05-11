<?php
session_start();
require '../Front-end/PHP/connect.php';  // Certifique-se de ajustar o caminho conforme necessário

if (!isset($_SESSION['usuario_id'], $_SESSION['security_question'])) {
  echo json_encode(['success' => false, 'message' => 'Sessão expirada. Por favor, faça login novamente.']);
  exit;
}

$respostaUsuario = $_POST['resposta'] ?? '';
$usuarioId = $_SESSION['usuario_id'];
$question = $_SESSION['security_question'];

if (empty($respostaUsuario)) {
  echo json_encode(['success' => false, 'message' => 'A resposta deve ser preenchida.']);
  exit;
}

try {
  $respostaEsperada = '';
  if ($question === "Qual o nome da sua mãe?") {
    $stmt = $pdo->prepare("SELECT nome_materno FROM usuario WHERE idUsuario = ?");
    $stmt->execute([$usuarioId]);
    $respostaEsperada = $stmt->fetchColumn();
  } elseif ($question === "Qual a data do seu nascimento?") {
    $stmt = $pdo->prepare("SELECT data_nascimento FROM usuario WHERE idUsuario = ?");
    $stmt->execute([$usuarioId]);
    $respostaEsperada = $stmt->fetchColumn();
  } elseif ($question === "Qual o CEP do seu endereço?") {
    $stmt = $pdo->prepare("SELECT cep FROM endereco_completo WHERE idUsuario = ?");
    $stmt->execute([$usuarioId]);
    $respostaEsperada = $stmt->fetchColumn();
  }

  if ($respostaUsuario === $respostaEsperada) {
    echo json_encode(['success' => true, 'message' => 'Resposta correta. Acesso concedido.']);
  } else {
    $_SESSION['attempts'] = ($_SESSION['attempts'] ?? 0) + 1;
    if ($_SESSION['attempts'] >= 3) {
      session_destroy();
      echo json_encode(['success' => false, 'message' => '3 tentativas sem sucesso! Favor realizar Login novamente.', 'attemptsFailed' => true]);
    } else {
      echo json_encode(['success' => false, 'message' => 'Resposta incorreta.']);
    }
  }
} catch (PDOException $e) {
  echo json_encode(['success' => false, 'message' => 'Erro no servidor: ' . $e->getMessage()]);
}

<?php
session_start();
require '../Front-end/PHP/connect.php';  // Ajuste este caminho conforme necessário

$username = $_POST['userName'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
  echo json_encode(['success' => false, 'message' => 'Nome de usuário e senha são obrigatórios.']);
  exit;
}

try {
  // Prepare a statement for finding the user
  $stmt = $pdo->prepare("SELECT idUsuario, nome_completo, senha, tipo_usuario FROM usuario WHERE user_name = ? AND ativado = 1");
  $stmt->execute([$username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Registro de tentativa de login
  $tentativaSQL = "INSERT INTO tentativas_login (data_tentativa, id_usuario) VALUES (NOW(), ?)";
  $tentativaStmt = $pdo->prepare($tentativaSQL);

  if ($user) {
    $tentativaStmt->execute([$user['idUsuario']]); // Registra a tentativa com o ID do usuário

    // Verifica se a senha está correta
    if (password_verify($password, $user['senha'])) {
      $_SESSION['usuario_id'] = $user['idUsuario'];
      $_SESSION['usuario_nome'] = $user['nome_completo'];
      $_SESSION['usuario_tipo'] = $user['tipo_usuario'];

      // Definir a lógica para escolher a pergunta de segurança
      $questions = [
        "Qual o nome da sua mãe?",
        "Qual a data do seu nascimento?",
        "Qual o CEP do seu endereço?"
      ];
      $randomQuestion = $questions[array_rand($questions)];
      $_SESSION['security_question'] = $randomQuestion;

      echo json_encode(['success' => true, 'redirect' => '2FA.php', 'question' => $randomQuestion]);
    } else {
      echo json_encode(['success' => false, 'message' => 'Senha incorreta.']);
    }
  } else {
    $tentativaStmt->execute([null]); // Registra a tentativa sem um ID de usuário
    echo json_encode(['success' => false, 'message' => 'Usuário não encontrado ou não ativado.']);
  }
} catch (PDOException $e) {
  echo json_encode(['success' => false, 'message' => 'Erro no login: ' . $e->getMessage()]);
}

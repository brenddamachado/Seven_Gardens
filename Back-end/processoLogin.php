<?php
session_start();
require '../Front-end/PHP/connect.php';  // Conexão com o banco de dados.

$username = $_POST['userName'] ?? '';
$password = $_POST['password'] ?? '';

// Verifica se os campos de nome de usuário e senha estão preenchidos.
if (empty($username) || empty($password)) {
  echo json_encode(['success' => false, 'message' => 'Nome de usuário e senha são obrigatórios.']);
  exit;
}

try {
  // Prepara uma consulta SQL para verificar o usuário.
  $stmt = $pdo->prepare("SELECT idUsuario, nome_completo, senha, tipo_usuario FROM usuario WHERE user_name = ? AND ativado = 1");
  $stmt->execute([$username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Registro da tentativa de login.
  $tentativaSQL = "INSERT INTO tentativas_login (data_tentativa, id_usuario) VALUES (NOW(), ?)";
  $tentativaStmt = $pdo->prepare($tentativaSQL);

  if ($user) {
    $tentativaStmt->execute([$user['idUsuario']]);
    if (password_verify($password, $user['senha'])) {
      // Armazena informações na sessão, mas ainda não define 'usuario_tipo'
      $_SESSION['usuario_id'] = $user['idUsuario'];
      $_SESSION['usuario_nome'] = $user['nome_completo'];
      $_SESSION['pre_auth'] = true; // Define um indicador de pré-autenticação
      $_SESSION['pre_auth_tipo'] = $user['tipo_usuario']; // Temporariamente armazena o tipo de usuário

      $questions = ["Qual o nome da sua mãe?", "Qual a data do seu nascimento?", "Qual o CEP do seu endereço?"];
      $randomQuestion = $questions[array_rand($questions)];
      $_SESSION['security_question'] = $randomQuestion;

      echo json_encode(['success' => true, 'redirect' => '2FA.php', 'question' => $randomQuestion]);
    } else {
      echo json_encode(['success' => false, 'message' => 'Senha incorreta.']);
    }
  } else {
    $tentativaStmt->execute([null]);  // Sem ID de usuário, tentativa falhou.
    echo json_encode(['success' => false, 'message' => 'Usuário não encontrado ou não ativado.']);
  }
} catch (PDOException $e) {
  echo json_encode(['success' => false, 'message' => 'Erro no login: ' . $e->getMessage()]);
}

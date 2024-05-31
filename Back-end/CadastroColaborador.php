<?php
header('Content-Type: application/json');
require '../Front-end/PHP/connect.php';

try {
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Gere dados fictícios para o novo colaborador
  $nomeCompleto = $_POST['nome_completo'];
  $email = $_POST['email'];
  $telefoneCelular = $_POST['telefone_celular'];
  $userName = $_POST['username'];
  $senha = $_POST['password'];
  $tipoUsuario = 'Colaborador';
  $ativado = 1;

  // Hash a senha
  $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

  // Insira o novo colaborador na tabela 'usuario'
  $stmt = $pdo->prepare("INSERT INTO usuario
        (nome_completo, email, telefone_celular, user_name, senha, tipo_usuario, ativado)
        VALUES
        (:nomeCompleto, :email, :telefoneCelular, :userName, :senhaHash, :tipoUsuario, :ativado)");
  $stmt->bindParam(':nomeCompleto', $nomeCompleto);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':telefoneCelular', $telefoneCelular);
  $stmt->bindParam(':userName', $userName);
  $stmt->bindParam(':senhaHash', $senhaHash);
  $stmt->bindParam(':tipoUsuario', $tipoUsuario);
  $stmt->bindParam(':ativado', $ativado);
  $stmt->execute();

  // Obtenha o ID do novo colaborador inserido
  $idUsuario = $pdo->lastInsertId();

  // Gere dados fictícios para o endereço do novo colaborador
  $logradouro = 'Rua Fictícia';
  $numero = '123';
  $complemento = 'Apto 456';
  $bairro = 'Bairro Fictício';
  $cidade = 'Cidade Fictícia';
  $estado = 'FS';
  $cep = '54321-876';

  // Insira o endereço fictício do novo colaborador na tabela 'endereco_completo'
  $stmtEndereco = $pdo->prepare("INSERT INTO endereco_completo
        (idUsuario, logradouro, numero, complemento, bairro, cidade, estado, cep)
        VALUES
        (:idUsuario, :logradouro, :numero, :complemento, :bairro, :cidade, :estado, :cep)");
  $stmtEndereco->bindParam(':idUsuario', $idUsuario);
  $stmtEndereco->bindParam(':logradouro', $logradouro);
  $stmtEndereco->bindParam(':numero', $numero);
  $stmtEndereco->bindParam(':complemento', $complemento);
  $stmtEndereco->bindParam(':bairro', $bairro);
  $stmtEndereco->bindParam(':cidade', $cidade);
  $stmtEndereco->bindParam(':estado', $estado);
  $stmtEndereco->bindParam(':cep', $cep);
  $stmtEndereco->execute();

  echo "Novo colaborador registrado com sucesso!";
} catch (PDOException $e) {
  echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}
?>

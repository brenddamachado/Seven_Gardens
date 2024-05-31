<?php
header('Content-Type: application/json');
require '../Front-end/PHP/connect.php';

$response = array('success' => false, 'message' => '');

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nomeCompleto = $_POST['nome_completo'];
    $email = $_POST['email'];
    $telefoneCelular = $_POST['telefone_celular'];
    $userName = $_POST['username'];
    $senha = $_POST['password'];
    $logradouro = $_POST['logradouro'];
    $tipoUsuario = 'Colaborador';
    $ativado = 1;

    // Verificar se o username ou email já existe
    $stmtVerificar = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE user_name = :userName OR email = :email");
    $stmtVerificar->bindParam(':userName', $userName);
    $stmtVerificar->bindParam(':email', $email);
    $stmtVerificar->execute();
    $usuarioExistente = $stmtVerificar->fetchColumn();

    if ($usuarioExistente > 0) {
        $response['message'] = 'Nome de usuário ou e-mail já existe. Por favor, escolha outro.';
    } else {
        // Hash a senha
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // Insira o novo colaborador na tabela 'usuario'
        $stmt = $pdo->prepare("INSERT INTO usuario (nome_completo, email, telefone_celular, user_name, senha, tipo_usuario, ativado)
            VALUES (:nomeCompleto, :email, :telefoneCelular, :userName, :senhaHash, :tipoUsuario, :ativado)");
        $stmt->bindParam(':nomeCompleto', $nomeCompleto);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefoneCelular', $telefoneCelular);
        $stmt->bindParam(':userName', $userName);
        $stmt->bindParam(':senhaHash', $senhaHash);
        $stmt->bindParam(':tipoUsuario', $tipoUsuario);
        $stmt->bindParam(':ativado', $ativado);
        $stmt->execute();

        $idUsuario = $pdo->lastInsertId();

        // Insira o endereço do novo colaborador na tabela 'endereco_completo'
        $stmtEndereco = $pdo->prepare("INSERT INTO endereco_completo (idUsuario, logradouro, numero, complemento, bairro, cidade, estado, cep)
            VALUES (:idUsuario, :logradouro, '123', 'Apto 456', 'Bairro Fictício', 'Cidade Fictícia', 'FS', '54321-876')");
        $stmtEndereco->bindParam(':idUsuario', $idUsuario);
        $stmtEndereco->bindParam(':logradouro', $logradouro);
        $stmtEndereco->execute();

        $response['success'] = true;
        $response['message'] = 'Novo colaborador registrado com sucesso!';
    }
} catch (PDOException $e) {
    $response['message'] = 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
}

echo json_encode($response);
?>
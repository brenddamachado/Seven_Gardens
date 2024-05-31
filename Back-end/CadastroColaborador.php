<?php
require '../Front-end/PHP/connect.php'; // Certifique-se de ajustar o caminho conforme necessário

header('Content-Type: application/json');

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Início da transação
    $pdo->beginTransaction();

    // Captura os valores dos inputs do formulário
    $nome_completo = !empty($_POST['nome_completo']) ? $_POST['nome_completo'] : null;
    $email = !empty($_POST['email']) ? $_POST['email'] : null;
    $telefone_celular = !empty($_POST['telefone_celular']) ? $_POST['telefone_celular'] : null;
    $user_name = 'username' . rand(1000, 9999); // Pode ser ajustado para gerar um nome de usuário adequado
    $senha = password_hash('default_password', PASSWORD_DEFAULT); // Substitua por uma lógica de geração de senha adequada
    $tipo_usuario = 'Colaborador';
    $ativado = 1;

    // Dados do endereço
    $logradouro = !empty($_POST['logradouro']) ? $_POST['logradouro'] : null;
    $numero = '';
    $complemento = null;
    $bairro = '';
    $cidade = '';
    $estado = '';
    $cep = '';

    // Insere o colaborador na tabela usuario como tipo Colaborador
    $stmt = $pdo->prepare("INSERT INTO usuario (nome_completo, email, telefone_celular, user_name, senha, tipo_usuario, ativado)
                            VALUES (:nome_completo, :email, :telefone_celular, :user_name, :senha, :tipo_usuario, :ativado)");

    // Associa os parâmetros
    $stmt->bindParam(':nome_completo', $nome_completo);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone_celular', $telefone_celular);
    $stmt->bindParam(':user_name', $user_name);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':tipo_usuario', $tipo_usuario);
    $stmt->bindParam(':ativado', $ativado);

    // Executa a inserção na tabela usuario
    $stmt->execute();

    // Captura o ID do usuário inserido
    $idUsuario = $pdo->lastInsertId();

    // Insere o endereço na tabela endereco_completo
    $stmt = $pdo->prepare("INSERT INTO endereco_completo (idUsuario, logradouro, numero, complemento, bairro, cidade, estado, cep)
                            VALUES (:idUsuario, :logradouro, :numero, :complemento, :bairro, :cidade, :estado, :cep)");

    // Associa os parâmetros do endereço
    $stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->bindParam(':logradouro', $logradouro);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':complemento', $complemento);
    $stmt->bindParam(':bairro', $bairro);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':cep', $cep);

    // Executa a inserção na tabela endereco_completo
    $stmt->execute();

    // Commit da transação
    $pdo->commit();

    echo json_encode(['success' => true, 'message' => 'Novo colaborador registrado com sucesso!']);
} catch (PDOException $e) {
    // Rollback da transação em caso de erro
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Erro ao registrar o novo colaborador: ' . $e->getMessage()]);
}
?>

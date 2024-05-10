<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../Front-end/PHP/connect.php');  // Conexão com o banco de dados via PDO

    // Verifica se todas as variáveis necessárias estão definidas
    if (isset($_POST["nome_completo"], $_POST["email"], $_POST["telefone_celular"], $_POST["user_name"], $_POST["senha"])) {
        $nome_completo = $_POST["nome_completo"];
        $email = $_POST["email"];
        $telefone_celular = $_POST["telefone_celular"];
        $user_name = $_POST["user_name"];
        $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

        // Valores genéricos
        $data_nascimento = '2000-01-01';
        $sexo = 'Não Informado';
        $nome_materno = 'Não Informado';
        $cpf = '00000000000';
        $logradouro = 'Endereço Genérico';
        $numero = 0;
        $complemento = 'Não Informado';
        $bairro = 'Não Informado';
        $cidade = 'Cidade Genérica';
        $estado = 'XX';
        $cep = '00000-000';
        $tipo_usuario = 'Colaborador';
        $ativado = 1;

        // Insere na tabela `usuario`
        $sqlUsuario = "INSERT INTO usuario (nome_completo, data_nascimento, sexo, nome_materno, cpf, email, telefone_celular, user_name, senha, tipo_usuario, ativado)
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtUsuario = $pdo->prepare($sqlUsuario);

        if ($stmtUsuario->execute([$nome_completo, $data_nascimento, $sexo, $nome_materno, $cpf, $email, $telefone_celular, $user_name, $senha, $tipo_usuario, $ativado])) {
            echo json_encode(['success' => true, 'message' => 'Colaborador cadastrado com sucesso!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao cadastrar colaborador: ' . $stmtUsuario->errorInfo()[2]]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Todos os campos do formulário devem ser preenchidos.']);
    }

    // Não é necessário fechar explicitamente a conexão PDO
}

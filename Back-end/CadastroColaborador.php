<?php
header('Content-Type: application/json');  // Informa ao navegador que a resposta será em JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../Front-end/PHP/connect.php');  // Inclui e executa o arquivo, conectando ao banco de dados com PDO

    // Verifica se todas as variáveis estão definidas antes de acessá-las
    if (isset($_POST["nome_completo"], $_POST["email"], $_POST["telefone_celular"], $_POST["endereco_completo"])) {
        $nome = $_POST["nome_completo"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone_celular"];
        $endereco = $_POST["endereco_completo"];

        // Usando consultas preparadas para segurança
        $sql = "INSERT INTO funcionario (nome_completo, email, telefone_celular, endereco_completo) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        // Tenta executar a consulta
        if ($stmt->execute([$nome, $email, $telefone, $endereco])) {
            echo json_encode(['success' => true, 'message' => 'Colaborador cadastrado com sucesso!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao cadastrar colaborador: ' . $stmt->errorInfo()[2]]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Todos os campos do formulário devem ser preenchidos.']);
    }
    // Não é necessário fechar a conexão PDO explicitamente
}

<?php
require '../Front-end/PHP/connect.php'; // Certifique-se de ajustar o caminho conforme necessário

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insere o novo colaborador
    $stmt = $pdo->prepare("INSERT INTO colaboradores (nome_completo, email, telefone_celular, endereco_completo) 
                            VALUES (:nome_completo, :email, :telefone_celular, :endereco_completo)");
    
    // Define os valores dos parâmetros
    $nome_completo = 'Nome do Novo Colaborador';
    $email = 'novocolaborador@example.com';
    $telefone_celular = '1234567890';
    $endereco_completo = 'Rua Falsa, 123, Bairro Fictício';

    // Associa os parâmetros
    $stmt->bindParam(':nome_completo', $nome_completo);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone_celular', $telefone_celular);
    $stmt->bindParam(':endereco_completo', $endereco_completo);

    // Executa a inserção
    $stmt->execute();

    echo "Novo colaborador registrado com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}
?>

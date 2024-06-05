<?php
session_start();
require '../Front-end/PHP/connect.php';  // Conexão com o banco de dados.

header('Content-Type: application/json');

// Função para buscar usuários no banco de dados
function searchUsers($pdo, $keyword) {
    try {
        // Prepara a consulta SQL para encontrar usuários clientes pelo nome
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE nome_completo LIKE ? AND tipo_usuario = 'Cliente'");
        
        // Adiciona o caractere de '%' ao redor do parâmetro de busca para buscar por substrings
        $searchTerm = "%$keyword%";
        
        // Executa a consulta
        $stmt->execute([$searchTerm]);
        
        // Retorna os resultados
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ["success" => true, "users" => $users];
    } catch (PDOException $e) {
        // Trata erros de conexão ou consulta
        return ["success" => false, "message" => "Erro ao buscar usuários: " . $e->getMessage()];
    }
}

// Função para excluir usuário do banco de dados
function deleteUser($pdo, $userId) {
    try {
        // Prepara a consulta SQL
        $stmt = $pdo->prepare("DELETE FROM usuario WHERE idUsuario = ?");
        
        // Executa a consulta
        $stmt->execute([$userId]);
        
        return ["success" => true, "message" => "Usuário excluído com sucesso."];
    } catch (PDOException $e) {
        // Trata erros de conexão ou consulta
        return ["success" => false, "message" => "Erro ao excluir usuário: " . $e->getMessage()];
    }
}

// Verifica se foi feita uma busca
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['inputPesquisa'])) {
    $keyword = $_POST['inputPesquisa'];
    $usuarios = searchUsers($pdo, $keyword);
    echo json_encode($usuarios);
    exit();
}

// Verifica se foi feita uma solicitação de exclusão
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $userId = $_POST['delete_id'];
    $result = deleteUser($pdo, $userId);
    echo json_encode($result);
    exit();
}
?>

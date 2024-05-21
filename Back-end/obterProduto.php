<?php
// Verificar se o ID do produto foi fornecido
if (!isset($_GET['idProduto'])) {
    echo json_encode(['error' => 'ID do produto não fornecido']);
    exit();
}

// Incluir o arquivo de conexão com o banco de dados
$path = __DIR__ . '/../Front-end/PHP/connect.php';
if (!file_exists($path)) {
    echo json_encode(['error' => 'Arquivo de conexão não encontrado']);
    exit();
}
require $path;

// Preparar e executar a consulta para obter os detalhes do produto
$idProduto = $_GET['idProduto'];
$query = "SELECT idProduto, nome, preco, descricao, categoria, subcategoria, imagem FROM produto WHERE idProduto = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$idProduto]);

// Verificar se o produto foi encontrado
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Retornar os detalhes do produto como JSON
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Produto não encontrado']);
}
?>

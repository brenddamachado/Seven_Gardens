<?php
session_start();

$path = __DIR__ . '/../Front-end/PHP/connect.php';
if (!file_exists($path)) {
    die('Arquivo de conexão não encontrado: ' . $path);
}
require $path;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idProduto'])) {
    $idProduto = $_POST['idProduto'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $subcategoria = $_POST['subcategoria'];

    if (empty($idProduto) || empty($nome) || empty($preco) || empty($descricao) || empty($categoria) || empty($subcategoria)) {
        die('Todos os campos são obrigatórios.');
    }

    $stmt = $pdo->prepare("UPDATE produto SET nome = ?, preco = ?, descricao = ?, categoria = ?, subcategoria = ? WHERE idProduto = ?");
    $stmt->execute([$nome, $preco, $descricao, $categoria, $subcategoria, $idProduto]);

    // Redirecionar para index.php após a edição
    header('Location: /Seven_Gardens/index.php');
    exit();
} else {
    die('Método de requisição inválido.');
}
?>

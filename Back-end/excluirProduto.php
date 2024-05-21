<?php
session_start();

$path = __DIR__ . '/../Front-end/PHP/connect.php';
if (!file_exists($path)) {
    die('Arquivo de conexão não encontrado: ' . $path);
}
require $path;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idProduto'])) {
    $idProduto = $_POST['idProduto'];

    if (empty($idProduto)) {
        die('ID do produto é obrigatório.');
    }

    $stmt = $pdo->prepare("DELETE FROM produto WHERE idProduto = ?");
    $stmt->execute([$idProduto]);

    // Redirecionar para index.php após a exclusão
    header('Location: /Seven_Gardens/index.php');
    exit();
} else {
    die('Método de requisição inválido.');
}
?>

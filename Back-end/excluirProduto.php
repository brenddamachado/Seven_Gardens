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

    try {
        $pdo->beginTransaction();

        // Excluir registros da tabela estoque que estão relacionados ao produto
        $stmtEstoque = $pdo->prepare("DELETE FROM estoque WHERE idProduto = ?");
        $stmtEstoque->execute([$idProduto]);

        // Excluir o produto da tabela produto
        $stmtProduto = $pdo->prepare("DELETE FROM produto WHERE idProduto = ?");
        $stmtProduto->execute([$idProduto]);

        $pdo->commit();

        // Redirecionar para index.php após a exclusão
        header('Location: /Seven_Gardens/index.php');
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        die('Erro ao excluir produto: ' . $e->getMessage());
    }
} else {
    die('Método de requisição inválido.');
}
?>

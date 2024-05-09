<?php

include 'connect.php';

$nome = filter_input(INPUT_GET, "nome");
$preco = filter_input(INPUT_GET, "preco");
$descricao = filter_input(INPUT_GET, "descricao");
$categoria = filter_input(INPUT_GET, "categoria");
$subcategoria = filter_input(INPUT_GET, "subcategoria");

try {
    $query = $pdo->prepare("INSERT INTO produto VALUES (null, ?, ?, ?, ?, ?)");
    $query->execute([$nome, $preco, $descricao, $categoria, $subcategoria]);

    header("Location: InterfaceMaster.html");
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}

?>




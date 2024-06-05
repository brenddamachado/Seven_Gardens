<?php
require_once __DIR__ . '/../helpers/path_helper.php'; // Inclui a função base_url

if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão apenas se não estiver já iniciada
}

require_once __DIR__ . '/../Front-end/PHP/connect.php'; // Conexão com o banco de dados

// Verifica se o usuário tem permissão para editar produtos
if (!isset($_SESSION['usuario_tipo']) || !in_array($_SESSION['usuario_tipo'], ['Master', 'Colaborador'])) {
    die('Acesso negado.');
}

// Verifica se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProduto = filter_input(INPUT_POST, 'idProduto', FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING);
    $subcategoria = filter_input(INPUT_POST, 'subcategoria', FILTER_SANITIZE_STRING);

    // Validação básica dos dados
    if (empty($idProduto) || empty($nome) || empty($preco) || empty($descricao) || empty($categoria) || empty($subcategoria)) {
        die('Todos os campos são obrigatórios.');
    }

    // Lida com o upload da imagem
    $imagemProduto = '';
    if (isset($_FILES['imagemProduto']) && $_FILES['imagemProduto']['error'] === UPLOAD_ERR_OK) {
        $imagemProduto = $_FILES['imagemProduto'];
        $imagemNome = basename($imagemProduto['name']);
        $imagemTmp = $imagemProduto['tmp_name'];
        $imagemDir = __DIR__ . '/../Front-end/img-produtos/';
        $imagemCaminho = $imagemDir . $imagemNome;

        // Verifica se o diretório de destino existe, se não, cria-o
        if (!is_dir($imagemDir)) {
            mkdir($imagemDir, 0777, true);
        }

        // Move a imagem para o diretório de destino
        if (!move_uploaded_file($imagemTmp, $imagemCaminho)) {
            die('Erro ao fazer upload da imagem.');
        }

        // Caminho relativo para armazenar no banco de dados
        $imagemCaminho = 'Front-end/img-produtos/' . $imagemNome;
    }

    // Atualiza os dados do produto no banco de dados
    $query = "UPDATE produto SET nome = :nome, preco = :preco, descricao = :descricao, categoria = :categoria, subcategoria = :subcategoria";
    if (!empty($imagemCaminho)) {
        $query .= ", imagem = :imagem";
    }
    $query .= " WHERE idProduto = :idProduto";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':subcategoria', $subcategoria);
    if (!empty($imagemCaminho)) {
        $stmt->bindParam(':imagem', $imagemCaminho);
    }
    $stmt->bindParam(':idProduto', $idProduto, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: ' . base_url('index.php'));
        exit;
    } else {
        die('Erro ao atualizar o produto.');
    }
} else {
    die('Método de requisição inválido.');
}
?>

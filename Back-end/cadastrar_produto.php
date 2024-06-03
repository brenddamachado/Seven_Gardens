<?php
header('Content-Type: application/json');  // Informa ao navegador que a resposta será em JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../Front-end/PHP/connect.php');  // Inclui e executa o arquivo, conectando ao banco de dados com PDO

    // Verifica se todas as variáveis estão definidas antes de acessá-las
    if (isset($_POST["nomeProduto"], $_POST["precoProduto"], $_POST["descricaoProduto"], $_POST["categoriaProduto"], $_POST["subcategoriaProduto"], $_FILES["imagemProduto"], $_POST["quantidadeProduto"])) {
        $nome = $_POST["nomeProduto"];
        $preco = $_POST["precoProduto"];
        $descricao = $_POST["descricaoProduto"];
        $categoria = $_POST["categoriaProduto"];
        $subcategoria = $_POST["subcategoriaProduto"];
        $quantidade = $_POST["quantidadeProduto"];

        // Diretório onde as imagens serão armazenadas
        $diretorio = "C:/xampp/htdocs/Seven_Gardens/Front-end/img-produtos/";

        // Informações do arquivo enviado
        $nomeArquivo = basename($_FILES["imagemProduto"]["name"]); // basename para evitar path traversal
        $caminhoTemporario = $_FILES["imagemProduto"]["tmp_name"];
        $caminhoFinal = $diretorio . $nomeArquivo;

        // Caminho relativo para uso na web
        $caminhoWeb = "Front-end/img-produtos/" . $nomeArquivo;

        // Move o arquivo para o diretório desejado
        if (move_uploaded_file($caminhoTemporario, $caminhoFinal)) {
            // Usando consultas preparadas para segurança
            $sql = "INSERT INTO produto (nome, preco, descricao, categoria, subcategoria, imagem) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);

            // Tenta executar a consulta
            if ($stmt->execute([$nome, $preco, $descricao, $categoria, $subcategoria, $caminhoWeb])) {
                $produtoId = $pdo->lastInsertId();

                // Inserir a quantidade na tabela estoque
                $sqlEstoque = "INSERT INTO estoque (idProduto, quantidade) VALUES (?, ?)";
                $stmtEstoque = $pdo->prepare($sqlEstoque);
                if (!$stmtEstoque->execute([$produtoId, $quantidade])) {
                    echo json_encode(['success' => false, 'message' => 'Erro ao cadastrar estoque: ' . $stmtEstoque->errorInfo()[2]]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao cadastrar produto: ' . $stmt->errorInfo()[2]]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao fazer upload da imagem.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Todos os campos do formulário devem ser preenchidos.']);
    }
    // Não é necessário fechar a conexão PDO explicitamente
}
?>

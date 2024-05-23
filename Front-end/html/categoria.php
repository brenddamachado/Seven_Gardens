<?php
session_start();

$path = __DIR__ . '../../PHP/connect.php';
if (!file_exists($path)) {
  die('Arquivo de conexão não encontrado: ' . $path);
}
require $path;

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

$query = "SELECT * FROM produto WHERE categoria = :categoria";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Produtos - Seven Gardens</title>
  <link rel="shortcut icon" href="../img/logoatual.svg" type="image/x-icon" />
  <link rel="stylesheet" href="../css/header.css" />
  <link rel="stylesheet" href="../css/catalogo.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <script src="../js/acessibilidade.js"></script>
</head>

<body>
  <?php include('header.php'); ?>
  <div class="container">
    <h1>Produtos - <?php echo htmlspecialchars($categoria); ?></h1>
    <div class="bloco-produtos">
      <?php if ($produtos) : ?>
        <?php foreach ($produtos as $produto) : ?>
          <div class="produto-card">
            <img class="imgProduto" src="../../<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
            <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
            <p>Preço: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
            <p>Categoria: <?php echo htmlspecialchars($produto['categoria']); ?></p>
            <p>Subcategoria: <?php echo htmlspecialchars($produto['subcategoria']); ?></p>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <p class="nenhum-produto">Nenhum produto encontrado.</p>
      <?php endif; ?>
    </div>
  </div>

  <section id="accessibility-section">
    <i class="fas fa-universal-access" id="accessibility-icon"></i>
    <div id="other-things">
      <i class="fas fa-moon" id="dark-mode-toggle"></i>
      <i class="fas fa-sun" id="light-mode-toggle"></i>
      <img class="img_letra" src="../img/aumentartext_1.svg" alt="" srcset="" id="increase-font"></i>
      <img class="img_letra" src="../img/diminuirtext_1.svg" alt="" srcset="" id="decrease-font"></i>
    </div>
  </section>

  <footer>
    <div class="social-icons">
      <p>Siga-nos nas nossas redes sociais:</p>
      <a href="https://www.facebook.com/profile.php?id=100063959239107" class="icon" target="_blank"><i class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com/polen_azul?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="icon" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://www.whatsapp.com/catalog/5521981510975/?app_absent=0" class="icon" target="_blank"><i class="fab fa-whatsapp"></i></a>
    </div>
  </footer>
  <script src="../js/catalogo.js"></script>
</body>

</html>

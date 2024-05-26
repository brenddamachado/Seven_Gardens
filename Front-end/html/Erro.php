<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Erro</title>
  <link rel="stylesheet" href="../css/Erro.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="icon" href="../img/iconlogo.ico" type="image/x-icon">
  <link rel="stylesheet" href="../css/header.css" />
  <link rel="stylesheet" href="../css/modalEstilos.css" />

</head>

<body>
<?php include('header.php'); ?>


  <div class="container sobre-container">
    <div class="container_ajuste">
      <h1>Ops! Algo deu errado...</h1>
      <p>Lamentamos o ocorrido, volte para a página inicial. </p>

      <!-- Primeira imagem -->
      <div class="image-container">
        <img src="../img/plantaerro.webp" alt="Imagem 1" class="rounded-image">
      </div>
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
    <br>
    <div class="social-icons">
      <p> Siga-nos nas nossas redes sociais:</p>

      <a href="https://www.facebook.com/profile.php?id=100063959239107" class="icon" target="_blank"><i
          class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com/polen_azul?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
        class="icon" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://www.whatsapp.com/catalog/5521981510975/?app_absent=0" class="icon" target="_blank"><i
          class="fab fa-whatsapp""></i></a>
    </div>
  </footer>
  <script src=" ../js/acessibilidade.js"></script>
  <script src="../js/erro.js"></script>
</body>

</html>
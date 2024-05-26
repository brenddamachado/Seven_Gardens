<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seven Gardens</title>
  <link rel="stylesheet" href="../css/AlterarSenha.css">
  <link rel="stylesheet" href="../css/header.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="shortcut icon" href="../img/logoatual.svg" type="image/x-icon">
</head>

<body>
<?php include('../../header.php'); ?>

  <div class="container" id="divalterarSenha">
    <form class="divForm" action="javascript:validaLogin()">
      <div class="form-header">
        <h1 class="title">Recuperar Senha</h1>
      </div>

      <br>
      <p>Por favor, confirme seu email para que possamos prosseguir com a alteração de senha.</p>

      <br><br>


      <div class="input-box">
        <label for="E-mail">E-mail:</label>
        <input type="text" id="senha" placeholder="seuemail@exemplo.com">
      </div>



      <div class="button-box">
        <button id="enviarButton" class="btn_enviar">Enviar</button>
      </div>

    </form>

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
      <p class="footer_p"> Siga-nos nas nossas redes sociais:</p>

      <a href="#" class="icon"><i class="fab fa-facebook"></i></a>
      <a href="#" class="icon"><i class="fab fa-instagram"></i></a>
      <a href="#" class="icon"><i class="fab fa-whatsapp"></i></a>


    </div>
  </footer>
  <script src="../js/acessibilidade.js"></script>
  <script src="../js/AltararSenha.js"></script>
  <script src="../js/carrinho.js"></script>
</body>

</html>
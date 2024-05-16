<?php require '../../Front-end/PHP/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="shortcut icon" href="../img/logoatual.svg" type="image/x-icon" />
  <link rel="stylesheet" href="../css/Login.css">
  <link rel="stylesheet" href="../css/header.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <script src="../js/acessibilidade.js"> </script>
</head>

<body>
  <?php include('header.php'); ?>
  <div class="container" id="divLogin">
    <form class="divForm" id="loginForm" action="#" method="POST">
      <div class="form-header">
        <h1 class="title">Login</h1>
      </div>

      <div class="input-box">
        <label for="userName">Nome de usuário:</label>
        <input type="text" id="userName" name="userName" placeholder="Digite seu nome de usuário" required minlength="6" maxlength="6" pattern="[A-Za-z]{6}">
      </div>

      <div class="input-box">
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" placeholder="Digite sua senha" minlength="8" maxlength="8" required pattern="[A-Za-z]{8}">
      </div>

      <div class="buttons">
        <button type="submit" class="btn_cadastrar">Entrar</button>
        <button type="button" class="btn_limpar" onclick="limparCampos()">Limpar</button>
      </div>


      <div class="texto_links">
        <div class="redicionamento">
          <p>Já possui uma conta?
            <a href="Cadastro.php" class="sessao">Criar conta</a>
          </p>
        </div>
        <div class="redicionamento">
          <p>Esqueceu sua senha? <a class="texto_links_2" href="AlterarSenha.php">Altere aqui</a>
          </p>
        </div>
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
      <p> Siga-nos nas nossas redes sociais:</p>

      <a href="#" class="icon"><i class="fab fa-facebook"></i></a>
      <a href="#" class="icon"><i class="fab fa-instagram"></i></a>
      <a href="#" class="icon"><i class="fab fa-whatsapp"></i></a>


    </div>


  </footer>


  <script src="../js/Login.js"> </script>
</body>

</html>
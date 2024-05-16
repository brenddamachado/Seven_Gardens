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
    <form class="divForm" action="javascript:validaLogin()">
      <div class="form-header">
        <h1 class="title">Login</h1>
      </div>


      <div class="input-box">
        <label for="E-mail">E-mail:</label>
        <input type="text" id="email" placeholder="seuemail@exemplo.com">
      </div>

      <div class="input-box">
        <label for="Senha">Senha:</label>
        <input type="password" id="senha" placeholder="Digite sua senha aqui" maxlength="8" minlength="8">
      </div>

      <div class="buttons">
        <button class="btn_cadastrar" type="submit" id="cadastrar">
          Entrar
        </button>
        <button class="btn_limpar" id="limparButton" type="button" value="Limpar Campos" onclick="limparCampos()">Limpar</button>
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
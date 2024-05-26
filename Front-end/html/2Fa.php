<?php
session_start();
$securityQuestion = $_SESSION['security_question'] ?? 'Pergunta não encontrada';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Autenticação</title>
  <link rel="shortcut icon" href="../img/logoatual.svg" type="image/x-icon" />
  <link rel="stylesheet" href="../css/2Fa.css" />
  <link rel="stylesheet" href="../css/header.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
</head>

<body>
  <?php include('../../header.php'); ?> 

  <div class="container" id="divLogin">
    <form class="divForm" id="2faForm" method="POST">
      <div class="form-header">
        <h1 class="title">Pergunta de segurança</h1>
      </div>
      <div class="digiteCod">
        Para garantir a segurança da sua conta, precisamos verificar sua identidade por meio de uma pergunta de segurança. Por favor, responda à pergunta abaixo:
      </div><br />
      <p id="securityQuestion"><?php echo htmlspecialchars($securityQuestion); ?></p>
      <div class="input-box">
        <label for="resposta">Por favor, insira sua resposta abaixo:</label>
        <input type="text" id="resposta" name="resposta" placeholder="Sua resposta aqui." required>
        <span id="mensagemErro" style="color: red;"></span>
        <div id="errorMessages" style="color: red;"></div>
      </div>
      <div class="button-box">
        <button type="submit" id="enviarButton">Enviar</button>
      </div>
    </form>



  </div>


  <footer>
    <br>
    <div class="social-icons">
      <p> Siga-nos nas nossas redes sociais:</p>

      <a href="https://www.facebook.com/profile.php?id=100063959239107" class="icon" target="_blank"><i class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com/polen_azul?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="icon" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://www.whatsapp.com/catalog/5521981510975/?app_absent=0" class="icon" target="_blank"><i class="fab fa-whatsapp""></i></a>


    </div>
    
    <section id=" accessibility-section">
          <i class="fas fa-universal-access" id="accessibility-icon"></i>
          <div id="other-things">
            <i class="fas fa-moon" id="dark-mode-toggle"></i>

            <i class="fas fa-sun" id="light-mode-toggle"></i>
            <img class="img_letra" src="../img/aumentartext_1.svg" alt="" srcset="" id="increase-font">
        </i>
        <img class="img_letra" src="../img/diminuirtext_1.svg" alt="" srcset="" id="decrease-font"></i>
    </div>
    </section>

  </footer>

  <script src="../js/2Fa.js"></script>
  <script src="../js/carrinho.js"></script>
</body>

</html>
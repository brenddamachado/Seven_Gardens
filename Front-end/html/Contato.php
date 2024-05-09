<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contato</title>
  <link rel="stylesheet" href="../css/Contato.css" />
  <link rel="stylesheet" href="../css/header.css" />
  <link rel="shortcut icon" href="../img/logoatual.svg" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
  <?php include('header.php'); ?>

  <main class="contact-container">
    <section class="contact-form">
      <div class="divForm">
        <h2>Envie uma mensagem</h2>
        <form action="/submit-form" method="post">
          <label for="name">Nome:</label>
          <input type="text" id="name" name="name" class="contact-input" required>

          <label for="email">E-mail:</label>
          <input type="email" id="email" name="email" class="contact-input" required>

          <label for="subject">Assunto:</label>
          <input type="text" id="subject" name="subject" class="contact-input" required>

          <label for="message">Mensagem:</label>
          <textarea id="message" name="message" class="contact-textarea" required></textarea>

          <button type="submit" class="btn-enviar">Enviar</button>
        </form>
      </div>
    </section>

    <section class="contact-info">
      <div class="divForm">
        <h2>Entre em Contato</h2>
        <div class="paragr_justificado">
          <p><strong>Não possuímos loja física</strong></p>
          <p><strong>Telefone:</strong> (00) 90000-0000</p>
          <p><strong>E-mail:</strong> contato@exemplo.com</p>
        </div>
      </div>
    </section>

  </main>

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

      <a href="https://www.facebook.com/profile.php?id=100063959239107" class="icon" target="_blank"><i class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com/polen_azul?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="icon" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://www.whatsapp.com/catalog/5521981510975/?app_absent=0" class="icon" target="_blank"><i class="fab fa-whatsapp""></i></a>
    </div>
  </footer>
  <script src=" ../js/Contato.js"></script>
          <script src=" ../js/acessibilidade.js"></script>
</body>

</html>
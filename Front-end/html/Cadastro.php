<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seven Gardens</title>
    <link rel="shortcut icon" href="../img/logoatual.svg" type="image/x-icon" />
    <link rel="stylesheet" href="../css/Cadastro.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link rel="stylesheet" href="../css/header.css" />

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="../js/acessibilidade.js"></script>
  </head>

  <body>
  <?php include('header.php'); ?>


    <section class="formulario">
      <form id="formulario" action="#">
        <div id="mensagemform"></div>
        <label class="label_login" for="nome" id="labelNome"> Nome:</label>
        <input
          class="input_login"
          type="text"
          id="nome"
          name="nome"
          maxlength="80"
          autofocus
          placeholder="Digite o seu nome "
        />
        <div id="mensagemNome"></div>
        <div id="mensagemform"></div>
        <label class="label_login" for="nome" id="labelNome">
          Nome da mãe:</label
        >
        <input
          class="input_login"
          type="text"
          id="nomeDamae"
          name="nome"
          maxlength="80"
          autofocus
          placeholder="Digite o seu nome "
        />
        <div id="mensagemNomeMae"></div>

        <label for="nasc" class="label_login"> Data de nascimento: </label>
        <input class="input_login" type="date" id="data" name="nasc" />
        <div id="mensagemnascim"></div>
        <div class="genero">
          <label for="sexo" class="label_login"> Genêro:</label>
          <div class="input-group">
              <input type="radio" id="mcisgênero" class="genero" name="genero" value="Mulher cisgênero" />
              <label class="model" for="mcisgênero">Mulher cisgênero</label>
          </div>
          <div class="input-group">
              <input type="radio" id="mtransgênero" class="genero" name="genero" value="Mulher transgênero" />
              <label class="model" for="mtransgênero">Mulher transgênero</label>
          </div>
          <div class="input-group">
              <input type="radio" id="hcisgênero" name="genero" class="genero" value="Homem cisgênero" />
              <label class="model" for="hcisgênero">Homem cisgênero</label>
          </div>
          <div class="input-group">
              <input type="radio" id="htransgênero" name="genero" class="genero" value="Homem transgênero" />
              <label class="model" for="htransgênero">Homem transgênero</label>
          </div>
          <div class="input-group">
              <input type="radio" id="binário" name="genero" value="não-binário" class="genero" />
              <label class="model" for="binário">não-binário</label>
          </div>
          <div class="input-group">
              <input type="radio" id="outro" name="genero" value="outro" class="genero" />
              <label class="model" for="outro">Outros</label>
          </div>
      </div>
      <div id="mensagemgenero"></div>
        <label for="cpf" id="labelCpf" class="label_login">CPF:</label>
        <input
          class="input_login"
          type="text"
          id="cpf"
          name="cpf"
          maxlength="11"
          placeholder="Digite seu cpf"
        />
        <div id="mensagemCPF"></div>

        <label for="cel" class="label_login" id="labelCel">
          Telefone Celular:</label
        >
        <input
          class="input_login"
          type="tel"
          id="numero"
          name="numeroCelular"
          placeholder="(xx) xxxxx-xxxx"
          maxlength="14"
        />

        <label class="label_login" for="ende" class="form" id="labelCep">
          Cep:</label
        >
        <input
          class="input_login"
          type="text"
          maxlength="9"
          id="cep"
          name="cep"
          placeholder="Digite seu cep"
        />
        <div id="mensagemCep"></div>

        <label class="label_login" for="ende" class="form" id="labelCidade">
          Cidade:</label
        >
        <input
          class="input_login"
          type="text"
          id="cid"
          name="cidade"
          placeholder="Digite sua cidade"
        />

        <label id="labelBairro" for="ende" class="label_login"> Bairro:</label>
        <input
          class="input_login"
          type="text"
          id="bairro"
          name="bairro"
          placeholder="Digite seu bairro"
        />

        <label id="labelRua" for="ende" class="label_login"> Rua:</label>
        <input
          class="input_login"
          type="text"
          id="rua"
          name="rua"
          placeholder="Digite sua rua"
        />

        <label id="labelN" for="ende" class="label_login"> Nº:</label>
        <input
          class="input_login"
          type="number"
          id="num"
          name="numero"
          placeholder="Digite o número da casa"
        />

        <label for="ende" class="label_login"> Complemento:</label>
        <input
          class="input_login"
          type="text"
          id="comple"
          name="complemento"
          placeholder="Digite o complemento"
        />

        <label class="label_login" id="labelLogin" for="login" class="form"
          >Login:</label
        >
        <input
          class="input_login"
          type="text"
          id="login"
          name="login"
          placeholder="Digite um login"
          maxlength="6"
        />
        <div id="mensagemLogin"></div>
        <label class="label_login" id="labelEmail" for="login" class="form">
          E-mail:</label
        >
        <input
          class="input_login"
          type="email"
          id="email"
          name="email"
          placeholder="Digite um e-mail"
        />
        <div id="mensagemEmail"></div>

        <label class="label_login" id="labelSenha" for="senha" class="form">
          Senha:</label
        >
        <div class="password-container">
          <input
            class="input_login"
            type="password"
            id="senha"
            name="senha"
            placeholder="Digite sua senha"
            maxlength="8"
            autocomplete="new-password"
          />
          <i id="verSenha" class="far fa-eye"></i>
        </div>

        <label
          class="label_login"
          id="labelConfirmacao"
          for="senha2"
          class="form"
        >
          Confirmação de Senha:</label
        >
        <div class="password-container">
          <input
            class="input_login"
            type="password"
            id="senhaC"
            name="senha2"
            placeholder="Digite sua senha"
            maxlength="8"
            autocomplete="new-password"
          />
          <i id="verConfirme" class="far fa-eye"></i>
        </div>
        <div class="conta">
          <p>Já possui uma conta?</p>
          <a href="Login.html" class="sessao">Iniciar sessão</a>
        </div>
        <div id="mensagem"></div>
        <div class="buttons">
          <button class="btn_cadastrar" type="submit" id="cadastrar">
            Cadastrar
          </button>
          <button class="btn_limpar" id="limpar">Limpar</button>
        </div>
      </form>
    </section>
    
    
    <section id="accessibility-section">
      <i class="fas fa-universal-access" id="accessibility-icon"></i>
      <div id="other-things">
         <i class="fas fa-moon" id="dark-mode-toggle"></i>

        <i class="fas fa-sun" id="light-mode-toggle"></i>
        <img class="img_letra" src="../img/aumentartext_1.svg" alt="" srcset="" id="increase-font"></i>
        <img class="img_letra" src="../img/diminuirtext_1.svg" alt="" srcset="" id="decrease-font"></i>
      </div>
    </section>
    
    <!-- <div class="trilho" id="trilho">
      <div class="indicador"></div>
    </div> -->
    <footer>
      <br />

      <div class="social-icons">
        <p>Siga-nos nas nossas redes sociais:</p>

        <a href="#" class="icon"><i class="fab fa-facebook"></i></a>
        <a href="#" class="icon"><i class="fab fa-instagram"></i></a>
        <a href="#" class="icon"><i class="fab fa-whatsapp"></i></a>
      </div>
    </footer>
    <script src="../js/Cadastro.js"></script>
  </body>
</html>

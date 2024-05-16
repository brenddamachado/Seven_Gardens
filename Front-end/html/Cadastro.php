<?php
include('../PHP/connect.php'); // Assegure-se de que este caminho está correto.

$erroEmail = "";
$mensagemSucesso = "";
$showAlert = false;
$showAlertError = false;

// Função para verificar se o email já existe no banco de dados
function emailExists($email, $pdo)
{
  $stmt = $pdo->prepare("SELECT idUsuario FROM usuario WHERE email = ?");
  $stmt->execute([$email]);
  return $stmt->fetchColumn() ? true : false;
}

// Função para inserir o usuário no banco de dados
function createUser($data, $pdo)
{
  $sql = "INSERT INTO usuario (nome_completo, data_nascimento, sexo, nome_materno, cpf, email, telefone_celular, user_name, senha, tipo_usuario, ativado)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $senhaHash = password_hash($data['senha'], PASSWORD_DEFAULT); // Hashing da senha
  $stmt->execute([
    $data['nome_completo'], $data['data_nascimento'], $data['sexo'], $data['nome_materno'], $data['cpf'],
    $data['email'], $data['telefone_celular'], $data['user_name'], $senhaHash, 'Cliente', 1
  ]);
  return $pdo->lastInsertId();
}

// Função para inserir o endereço no banco de dados
function createAddress($data, $userId, $pdo)
{
  $sql = "INSERT INTO endereco_completo (idUsuario, logradouro, numero, complemento, bairro, cidade, estado, cep)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    $userId, $data['logradouro'], $data['numero'], $data['complemento'], $data['bairro'],
    $data['cidade'], $data['estado'], $data['cep']
  ]);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['email'])) {
  $email = $_GET['email'];

  $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE email = ?");
  $stmt->execute([$email]);
  $count = $stmt->fetchColumn();

  // Se o e-mail já existe, retorna um JSON informando isso
  if ($count > 0) {
      echo json_encode(['error' => 'E-mail já cadastrado']);
      exit;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = [
    'nome_completo' => $_POST['nome_completo'],
    'data_nascimento' => $_POST['data_nascimento'],
    'sexo' => $_POST['genero'],
    'nome_materno' => $_POST['nome_materno'],
    'cpf' => $_POST['cpf'],
    'email' => $_POST['email'],
    'telefone_celular' => $_POST['telefone_celular'],
    'user_name' => $_POST['login'],
    'senha' => $_POST['senha'],
    'logradouro' => $_POST['rua'],
    'numero' => $_POST['numero'],
    'complemento' => $_POST['complemento'],
    'bairro' => $_POST['bairro'],
    'cidade' => $_POST['cidade'],
    'estado' => $_POST['estado'],
    'cep' => $_POST['cep']
  ];

  // Checa se o email já existe
  if (emailExists($data['email'], $pdo)) {
    $erroEmail = "E-mail já cadastrado!";
    $showAlertError = true;
  } else {
    $userId = createUser($data, $pdo);
    createAddress($data, $userId, $pdo);
    $mensagemSucesso = "Usuário cadastrado com sucesso!";
    $showAlert = true;
  }
}

// Verifica se o método de requisição é GET e se o parâmetro email está presente
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['email'])) {
  $email = $_GET['email'];

  // Sua conexão com o banco de dados
  $pdo = new PDO('mysql:host=seu_host;dbname=seu_banco', 'seu_usuario', 'sua_senha');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Prepara a consulta
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE email = ?");
  $stmt->execute([$email]);
  $count = $stmt->fetchColumn();

  // Se o e-mail já existe, retorna um JSON informando isso
  if ($count > 0) {
      echo json_encode(['error' => 'E-mail já cadastrado']);
      exit;
  }
}



// Encerra a conexão
$pdo = null;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Seven Gardens</title>
  <link rel="shortcut icon" href="../img/logoatual.svg" type="image/x-icon" />
  <link rel="stylesheet" href="../css/Cadastro.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
  <script src="../js/acessibilidade.js"></script>
</head>

<body>

<header>
  <section class="header">
    <div>
      <img class="logo" src="../img/logoatual.svg" alt="" srcset="" />
    </div>

    <div class="pesquisa-container">
      <input type="search" name="" id="" class="pesquisa" />
      <div for="" class="pesquisa-icon"><i class="fas fa-search"></i></div>
    </div>
    <nav class="nav_a">
      <div class="navegacao">
        <ul>
          <li class="home">
            <a class="home" href="../index.html">Home</a>
          </li>
          <li class="login">
            <a href="Login.html" class="login">Login</a>
          </li>
        </ul>
      </div>
    </nav>
  </section>

  <section class="opcoes">
    <div class="dropdown">
      <div class="dropbtn">
        <span class="prod_dropdown">Produtos</span> <i class="fas fa-chevron-down"> </i>
      </div>
      <div class="dropdown-content">
        <a href="#"> Enxertos</a>
        <a href="#"> Naturais (De semente) </a>
        <a href="#">Especiais</a>
        <a href="#">Insumos</a>
      </div>
    </div>

    <div class="menu_btn">
      <a href="instrucoesCultivo.html">Instruções de Cultivo</a>
    </div>
    <div class="menu_btn">
      <a href="Contato.html">Contato</a>
    </div>
    <div class="menu_btn">
      <a href="Sobre.html">Sobre</a>
    </div>
    <img src="../img/iconecar.svg" alt="Ícone do carrinho de compras" id="icon" />

  </section>
  <section class="section_mobile">
    <div class="mobile_i"> <i id="hamburguer" class="fa fa-bars"></i></div>

    <section id="mobile" class="mobile">

      <div id="dentro_icon" class="dentro_icon">
        <div class="close-btn"><i class="fas fa-times"></i></div>
        <a href="../index.html">Home</a>

        <a href="Login.html">Login</a>

        <a href="#"> Enxertos</a>
        <a href="#"> Naturais (De semente) </a>
        <a href="#">Especiais</a>
        <a href="#">Insumos</a>
        <a href="instrucoesCultivo.html">Instruções de Cultivo</a>
        <a href="Contato.html">Contato</a>
        <a href="Sobre.html">Sobre</a>

      </div>

    </section>
    <img src="../img/iconecar.svg" alt="Ícone do carrinho de compras" id="icon" class="icon_mobile" />
  </section>

</header>

<!-- quando o usuario for cadastrar jogar direto pra página de login. -->
<?php if ($showAlert): ?>
<script>
  setTimeout(function() {
    window.location.href = "Login.php";
  }, 3000); // 3000 milissegundos = 3 segundos
</script>
<?php endif; ?>

<!-- Alerta de sucesso -->
<div class="container-alert" style="<?php echo $showAlert ? 'display: block;' : 'display: none;'; ?>">
  <div class="alert alert-success">
    <strong>Successo!</strong> <?php echo $mensagemSucesso; ?>
  </div>
</div>


<section class="formulario">

  <form id="formulario" method="POST">

    <div id="mensagemform"></div>
    <label class="label_login" for="nome" id="labelNome"> Nome:</label>
    <input class="input_login" type="text" id="nome" name="nome_completo" maxlength="80" autofocus placeholder="Digite o seu nome " />
    <div id="mensagemNome"></div>
    <div id="mensagemform"></div>
    <label class="label_login" for="nome" id="labelNome">
      Nome da mãe:</label>
    <input class="input_login" type="text" id="nomeDamae" name="nome_materno" maxlength="80" autofocus placeholder="Digite o seu nome " />
    <div id="mensagemNomeMae"></div>

    <label for="nasc" class="label_login"> Data de nascimento: </label>
    <input class="input_login" type="date" id="data" name="data_nascimento" />
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
    <input class="input_login" type="text" id="cpf" name="cpf" maxlength="11" placeholder="Digite seu cpf" />
    <div id="mensagemCPF"></div>

    <label for="cel" class="label_login" id="labelCel">
      Telefone Celular:</label>
    <input class="input_login" type="tel" id="numero" name="telefone_celular" placeholder="(xx) xxxxx-xxxx" maxlength="14" />
    <label class="label_login" for="ende" class="form" id="labelCep">
      Cep:</label>
    <input class="input_login" type="text" maxlength="9" id="cep" name="cep" placeholder="Digite seu cep" />
    <div id="mensagemCep"></div>

    <label for="estado" class="label_login">Estado:</label>
    <select class="input_login" id="estado" name="estado" required>
      <option value="AC">Acre</option>
      <option value="AL">Alagoas</option>
      <option value="AP">Amapá</option>
      <option value="AM">Amazonas</option>
      <option value="BA">Bahia</option>
      <option value="CE">Ceará</option>
      <option value="DF">Distrito Federal</option>
      <option value="ES">Espírito Santo</option>
      <option value="GO">Goiás</option>
      <option value="MA">Maranhão</option>
      <option value="MT">Mato Grosso</option>
      <option value="MS">Mato Grosso do Sul</option>
      <option value="MG">Minas Gerais</option>
      <option value="PA">Pará</option>
      <option value="PB">Paraíba</option>
      <option value="PR">Paraná</option>
      <option value="PE">Pernambuco</option>
      <option value="PI">Piauí</option>
      <option value="RJ">Rio de Janeiro</option>
      <option value="RN">Rio Grande do Norte</option>
      <option value="RS">Rio Grande do Sul</option>
      <option value="RO">Rondônia</option>
      <option value="RR">Roraima</option>
      <option value="SC">Santa Catarina</option>
      <option value="SP">São Paulo</option>
      <option value="SE">Sergipe</option>
      <option value="TO">Tocantins</option>
    </select>
    </div>

    <label class="label_login" for="ende" class="form" id="labelCidade">
      Cidade:</label>
    <input class="input_login" type="text" id="cid" name="cidade" placeholder="Digite sua cidade" />

    <label id="labelBairro" for="ende" class="label_login"> Bairro:</label>
    <input class="input_login" type="text" id="bairro" name="bairro" placeholder="Digite seu bairro" />

    <label id="labelRua" for="ende" class="label_login"> Rua:</label>
    <input class="input_login" type="text" id="rua" name="rua" placeholder="Digite sua rua" />

    <label id="labelN" for="ende" class="label_login"> Nº:</label>
    <input class="input_login" type="number" id="num" name="numero" placeholder="Digite o número da casa" />

    <label for="ende" class="label_login"> Complemento:</label>
    <input class="input_login" type="text" id="comple" name="complemento" placeholder="Digite o complemento" />

    <label class="label_login" id="labelLogin" for="login" class="form">Login:</label>
    <input class="input_login" type="text" id="login" name="login" placeholder="Digite um login" maxlength="6" />
    <div id="mensagemLogin"></div>
    <label class="label_login" id="labelEmail" for="login" class="form">
      E-mail:</label>
    <input class="input_login" type="email" id="email" name="email" placeholder="Digite um e-mail" />
    <div id="mensagemEmail"></div>
    <label class="label_login" id="labelSenha" for="senha" class="form">
      Senha:</label>
    <div class="password-container">
      <input class="input_login" type="password" id="senha" name="senha" placeholder="Digite sua senha" maxlength="8" autocomplete="new-password" />
      <i id="verSenha" class="far fa-eye"></i>
    </div>
    <label class="label_login" id="labelConfirmacao" for="senha2" class="form">
      Confirmação de Senha:</label>
    <div class="password-container">
      <input class="input_login" type="password" id="senhaC" name="senha2" placeholder="Digite sua senha" maxlength="8" autocomplete="new-password" />
      <i id="verConfirme" class="far fa-eye"></i>
    </div>
    <div class="conta">
      <p>Já possui uma conta?</p>
      <a href="login.php" class="sessao">Iniciar sessão</a>
    </div>
    <div id="mensagem"></div>
    <div class="buttons">
      <button class="btn_cadastrar" type="submit" id="cadastrar" name="cadastrar">
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
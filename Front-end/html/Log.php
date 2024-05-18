<?php
session_start();
require '../../Front-end/PHP/connect.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$pesquisa = isset($_POST['inputPesquisa']) ? $_POST['inputPesquisa'] : '';

// Consulta para obter os registros do histórico de login
$query = "
    SELECT 
        h.horarioLogin, 
        u.nome_completo, 
        h.id_pergunta_secreta,
        h.id_usuario 
    FROM 
        historico_login h 
    JOIN 
        usuario u 
    ON 
        h.id_usuario = u.idUsuario
";

if ($pesquisa) {
    $query .= " WHERE u.nome_completo LIKE ? OR u.cpf LIKE ?";
    $stmt = $pdo->prepare($query);
    $likePesquisa = "%$pesquisa%";
    $stmt->bindParam(1, $likePesquisa);
    $stmt->bindParam(2, $likePesquisa);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Seven Gardens</title>
  <link rel="stylesheet" href="../css/Log.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <script src="../js/acessibilidade.js"></script>
</head>

<body>
  <header>
    <section class="header">
      <div>
        <img class="logo" src="../img/logoatual.svg" alt="" srcset="" />
      </div>
      <nav>
        <div class="navegacao">
          <ul class="paginas">
            <li class="login"><a href="#">Dashboard</a></li>
            <li class="cadastrar"> <a href="../index.html">Visualizar Home</a></li>
          </ul>
        </div>
      </nav>
    </section>
    <section class="opcoes">
      <h2>Painel de controle</h2>
    </section>
  </header>

  <form method="post" action="">
    <h1>Histórico de login</h1>
    <label for="inputPesquisa">Pesquisar usuário:</label>
    <input type="text" id="input_historico" name="inputPesquisa" placeholder="Digite o nome ou CPF do usuário" value="<?php echo htmlspecialchars($pesquisa); ?>">
    <br><br>
    <div id="mensagem_historico"></div>
    <br>
    <button type="submit">Pesquisar</button>
  </form>

  <table id="tabelaUsuarios">
    <thead>
      <tr>
        <th>ID do Cliente</th>
        <th>Nome</th>
        <th>Data e hora</th>
        <th>Pergunta Secreta</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && count($result) > 0): ?>
        <?php foreach ($result as $row): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['id_usuario']); ?></td>
            <td><?php echo htmlspecialchars($row['nome_completo']); ?></td>
            <td><?php echo htmlspecialchars(date('d/m/Y H:i:s', strtotime($row['horarioLogin']))); ?></td>
            <td><?php echo htmlspecialchars($row['id_pergunta_secreta']); ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="4">Nenhum registro encontrado.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

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
    <p class="social"> Siga-nos nas nossas redes sociais:</p>

    <div class="social-icons">
      <a href="#" class="icon"><i class="fab fa-facebook"></i></a>
      <a href="#" class="icon"><i class="
a href="#" class="fab fa-facebook"></a>
<a href="#" class="fab fa-instagram"></a>
<a href="#" class="fab fa-whatsapp"></a>
</div>

  </footer>
  <script src="../js/Log.js"></script>
</body>
</html>
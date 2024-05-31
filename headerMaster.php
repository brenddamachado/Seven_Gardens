<?php
require_once __DIR__ . '/helpers/path_helper.php'; // Inclui a função base_url

if (session_status() == PHP_SESSION_NONE) {
  session_start();  // Inicia a sessão apenas se não estiver já iniciada
}

$path = __DIR__ . '/Front-end/PHP/connect.php';
if (!file_exists($path)) {
  die('Arquivo de conexão não encontrado: ' . $path);
}
require $path;

// Verificar se o usuário é um 'Master' ou 'Colaborador'
$isUserMasterOrColaborador = isset($_SESSION['usuario_tipo']) && in_array($_SESSION['usuario_tipo'], ['Master', 'Colaborador']);
?>

<header>
  <section class="header">
    <div>
      <a href="<?php echo base_url('index.php'); ?>"><img class="logo" src="<?php echo base_url('Front-end/img/logoatual.svg'); ?>" alt="Logo Seven Gardens" /></a>
    </div>

    <nav class="nav_a">
      <div class="navegacao">
        <ul>
          <?php if (isset($_SESSION['usuario_id'])) : ?>
            <li class="welcome-logout">
              <span>
                <?php if ($_SESSION['usuario_tipo'] === 'Master' || $_SESSION['usuario_tipo'] === 'Colaborador') : ?>
                  Olá, administrador!
                <?php else : ?>
                  Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!
                <?php endif; ?>
              </span>
              <div class="navegacoes">
                   <a href="<?php echo base_url('Front-end/html/logout.php'); ?>" class="logout">Logout</a>
              <a href="<?php echo base_url('Front-end/html/InterfaceMaster.php'); ?>" class="dashboard">Dashboard</a>
              </div>
           
            </li>
          <?php else : ?>
            <li class="home"><a class="login" href="<?php echo base_url('Front-end/html/Login.php'); ?>">Login</a></li>
            <li class="login"><a href="<?php echo base_url('Front-end/html/Cadastro.php'); ?>" class="cadastro">Cadastro</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </section>
  <section class="opcoes">
    <h2 class="painel">Painel de controle</h2>
  </section>
</header>
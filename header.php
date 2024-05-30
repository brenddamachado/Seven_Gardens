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
?>

<header>
  <section class="header">
    <div>
      <a href="<?php echo base_url('index.php'); ?>"><img class="logo" src="<?php echo base_url('Front-end/img/logoatual.svg'); ?>" alt="Logo Seven Gardens" /></a>
    </div>

    <div class="pesquisa-container">
      <input type="search" name="" id="" class="pesquisa" />
      <div class="pesquisa-icon"><i class="fas fa-search"></i></div>
    </div>
    <nav class="nav_a">
      <div class="navegacao">
        <ul>
          <?php if (isset($_SESSION['usuario_id']) && !isset($_SESSION['pre_auth'])) : ?>
            <li class="welcome-logout">
              <span>
                <?php if ($_SESSION['usuario_tipo'] === 'Master' || $_SESSION['usuario_tipo'] === 'Colaborador') : ?>
                  Olá, administrador!
                <?php else : ?>
                  Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!
                <?php endif; ?>
              </span>
              <a href="<?php echo base_url('Front-end/html/logout.php'); ?>" class="logout">Logout</a>
              <?php if ($_SESSION['usuario_tipo'] === 'Master' || $_SESSION['usuario_tipo'] === 'Colaborador') : ?>
                <a href="<?php echo base_url('Front-end/html/InterfaceMaster.php'); ?>" class="cadastro">Dashboard</a>
              <?php else : ?>
                <a href="<?php echo base_url('Front-end/html/Usuario.php'); ?>" class="dashboard">Minha Conta</a>
              <?php endif; ?>
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
    <div class="dropdown">
      <div class="dropbtn">
        <span class="prod_dropdown">Produtos</span> <i class="fas fa-chevron-down"> </i>
      </div>
      <div class="dropdown-content">
        <a href="<?php echo base_url('Front-end/html/catalogo.php'); ?>">Ver Todos</a>
        <a href="<?php echo base_url('Front-end/html/categoria.php?categoria=Enxertos'); ?>">Enxertos</a>
        <a href="<?php echo base_url('Front-end/html/categoria.php?categoria=Naturais%20(De%20semente)'); ?>">Naturais (De semente)</a>
        <a href="<?php echo base_url('Front-end/html/categoria.php?categoria=Especiais'); ?>">Especiais</a>
        <a href="<?php echo base_url('Front-end/html/categoria.php?categoria=Insumos'); ?>">Insumos</a>
      </div>
    </div>

    <div class="menu_btn">
      <a href="<?php echo base_url('Front-end/html/instrucoesCultivo.php'); ?>">Instruções de Cultivo</a>
    </div>
    <div class="menu_btn">
      <a href="<?php echo base_url('Front-end/html/Contato.php'); ?>">Contato</a>
    </div>
    <div class="menu_btn">
      <a href="<?php echo base_url('Front-end/html/Sobre.php'); ?>">Sobre</a>
    </div>
    <!-- Ícone do carrinho -->
    <div class="cart-icon-container">
      <img src="<?php echo base_url('Front-end/img/iconecar.svg'); ?>" alt="Ícone do carrinho de compras" id="icon" onclick="exibirModalCarrinho()" />
      <!-- Contador de itens no carrinho -->
      <span id="cart-counter" class="cart-counter">0</span>
    </div>
  </section>
  <section class="section_mobile">
    <div class="mobile_i"><i id="hamburguer" class="fa fa-bars"></i></div>
    <section id="mobile" class="mobile">
      <div id="dentro_icon" class="dentro_icon">
        <div class="close-btn"><i class="fas fa-times"></i></div>
        <a href="<?php echo base_url('Front-end/html/Login.php'); ?>">Login</a>
        <a href="<?php echo base_url('Front-end/html/Cadastro.php'); ?>">Cadastro</a>
        <a href="<?php echo base_url('Front-end/html/catalogo.php'); ?>">Ver Todos</a>
        <a href="<?php echo base_url('Front-end/html/categoria.php?categoria=Enxertos'); ?>">Enxertos</a>
        <a href="<?php echo base_url('Front-end/html/categoria.php?categoria=Naturais%20(De%20semente)'); ?>">Naturais (De semente)</a>
        <a href="<?php echo base_url('Front-end/html/categoria.php?categoria=Especiais'); ?>">Especiais</a>
        <a href="<?php echo base_url('Front-end/html/categoria.php?categoria=Insumos'); ?>">Insumos</a>
        <a href="<?php echo base_url('Front-end/html/instrucoesCultivo.php'); ?>">Instruções de Cultivo</a>
        <a href="<?php echo base_url('Front-end/html/Contato.php'); ?>">Contato</a>
        <a href="<?php echo base_url('Front-end/html/Sobre.php'); ?>">Sobre</a>
      </div>
    </section>
    <!-- Ícone do carrinho para versão mobile -->
    <img src="<?php echo base_url('Front-end/img/iconecar.svg'); ?>" alt="Ícone do carrinho de compras" id="icon" class="icon_mobile" onclick="exibirModalCarrinho()" />
  </section>
</header>

<?php include(__DIR__ . '/modal_carrinho.php'); ?> <!-- Inclusão do modal do carrinho -->
<?php include(__DIR__ . '/modal_edit_produtos.php'); ?> <!-- Inclusão do modal do carrinho -->
<?php
session_start();
?>
<header>
  <section class="header">
    <div>
      <a href="../../index.php"><img class="logo" src="../img/logoatual.svg" alt="Logo Seven Gardens" /></a>
    </div>
    <div class="pesquisa-container">
      <input type="search" name="" id="" class="pesquisa" />
      <div class="pesquisa-icon"><i class="fas fa-search"></i></div>
    </div>
    <nav class="nav_a">
      <div class="navegacao">
        <ul>
          <?php if (isset($_SESSION['usuario_tipo'])) : ?>
            <li class="welcome-logout">
              <span>
                <?php
                if ($_SESSION['usuario_tipo'] == 'Master' || $_SESSION['usuario_tipo'] == 'Colaborador') {
                  echo "Olá, administrador!";
                } else {
                  echo "Olá, " . htmlspecialchars($_SESSION['usuario_nome']) . "!";
                }
                ?>
              </span>
              <a href="logout.php" class="logout">Logout</a>
            </li>
          <?php else : ?>
            <li class="home"><a class="login" href="Front-end/html/Login.php">Login</a></li>
            <li class="login"><a href="Front-end/html/Cadastro.php" class="cadastro">Cadastro</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>

  <section class="opcoes">
    <div class="dropdown">
      <div class="dropbtn">
        <span class="prod_dropdown">Produtos</span> <i class="fas fa-chevron-down"></i>
      </div>
      <div class="dropdown-content">
        <a href="catalogo.php">Ver Todos</a>
        <a href="categoria.php?categoria=Enxertos">Enxertos</a>
        <a href="categoria.php?categoria=Naturais (De semente)">Naturais (De semente)</a>
        <a href="categoria.php?categoria=Especiais">Especiais</a>
        <a href="categoria.php?categoria=Insumos">Insumos</a>
      </div>
    </div>
    <div class="menu_btn"><a href="../../index.php">Home</a></div>
    <div class="menu_btn"><a href="instrucoesCultivo.php">Instruções de Cultivo</a></div>
    <div class="menu_btn"><a href="Contato.php">Contato</a></div>
    <div class="menu_btn"><a href="Sobre.php">Sobre</a></div>
    <div class="cart-icon-container">
      <img src="../img/iconecar.svg" alt="Ícone do carrinho de compras" id="icon" onclick="exibirModalCarrinho()" />
      <span id="cart-counter" class="cart-counter">0</span>
    </div>
    <div class="menu_btn">
      <a href="instrucoesCultivo.php">Instruções de Cultivo</a>
    </div>
    <div class="menu_btn">
      <a href="Contato.php">Contato</a>
    </div>
    <div class="menu_btn">
      <a href="Sobre.php">Sobre</a>
    </div>
    <img src="../img/iconecar.svg" alt="Ícone do carrinho de compras" id="icon" />
  </section>
  <section class="section_mobile">
    <div class="mobile_i"><i id="hamburguer" class="fa fa-bars"></i></div>
    <section id="mobile" class="mobile">
      <div id="dentro_icon" class="dentro_icon">
        <div class="close-btn"><i class="fas fa-times"></i></div>
        <a href="../../index.php">Home</a>
        <a href="Cadastro.php">Cadastro</a>
        <a href="Login.php">Login</a>
        <a href="categoria.php?categoria=Enxertos">Enxertos</a>
        <a href="categoria.php?categoria=Naturais (De semente)">Naturais (De semente)</a>
        <a href="categoria.php?categoria=Especiais">Especiais</a>
        <a href="categoria.php?categoria=Insumos">Insumos</a>
        <a href="instrucoesCultivo.php">Instruções de Cultivo</a>
        <a href="Contato.php">Contato</a>
        <a href="Sobre.php">Sobre</a>
      </div>
    </section>
    <img src="../img/iconecar.svg" alt="Ícone do carrinho de compras" id="icon" class="icon_mobile" onclick="exibirModalCarrinho()" />
  </section>
</header>
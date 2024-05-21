<?php
session_start();  // Inicia a sessão no início do script, antes de qualquer saída HTML.

$path = __DIR__ . '/Front-end/PHP/connect.php';
if (!file_exists($path)) {
  die('Arquivo de conexão não encontrado: ' . $path);
}
require $path;

// Verificar se o usuário é um 'Master' ou 'Colaborador'
$isUserMasterOrColaborador = isset($_SESSION['usuario_tipo']) && in_array($_SESSION['usuario_tipo'], ['Master', 'Colaborador']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Seven Gardens</title>
  <link rel="shortcut icon" href="Front-end/img/logoatual.svg" type="image/x-icon" />
  <link rel="stylesheet" href="Front-end/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
</head>

<body>
  <header>
    <section class="header">
      <div>
        <a href="index.html"><img class="logo" src="Front-end/img/logoatual.svg" alt="" srcset="" /></a>
      </div>

      <div class="pesquisa-container">
        <input type="search" name="" id="" class="pesquisa" />
        <div for="" class="pesquisa-icon"><i class="fas fa-search"></i></div>
      </div>
      <nav class="nav_a">
        <div class="navegacao">
          <ul>
            <li class="home">
              <a class="login" href="Front-end/html/Login.php">Login</a>
            </li>
            <li class="login">
              <a href="Front-end/html/Cadastro.php" class="cadastro">Cadastro</a>
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
        <a href="/Front-end/html/instrucoesCultivo.php">Instruções de Cultivo</a>
      </div>
      <div class="menu_btn">
        <a href="/Front-end/html/Contato.php">Contato</a>
      </div>
      <div class="menu_btn">
        <a href="/Front-end/html/Sobre.php">Sobre</a>
      </div>
      <!-- Ícone do carrinho -->
      <div class="cart-icon-container">
        <img src="Front-end/img/iconecar.svg" alt="Ícone do carrinho de compras" id="icon" onclick="exibirModalCarrinho()" />
        <!-- Contador de itens no carrinho -->
        <span id="cart-counter" class="cart-counter">0</span>
      </div>

    </section>
    <section class="section_mobile">
      <div class="mobile_i"> <i id="hamburguer" class="fa fa-bars"></i></div>

      <section id="mobile" class="mobile">

        <div id="dentro_icon" class="dentro_icon">
          <div class="close-btn"><i class="fas fa-times"></i></div>
          <a href="/Front-end/html/Login.php">Login</a>

          <a href="/Front-end/html/Cadastro.php">Cadastro</a>

          <a href="#"> Enxertos</a>
          <a href="#"> Naturais (De semente) </a>
          <a href="#">Especiais</a>
          <a href="#">Insumos</a>
          <a href="/Front-end/html/instrucoesCultivo.php">Instruções de Cultivo</a>
          <a href="/Front-end/html/Contato.php">Contato</a>
          <a href="/Front-end/html/Sobre.php">Sobre</a>

        </div>

      </section>
      <!-- Ícone do carrinho para versão mobile -->
      <img src="Front-end/img/iconecar.svg" alt="Ícone do carrinho de compras" id="icon" class="icon_mobile" onclick="exibirModalCarrinho()" />
    </section>

  </header>
  <!-- Carrossel para os Banner da loja Seven Gardens -->
  <div class="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="Front-end/img/banner1.svg" alt="Imagem 1">
      </div>
      <div class="Front-end/img/banner2.svg" alt="Imagem 2">
      </div>
      <div class="carousel-item">
        <img src="Front-end/img/banner3.svg" alt="Imagem 3">
      </div>
    </div>
    <button class="carousel-prev" onclick="prevSlide()"></button>
    <button class="carousel-next" onclick="nextSlide()"></button>
  </div>

  <!-- Modal do carrinho -->
  <div id="modalCarrinho" class="modal-carrinho">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Meu Carrinho</h2>
      <div id="itensCarrinho" class="itens-carrinho">
        <!-- Estrutura de exemplo para um item do carrinho -->
        <div class="item-carrinho">
          <img class="imagem-produto" src="caminho/para/sua/imagem.jpg" alt="Descrição do produto">
          <!-- Outras informações do produto -->
          <button class="excluir-produto-btn" onclick="removerProduto(this.parentNode)">Remover</button>
        </div>
      </div>
      <div id="total-carrinho" class="total-carrinho">Total: R$ 0.00</div>
      <button id="finalizar-compra-btn" class="finalizar-compra-btn">Finalizar Compra</button>
    </div>
  </div>


  <span class="titulopg">
    <h1>Destaques</h1>
  </span>
  <hr>
  <!-- inicio Bloco de Produtos -->
  <div class="bloco-produtos">

<?php
  $query = "SELECT idProduto, nome, preco, descricao, categoria, subcategoria, imagem FROM produto";
  $stmt = $pdo->prepare($query);
  $stmt->execute();

// Exibir os cards dos produtos
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<div class='produto-card'>";
    echo "<img class='imgProduto' src='" . $row["imagem"] . "' alt='Imagem do produto'>";
    echo "<h3>" . $row["nome"] . "</h3>";
    echo "<p>Preço: R$ " . $row["preco"] . "</p>";
    echo "<p>" . $row["descricao"] . "</p>";
    echo "<p>Categoria: " . $row["categoria"] . "</p>";
    echo "<p>Subcategoria: " . $row["subcategoria"] . "</p>";

    if ($isUserMasterOrColaborador) {
        echo "<button class='editar-btn' data-id='" . $row["idProduto"] . "' data-nome='" . $row["nome"] . "' data-preco='" . $row["preco"] . "' data-descricao='" . $row["descricao"] . "' data-categoria='" . $row["categoria"] . "' data-subcategoria='" . $row["subcategoria"] . "'>Editar</button>";
        echo "<button class='excluir-btn' data-id='" . $row["idProduto"] . "'>Excluir</button>";
    }

    echo "<button class='comprar-btn'>Comprar</button>";
    echo "</div>";
}
?>
</div>
<!-- Fim Bloco de Produtos -->

 <!-- Modal de Edição -->
<div id="modalEditar" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Editar Produto</h2>
        <form id="editarForm" method="POST" action="/Seven_Gardens/Back-end/editarProduto.php">
            <input type="hidden" name="idProduto" id="editarId">
            <label for="editarNome">Nome:</label>
            <input type="text" name="nome" id="editarNome" required>
            <br>
            <label for="editarPreco">Preço:</label>
            <input type="text" name="preco" id="editarPreco" required>
            <br>
            <label for="editarDescricao">Descrição:</label>
            <textarea name="descricao" id="editarDescricao" required></textarea>
            <br>
            <label for="editarCategoria">Categoria:</label>
            <input type="text" name="categoria" id="editarCategoria" required>
            <br>
            <label for="editarSubcategoria">Subcategoria:</label>
            <input type="text" name="subcategoria" id="editarSubcategoria" required>
            <br>
            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</div>

  <!-- Modal de Exclusão -->
<div id="modalExcluir" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Excluir Produto</h2>
        <p>Tem certeza de que deseja excluir este produto?</p>
        <form id="excluirForm" method="POST" action="/Seven_Gardens/Back-end/excluirProduto.php">
            <input type="hidden" name="idProduto" id="excluirId">
            <button type="submit">Excluir</button>
            <button type="button" class="cancel-btn">Cancelar</button>
        </form>
    </div>
</div>


  <script>
  // Função para abrir o modal de edição com os dados do produto
// Função para abrir o modal de edição com os dados do produto
document.querySelectorAll('.editar-btn').forEach(button => {
    button.addEventListener('click', function() {
        document.getElementById('editarId').value = this.getAttribute('data-id');
        document.getElementById('editarNome').value = this.getAttribute('data-nome');
        document.getElementById('editarPreco').value = this.getAttribute('data-preco');
        document.getElementById('editarDescricao').value = this.getAttribute('data-descricao');
        document.getElementById('editarCategoria').value = this.getAttribute('data-categoria');
        document.getElementById('editarSubcategoria').value = this.getAttribute('data-subcategoria');
        document.getElementById('modalEditar').style.display = 'block';
    });
});


    // Função para abrir o modal de exclusão com o id do produto
document.querySelectorAll('.excluir-btn').forEach(button => {
    button.addEventListener('click', function() {
        document.getElementById('excluirId').value = this.getAttribute('data-id');
        document.getElementById('modalExcluir').style.display = 'block';
    });
});

    // Fechar o modal quando o usuário clicar no "X"
    document.querySelectorAll('.close').forEach(span => {
      span.addEventListener('click', function() {
        this.parentElement.parentElement.style.display = 'none';
      });
    });

    // Fechar o modal de exclusão quando o usuário clicar no botão "Cancelar"
    document.querySelector('.cancel-btn').addEventListener('click', function() {
      document.getElementById('modalExcluir').style.display = 'none';
    });

    // Fechar os modais quando o usuário clicar fora do modal
    window.addEventListener('click', function(event) {
      if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
      }
    });
  </script>

  <style>
    /* Estilos para os modais */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0, 0, 0);
      background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 500px;
      position: relative;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  </style>
  <!-- Fim do Bloco de Produtos -->

  <div id="itensCarrinho" class="carrinho">
    <!-- Itens do carrinho serão adicionados aqui -->
  </div>


  <!-- ACESSIBILIDADES -->
  <section id="accessibility-section">
    <i class="fas fa-universal-access" id="accessibility-icon"></i>
    <div id="other-things">

      <i class="fas fa-sun" id="light-mode-toggle"></i>
      <i class="fas fa-moon" id="dark-mode-toggle"></i>
      <img class="img_letra" src="Front-end/img/aumentartext_1.svg" alt="" srcset="" id="increase-font"></i>
      <img class="img_letra" src="Front-end/img/diminuirtext_1.svg" alt="" srcset="" id="decrease-font"></i>
    </div>
  </section>
  <!--FIM DA ACESSIBILIDADES -->
  <footer>
    <br>


    <div class="social-icons">
      <p> Siga-nos nas nossas redes sociais:</p>

      <a href="#" class="icon"><i class="fab fa-facebook"></i></a>
      <a href="#" class="icon"><i class="fab fa-instagram"></i></a>
      <a href="#" class="icon"><i class="fab fa-whatsapp"></i></a>


    </div>


  </footer>




  <script src="./Front-end/js/script.js"></script>
</body>

</html>
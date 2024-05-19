<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pedidos</title>
  <link rel="stylesheet" href="../css/Pedidos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
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
            <li class="login"><a href="../html/InterfaceMaster.php">Dashboard</a></li>
            <li class="cadastrar"> <a href="../index.php">Visualizar Home</a></li>
          </ul>
          
        </div>
      </nav>
    </section>
    <section class="opcoes">
      <h2>Painel de controle</h2>
    </section>
  </header>



<form id="user-search-form">
  <h1 class="title">Gerenciamento de Pedidos</h1><br>
  <label for="inputPesquisa">Pesquisar por nome:</label>
  <input type="text" id="inputPesquisa" name="inputPesquisa" placeholder="Digite o nome do usuário"><br><br>
  <button type="submit">Pesquisar</button>
</form>

<table id="tabelaUsuarios">
  <thead>
    <tr>
      <th>ID pedido</th>
       <th>Cliente</th>
       <th>Data</th>
       <th>Valor</th>
       <th>Status</th>
      <!-- Adicione mais colunas conforme necessário -->
    </tr>
  </thead>
  <tbody>
    <!-- Os resultados da consulta serão exibidos aqui -->
  </tbody>
</table>




<!-- ACESSIBILIDADES -->
  <section id="accessibility-section">
    <i class="fas fa-universal-access" id="accessibility-icon"></i>
    <div id="other-things">

      <i class="fas fa-sun" id="light-mode-toggle"></i>
      <i class="fas fa-moon" id="dark-mode-toggle"></i>
      <img class="img_letra" src="../img/aumentartext_1.svg" alt="" srcset="" id="increase-font"></i>
      <img class="img_letra" src="../img/diminuirtext_1.svg" alt="" srcset="" id="decrease-font"></i>
    </div>
  </section>
  <!-- ACESSIBILIDADES -->
<footer>
  <br>
   <p class="social"> Siga-nos nas nossas redes sociais:</p>
  
    <div class="social-icons">
      
        <a href="#" class="icon"><i class="fab fa-facebook"></i></a>
        <a href="#" class="icon"><i class="fab fa-instagram"></i></a>
        <a href="#" class="icon"><i class="fab fa-linkedin"></i></a>
        <a href="#" class="icon"><i class="fab fa-whatsapp""></i></a>
      
      
    </div>
  
</footer>

<script src="../js/pedidos.js"></script>
<script src="../js/acessibilidade.js"></script>
</body>

</html>

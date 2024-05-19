  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../css/ConsultaAdm.css" />
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
            <ul>
              <li class="login"><a href="#">Dashboard</a></li>
              <li class="cadastrar"><a href="../index.php">Visualizar Home</a></li>
            </ul>
          </div>
        </nav>
      </section>

      <section class="opcoes">
        <h2>Painel de controle</h2>
      </section>
    </header>



  <form id="user-search-form">
    <h1 class="title">Consulta de usuário</h1><br>
    <label for="inputPesquisa">Pesquisar por nome:</label>
    <input type="text" id="inputPesquisa" name="inputPesquisa" placeholder="Digite o nome do usuário"><br><br>
    <button type="submit">Pesquisar</button>
  </form>

  <table id="tabelaUsuarios">
    <thead>
      <tr>
        <th>Nome do Usuário</th>
         <th>Ação</th>
        <!-- Adicione mais colunas conforme necessário -->
      </tr>
    </thead>
    <tbody>
      <!-- Os resultados da consulta serão exibidos aqui -->
    </tbody>
  </table>


  <!-- Modal de Confirmação de Exclusão -->
  <div id="modal" class="modal">
    <div class="modal-content">
      <p>Deseja realmente excluir este usuário?</p>
      <button id="confirm-btn">Confirmar</button>
      <button id="cancel-btn">Cancelar</button>
    </div>
  </div>

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
    <!--FIM ACESSIBILIDADES -->

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

  <script src="../js/ConsultaAdm.js"></script>
</body>

</html>

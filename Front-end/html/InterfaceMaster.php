<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Interface Master</title>
  <link rel="shortcut icon" href="../img/logoatual.svg" type="image/x-icon" />
  <link rel="stylesheet" href="../css/InterfaceMaster.css" />
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
            <li class="login">Dashboard</li>
            <li class="cadastrar"><a class="cadastrar" href="../index.html">Visualizar Home</a></li>
          </ul>
        </div>
      </nav>
    </section>

    <section class="opcoes">
      <h2 class="painel">Painel de controle</h2>
    </section>
  </header>

  <!-- Diálogo Modal para Adicionar Produto -->
  <dialog id="modalAdicionarProduto">
    <div class="form-header">
      <h2 class="title">Adicione um produto</h2>
    </div>
    <form>
      <div class="input-box">
        <label for="nomeProduto">Nome do Produto:</label>
        <input type="text" id="nomeProduto" required>
      </div>

      <div class="input-box">
        <label for="precoProduto">Preço:</label>
        <input type="number" id="precoProduto" min="0" step="0.01" required>
      </div>

      <div class="input-box">
        <label for="descricaoProduto">Descrição:</label>
        <textarea id="descricaoProduto" rows="4" required></textarea>
      </div>

      <div class="input-box">
        <label for="tipoProduto">Tipo:</label>
        <select id="tipoProduto" required>
          <option value="singelas">Singelas</option>
          <option value="dobradas">Dobradas</option>
        </select>
      </div>
      <div class="input-box">
        <label for="imagemProduto">Imagem do Produto:</label>
        <div class="custom-file-input">
          <input type="file" id="imagemProduto" accept="image/*" onchange="previewImg(event)" required>
          <button type="button" onclick="document.getElementById('imagemProduto').click()">Escolher arquivo</button>
        </div>
      </div>

      <!-- Área de pré-visualização da imagem -->
      <div id="previewContainer">
        <img id="previewImage" src="#">
      </div>

      <!-- Seus botões de envio e cancelamento -->
      <div class="button-box">
        <button type="submit" id="add_produto">Adicionar</button>
        <button type="button" onclick="fecharModalAdicionarProduto()" id="cancelar_add">Cancelar</button>
      </div>
    </form>
  </dialog>

  <!-- Diálogo Modal para Adicionar Colaborador -->
  <dialog id="modalAdicionarColaborador">
    <div class="form-header">
      <h2 class="title">Adicione um novo colaborador</h2>
    </div>
    <form action="../../Back-end/CadastroColaborador.php" method="post">

      <div id="responseMessage" style="display: none;"></div>

      <div class="input-box">
        <label for="nomeColaborador">Nome completo:</label>
        <input type="text" id="nomeColaborador" name="nome_completo" required>
      </div>

      <div class="input-box">
        <label for="emailColaborador">E-mail:</label>
        <input type="email" id="emailColaborador" name="email" required>
      </div>

      <div class="input-box">
        <label for="telefoneColaborador">Telefone celular:</label>
        <input type="tel" id="telefoneColaborador" name="telefone_celular" required>
      </div>

      <div class="input-box">
        <label for="userNameColaborador">Nome de Usuário:</label>
        <input type="text" id="userNameColaborador" name="user_name" required>
      </div>

      <div class="input-box">
        <label for="senhaColaborador">Senha:</label>
        <input type="password" id="senhaColaborador" name="senha" required>
      </div>

      <div class="button-box">
        <button type="submit" id="add_colaborador">Adicionar</button>
        <button type="button" onclick="fecharModalCadastroColaborador()" id="cancelar_add">Cancelar</button>
      </div>
    </form>
  </dialog>




  <!--cards -->
  <section class="card-container">
    <div class="card">
      <h3>Cadastrar Produto</h3>
      <img src="../img/addProduto.svg" alt="Ícone de adição de produtos para cadastrar novos produtos" class="iconCard" />
      <p>Adicione novos produtos ao seu catálogo.</p>
      <button onclick="abrirModalAdicionarProduto()">Cadastrar</button>
    </div>
    <div class="card">
      <h3>Cadastrar Colaborador</h3>
      <img src="../img/teste verde.svg" alt="Ícone de adicionar novo colaborador" class="iconCard" />
      <p>Adicione novos Colaboradores para administrar.</p>
      <button onclick="abrirModalCadastroColaborador()">Cadastrar</button>
    </div>
    <div class="card">
      <h3>Meus Clientes</h3>
      <img src="../img/clientes.svg" alt="Ícone de lista de clientes para gerenciar e acompanhar seus clientes" class="iconCard" />
      <p>Gerencie e acompanhe seus clientes.</p>
      <a href="ConsultaAdm.html" class="card-button">Ver Clientes</a>
    </div>
    <div class="card">
      <h3>Histórico</h3>
      <img src="../img/historico.svg" alt="Ícone de histórico para visualizar o histórico de acesso dos usuários" class="iconCard" />
      <p>Histórico de acesso dos usuários.</p>
      <a href="Log.html" class="card-button">Ver Histórico</a>
    </div>
    <div class="card">
      <h3>Pedidos</h3>
      <img src="../img/pedidos.svg" alt="Ícone de lista de pedidos para visualizar e gerenciar pedidos pendentes" class="iconCard" />
      <p>Visualize e gerencie pedidos pendentes.</p>
      <a href="Pedidos.html" class="card-button">Ver Pedidos</a>
    </div>
    <div class="card">
      <h3>Relatórios</h3>
      <img src="../img/teste verde.svg" alt="Ícone de relatórios para análises detalhadas com relatórios completos" class="iconCard" />
      <p>Análises detalhadas com relatórios completos.</p>
      <a href="Relatorio.php" class="card-button">Ver Relatórios</a>
    </div>


    <div class="card">
      <h3>Sair</h3>
      <img src="../img/sair.svg" alt="Ícone de saída para encerrar a sessão e sair da plataforma" class="iconCard" />
      <p>Encerre a sessão e saia da plataforma.</p>
      <button class="button secondary" onclick="sair()">Sair</button>
    </div>
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


  <footer>
    <br>
    <div class="social-icons">
      <p> Siga-nos nas nossas redes sociais:</p>

      <a href="https://www.facebook.com/profile.php?id=100063959239107" class="icon" target="_blank"><i class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com/polen_azul?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="icon" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://www.whatsapp.com/catalog/5521981510975/?app_absent=0" class="icon" target="_blank"><i class="fab fa-whatsapp""></i></a>


    </div>
  </footer>

  <!-- JavaScript para Controlar o Diálogo Modal e Pré-visualização da Imagem -->
  <script>
    const modalAdicionarProduto = document.getElementById('modalAdicionarProduto');
    const previewImage = document.getElementById('previewImage');

    function abrirModalAdicionarProduto() {
      modalAdicionarProduto.showModal();
    }

    function fecharModalAdicionarProduto() {
      modalAdicionarProduto.close();
    }

    function previewImg(event) {
      const input = event.target;
      const file = input.files[0];
      const reader = new FileReader();

      reader.onload = function () {
        previewImage.src = reader.result;
      };

      if (file) {
        reader.readAsDataURL(file);
      }
    }
  </script>

          
          <script src=" ../js/acessibilidade.js"></script>

          <script>
            // Função para abrir a modal de cadastro de colaborador
            function abrirModalCadastroColaborador() {
              var modal = document.getElementById("modalAdicionarColaborador");
              if (modal) {
                modal.showModal();
              }
            }

            // Função para fechar a modal de cadastro de colaborador
            function fecharModalCadastroColaborador() {
              var modal = document.getElementById("modalAdicionarColaborador");
              if (modal) {
                modal.close();
              }
            }
          </script>

          <!-- JavaScript para exibir mensagem na modal de cadastro do Colaborador -->
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              const form = document.getElementById('modalAdicionarColaborador').querySelector('form');

              form.addEventListener('submit', function(e) {
                e.preventDefault(); // Impede o envio tradicional do formulário

                const formData = new FormData(this);
                const responseMessageElement = document.getElementById('responseMessage'); // Elemento para mostrar mensagens de resposta

                fetch(this.action, {
                    method: 'POST',
                    body: formData
                  })
                  .then(response => response.json()) // Assume que o servidor responde com JSON
                  .then(data => {
                    responseMessageElement.textContent = data.message; // Define a mensagem de resposta
                    responseMessageElement.style.display = 'block'; // Torna o elemento visível
                    responseMessageElement.style.color = data.success ? 'green' : 'red'; // Muda a cor baseada no sucesso

                    if (data.success) {
                      // Opcional: Limpa o formulário após sucesso
                      form.reset();
                    }
                  })
                  .catch(error => {
                    console.error('Erro:', error);
                    responseMessageElement.textContent = 'Erro ao enviar o formulário.';
                    responseMessageElement.style.display = 'block';
                    responseMessageElement.style.color = 'red'; // Cor vermelha para erros
                  });
              });
            });
          </script>



</body>

</html>
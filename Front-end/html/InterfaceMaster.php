<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Interface Master</title>
  <link rel="shortcut icon" href="../img/logoatual.svg" type="image/x-icon" />
  <link rel="stylesheet" href="../css/InterfaceMaster.css" />
  <link rel="stylesheet" href="../css/headerMaster.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
  <?php include('../../headerMaster.php'); ?>


  <!-- Diálogo Modal para Adicionar Produto -->
  <dialog id="modalAdicionarProduto">
    <div class="form-header">
      <h2 class="title">Adicione um produto</h2>
    </div>
    <form action="../../Back-end/cadastrar_produto.php" method="POST" enctype="multipart/form-data">
      <div class="input-box">
        <label for="nomeProduto">Nome do Produto:</label>
        <input type="text" id="nomeProduto" name="nomeProduto" required>
      </div>

      <div class="input-box">
        <label for="precoProduto">Preço:</label>
        <input type="number" id="precoProduto" name="precoProduto" min="0" step="0.01" required>
      </div>

      <div class="input-box">
        <label for="descricaoProduto">Descrição:</label>
        <textarea id="descricaoProduto" name="descricaoProduto" rows="4" required></textarea>
      </div>

      <div class="input-box">
        <label for="categoriaProduto">Categoria:</label>
        <select id="categoriaProduto" name="categoriaProduto" required>
          <option value="Enxertos">Enxertos</option>
          <option value="Naturais (De semente)">Naturais (De semente)</option>
          <option value="Especiais">Especiais</option>
          <option value="Insumos">Insumos</option>
        </select>
      </div>

      <div class="input-box">
        <label for="subcategoriaProduto">Subcategoria:</label>
        <select id="subcategoriaProduto" name="subcategoriaProduto" required>
          <option value="Multipétalas">Multipétalas</option>
          <option value="Dobradas">Dobradas</option>
          <option value="Singelas">Singelas</option>
          <option value="Fertilizante">Fertilizante</option>
        </select>
      </div>

      <div class="input-box">
        <label for="quantidadeProduto">Quantidade em Estoque:</label>
        <input type="number" id="quantidadeProduto" name="quantidadeProduto" min="0" required>
      </div>

      <div class="input-box">
        <label for="imagemProduto">Imagem do Produto:</label>
        <div class="custom-file-input">
          <input type="file" id="imagemProduto" name="imagemProduto" accept="image/*" onchange="previewImg(event)" required>
          <button type="button" onclick="document.getElementById('imagemProduto').click()">Escolher arquivo</button>
        </div>
      </div>

      <!-- Área de pré-visualização da imagem -->
      <div id="previewContainer">
        <img id="previewImage" src="#" alt="Imagem de pré-visualização" style="display:none;">
      </div>

      <!-- Elemento para exibir a mensagem de resposta -->
      <div id="responseMessageProduto" style="display:none;"></div>

      <!-- Seus botões de envio e cancelamento -->
      <div class="button-box">
        <button type="submit" id="add_produto">Adicionar</button>
        <button type="button" onclick="fecharModalAdicionarProduto()" class="cancelar_add" style=" background-color: #405b39;color: white; border: none;padding: 10px 20px;border-radius: 5px;cursor: pointer;font-size: 1rem;">Cancelar</button>
      </div>
    </form>
  </dialog>


  <dialog  id="modalAdicionarColaborador">
    <div class="form-header">
      <h2 class="title">Adicione um novo colaborador</h2>
    </div>
    <form id="formAdicionarColaborador" action="../../Back-end/CadastroColaborador.php" method="post">
      <div id="responseMessage" style="display: none;"></div>

      <div class="input-box">
        <input type="hidden" name="acao" value="cadastrar">
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
        <label for="logradouro">Endereço:</label>
        <input type="text" id="logradouro" name="logradouro" required>
      </div>

      <div class="input-box">
        <label for="username">Nome de usuário (6 caracteres alfabéticos):</label>
        <input type="text"  maxlength="6" id="username" name="username" pattern="[a-zA-Z]{6}" title="O nome de usuário deve conter apenas letras e ter 6 caracteres." required>
      </div>

      <div class="input-box">
        <label for="password">Senha (8 caracteres alfabéticos):</label>
        <input type="password" maxlength="8" id="password" name="password" pattern="[a-zA-Z]{8}" title="A senha deve conter apenas letras e ter 8 caracteres." required>
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
      <h3>Contas Cadastradas</h3>
      <img src="../img/clientes.svg" alt="Ícone de lista de clientes para gerenciar e acompanhar seus clientes" class="iconCard" />
      <p>Gerencie e acompanhe seus usuários.</p>
      <a href="Relatorio.php" class="card-button">Ver Cadastros</a>
    </div>
    <div class="card">
      <h3>Histórico</h3>
      <img src="../img/historico.svg" alt="Ícone de histórico para visualizar o histórico de acesso dos usuários" class="iconCard" />
      <p>Histórico de acesso dos usuários.</p>
      <a href="Log.php" class="card-button">Ver Histórico</a>
    </div>
    <div class="card">
      <h3>Pedidos</h3>
      <img src="../img/pedidos.svg" alt="Ícone de lista de pedidos para visualizar e gerenciar pedidos pendentes" class="iconCard" />
      <p>Visualize e gerencie pedidos pendentes.</p>
      <a href="Pedidos.php" class="card-button">Ver Pedidos</a>
    </div>
    <div class="card">
      <h3>Modelo do Banco de Dados</h3>
      <img src="../img/teste verde.svg" alt="Ícone de relatórios para análises detalhadas com relatórios completos" class="iconCard" />
      <p>Conheça um pouco da estrutura do sistema.</p>
      <a href="Relatorio.php" class="card-button">Ver Modelo</a>
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
          
          <script src=" ../js/acessibilidade.js"></script>
          <?php require_once('../../Back-end/Logica_de_Botoes.php'); ?>

          <?php
          // Verificação de sessão para determinar se o usuário é um Colaborador
          // session_start();
          if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'Colaborador') {
            echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
      const buttons = document.querySelectorAll(".card-container .card:nth-child(3) .card-button, .card-container .card:nth-child(4) .card-button, .card-container .card:nth-child(2) button");
      buttons.forEach(button => {
        button.disabled = true;
        button.style.backgroundColor = "gray";
        button.addEventListener("click", function(event) {
          event.preventDefault(); // Impede a ação padrão do clique
        });
      });
    });
</script>';
          }
          ?>
<script>
            document.addEventListener('DOMContentLoaded', function() {
              const modalAdicionarProduto = document.getElementById('modalAdicionarProduto');
              const form = modalAdicionarProduto.querySelector('form');
              const previewImage = document.getElementById('previewImage');
              const responseMessageElement = document.getElementById('responseMessageProduto');

              window.abrirModalAdicionarProduto = function() {
                modalAdicionarProduto.showModal();
              };

              window.fecharModalAdicionarProduto = function() {
                modalAdicionarProduto.close();
                form.reset();
                previewImage.src = "#";
                previewImage.style.display = 'none';
                responseMessageElement.style.display = 'none';
              };

              document.getElementById('imagemProduto').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                  const reader = new FileReader();
                  reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                  };
                  reader.readAsDataURL(file);
                }
              });

              form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                fetch(this.action, {
                    method: 'POST',
                    body: formData
                  })
                  .then(response => response.json())
                  .then(data => {
                    responseMessageElement.textContent = data.message;
                    responseMessageElement.style.display = 'block';
                    responseMessageElement.style.color = data.success ? 'green' : 'red';
                    if (data.success) {
                      form.reset();
                      previewImage.src = "#";
                      previewImage.style.display = 'none';
                    }
                  })
                  .catch(error => {
                    console.error('Erro:', error);
                    responseMessageElement.textContent = 'Erro ao enviar o formulário.';
                    responseMessageElement.style.display = 'block';
                    responseMessageElement.style.color = 'red';
                  });
              });
            });
          </script>

</body>

</html>
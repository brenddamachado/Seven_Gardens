<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta de Colaboradores</title>
  <link rel="stylesheet" href="../css/ConsultaColaboradores.css">
  <link rel="stylesheet" href="../css/headerMaster.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
  <?php include('../../headerMaster.php'); ?>

  <form id="colaborador-search-form">
    <h1 class="title">Consulta de Colaborador</h1><br>
    <label for="inputPesquisa">Pesquisar por nome:</label>
    <input type="text" id="inputPesquisa" name="inputPesquisa" placeholder="Digite o nome do colaborador"><br><br>
    <button type="submit">Pesquisar</button>
  </form>

  <table id="tabelaColaboradores" class="tabelaCentral">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome do Colaborador</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody>
      <!-- Os resultados da consulta serão exibidos aqui -->
    </tbody>
  </table>

  <!-- Modal de Confirmação de Exclusão -->
  <div id="modal" class="modal">
    <div class="modal-content">
      <p>Deseja realmente excluir este colaborador?</p>
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
      <img class="img_letra" src="../img/aumentartext_1.svg" alt="" id="increase-font">
      <img class="img_letra" src="../img/diminuirtext_1.svg" alt="" id="decrease-font">
    </div>
  </section>
  <!-- FIM ACESSIBILIDADES -->

  <footer>
    <br>
    <p class="social">Siga-nos nas nossas redes sociais:</p>
    <div class="social-icons">
      <a href="#" class="icon"><i class="fab fa-facebook"></i></a>
      <a href="#" class="icon"><i class="fab fa-instagram"></i></a>
      <a href="#" class="icon"><i class="fab fa-linkedin"></i></a>
      <a href="#" class="icon"><i class="fab fa-whatsapp"></i></a>
    </div>
  </footer>
  <script src="../js/acessibilidade.js"></script>
  <script src="../js/Colaboradores.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Função para buscar e exibir os colaboradores
      function fetchColaboradores() {
        fetch('consultaColaboradores.php')
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              const tbody = document.querySelector('#tabelaColaboradores tbody');
              tbody.innerHTML = '';
              data.colaboradores.forEach(colaborador => {
                const row = document.createElement('tr');
                row.innerHTML = `
                  <td>${colaborador.idUsuario}</td>
                  <td>${colaborador.nome_completo}</td>
                  <td><button class="delete-btn" data-id="${colaborador.idUsuario}">Excluir</button></td>
                `;
                tbody.appendChild(row);
              });
            } else {
              console.error('Erro ao buscar colaboradores:', data.message);
            }
          })
          .catch(error => console.error('Erro ao buscar colaboradores:', error));
      }

      // Busca inicial dos colaboradores
      fetchColaboradores();

      // Adiciona um evento de clique para o botão de excluir
      document.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-btn')) {
          const idColaborador = event.target.dataset.id;
          if (confirm('Deseja realmente excluir este colaborador?')) {
            // Função para excluir o colaborador (implementar a chamada ao backend)
            console.log('Excluir colaborador ID:', idColaborador);
          }
        }
      });

      // Formulário de pesquisa de colaboradores
      document.querySelector('#colaborador-search-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const query = document.querySelector('#inputPesquisa').value;
        fetch(`consultaColaboradores.php?inputPesquisa=${query}`)
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              const tbody = document.querySelector('#tabelaColaboradores tbody');
              tbody.innerHTML = '';
              data.colaboradores.forEach(colaborador => {
                const row = document.createElement('tr');
                row.innerHTML = `
                  <td>${colaborador.idUsuario}</td>
                  <td>${colaborador.nome_completo}</td>
                  <td><button class="delete-btn" data-id="${colaborador.idUsuario}">Excluir</button></td>
                `;
                tbody.appendChild(row);
              });
            } else {
              console.error('Erro ao buscar colaboradores:', data.message);
            }
          })
          .catch(error => console.error('Erro ao buscar colaboradores:', error));
      });
    });
  </script>
</body>
</html>

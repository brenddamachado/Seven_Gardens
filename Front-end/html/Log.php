<?php
session_start();
require '../../Front-end/PHP/connect.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit();
}

function buscarHistorico($pdo, $pesquisa)
{
  // Remove qualquer caractere que não seja numérico do CPF
  $pesquisa = preg_replace("/[^0-9]/", "", $pesquisa);

  $query = "
    SELECT 
        h.horarioLogin, 
        u.nome_completo, 
        p.pergunta,
        h.id_usuario 
    FROM 
        historico_login h 
    JOIN 
        usuario u 
    ON 
        h.id_usuario = u.idUsuario
    JOIN 
        pergunta_secreta p
    ON 
        h.id_pergunta_secreta = p.id
    WHERE 
        REPLACE(REPLACE(REPLACE(u.cpf, '.', ''), '-', ''), ' ', '') LIKE :cpf
        OR u.nome_completo LIKE :pesquisa 
        OR h.id_usuario = :id 
        OR p.pergunta LIKE :pesquisa 
        OR DATE(h.horarioLogin) = :data
    ORDER BY 
        h.horarioLogin DESC";

  $stmt = $pdo->prepare($query);
  $likePesquisa = "%$pesquisa%";
  $stmt->bindParam(':cpf', $pesquisa);
  $stmt->bindParam(':pesquisa', $likePesquisa);
  if (is_numeric($pesquisa)) {
    $stmt->bindValue(':id', (int)$pesquisa, PDO::PARAM_INT);
  } else {
    $stmt->bindValue(':id', null, PDO::PARAM_NULL);
  }
  $stmt->bindValue(':data', $pesquisa);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function listarHistorico($pdo)
{
  $query = "
    SELECT 
        h.horarioLogin, 
        u.nome_completo, 
        p.pergunta,
        h.id_usuario 
    FROM 
        historico_login h 
    JOIN 
        usuario u 
    ON 
        h.id_usuario = u.idUsuario
    JOIN 
        pergunta_secreta p
    ON 
        h.id_pergunta_secreta = p.id
    ORDER BY 
        h.horarioLogin DESC";

  $stmt = $pdo->prepare($query);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$historico = listarHistorico($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inputPesquisa'])) {
  $pesquisa = $_POST['inputPesquisa'];
  $result = buscarHistorico($pdo, $pesquisa);
  header("Content-Type: application/json");
  echo json_encode($result);
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Seven Gardens</title>
  <link rel="stylesheet" href="../css/Log.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .table thead th {
      position: sticky;
      top: 0;
      z-index: 1;
      background-color: white;
    }
  </style>
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

  <section class="filtroo">
    <h4 id="openFilterForm" ><i class="fas solid fa-filter"></i> Filtro</h4>
    <div id="filterFormContainer" style="display: none;">
      <form id="filterForm">
        <h1>Histórico de login</h1>
        <label for="inputPesquisa">Pesquisar (ID, Nome, CPF, Pergunta Secreta ou Data):</label>
        <input type="text" id="inputPesquisa" name="inputPesquisa" placeholder="Digite o termo de pesquisa">
        <br><br>
        <button type="submit" class="btn btn-primary">Pesquisar</button>
      </form>
    </div>
  </section>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID do Cliente</th>
        <th>Nome</th>
        <th>Data e hora</th>
        <th>Pergunta Secreta</th>
      </tr>
    </thead>
    <tbody id="tabelaBody">
      <?php foreach ($historico as $row) : ?>
        <tr>
          <td><?php echo htmlspecialchars($row['id_usuario']); ?></td>
          <td><?php echo htmlspecialchars($row['nome_completo']); ?></td>
          <td><?php echo htmlspecialchars(date('d/m/Y H:i:s', strtotime($row['horarioLogin']))); ?></td>
          <td><?php echo htmlspecialchars($row['pergunta']); ?></td>
        </tr>
      <?php endforeach; ?>
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
      <a href="#" class="fab fa-instagram"></a>
      <a href="#" class="fab fa-whatsapp"></a>
    </div>
  </footer>

  <!-- JavaScript direto no arquivo HTML -->
  <script src="../js/acessibilidade.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      console.log("DOM totalmente carregado e analisado");

      var openButton = document.getElementById('openFilterForm');
      var filterFormContainer = document.getElementById('filterFormContainer');
      var filterForm = document.getElementById('filterForm');
      var tabelaBody = document.getElementById('tabelaBody');

      if (openButton) {
        openButton.addEventListener('click', function() {
          console.log("Clicou no filtro");
          if (filterFormContainer.style.display === "none" || filterFormContainer.style.display === "") {
            filterFormContainer.style.display = "block";
          } else {
            filterFormContainer.style.display = "none";
          }
        });
      } else {
        console.log("openFilterForm não encontrado");
      }

      if (filterForm) {
        filterForm.addEventListener('submit', function(event) {
          event.preventDefault();
          var formData = new FormData(filterForm);
          var inputPesquisa = formData.get('inputPesquisa');

          // Verifica se o valor de pesquisa é numérico
          if (!isNaN(inputPesquisa) && inputPesquisa !== '') {
            formData.set('idUsuario', inputPesquisa);
          }

          fetch('', {
              method: 'POST',
              body: formData
            })
            .then(response => response.json())
            .then(data => {
              console.log(data);
              tabelaBody.innerHTML = ''; // Limpa a tabela
              if (data.error) {
                tabelaBody.innerHTML = '<tr><td colspan="4">' + data.error + '</td></tr>';
              } else if (data.length > 0) {
                data.forEach(item => {
                  var row = document.createElement('tr');
                  row.innerHTML = `
                <td>${item.id_usuario}</td>
                <td>${item.nome_completo}</td>
                <td>${new Date(item.horarioLogin).toLocaleString('pt-BR')}</td>
                <td>${item.pergunta}</td>
              `;
                  tabelaBody.appendChild(row);
                });
              } else {
                tabelaBody.innerHTML = '<tr><td colspan="4">Nenhum registro encontrado.</td></tr>';
              }
            })
            .catch(error => {
              console.error('Erro:', error);
              tabelaBody.innerHTML = '<tr><td colspan="4">Erro ao buscar dados.</td></tr>';
            });
        });
      }
    });
  </script>
</body>

</html>

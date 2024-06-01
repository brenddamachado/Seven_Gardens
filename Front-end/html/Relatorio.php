<?php require '../../Front-end/PHP/connect.php';
?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relatório de Clientes</title>
  <link rel="stylesheet" href="../css/Relatorio.css">
  <link rel="stylesheet" href="../css/headerMaster.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
  <link rel="icon" href="../img/iconlogo.ico" type="image/x-icon">

</head>

<body>

  <?php include('../../headerMaster.php'); ?>

  <main>
  <section class="filtroo">
    <h4 id="openFilterForm" ><i class="fas solid fa-filter"></i> Filtro</h4>
    <div id="filterFormContainer" style="display: none;">
    <form id="user-search-form">
      <h1 class="title">Contas Cadastradas</h1><br>
      <label for="inputPesquisa">Pesquisar por nome:</label>
      <input type="text" id="inputPesquisa" name="inputPesquisa" placeholder="Digite o nome do usuário"><br><br>
      <button type="submit">Pesquisar</button>
    </form>
    </div>
  </section>
    

    <section id="client-table">
      <div class="icon-clientes">
        <img src="../img/clientes.svg" alt="Ícone de lista de clientes para gerenciar e acompanhar seus clientes" class="iconCard" />
        <h2 class="listar-usuarios">Lista de Usuários</h2>
      </div>

      <table id="tabelaUsuarios">
        <thead>
          <tr>
            <th>ID do Cliente</th>
            <th>Nome</th>
            <th>Tipo de Usuário</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include('../PHP/connect.php'); // Inclui e executa o arquivo, conectando ao banco de dados com PDO

          // Ajuste a consulta SQL para incluir as colunas tipo_usuario de cliente e colaborador
          $sql = "SELECT idUsuario, nome_completo, tipo_usuario FROM usuario WHERE tipo_usuario IN ('cliente', 'colaborador')";
          $stmt = $pdo->prepare($sql);  // Alterado para usar $pdo
          $stmt->execute();

          $data = $stmt->fetchAll(PDO::FETCH_ASSOC); // Busca todos os dados e retorna como array associativo

          if (!empty($data)) {
            foreach ($data as $row) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['idUsuario']) . "</td>"; // Usar htmlspecialchars para evitar XSS
              echo "<td>" . htmlspecialchars($row['nome_completo']) . "</td>";
              echo "<td>" . htmlspecialchars($row['tipo_usuario']) . "</td>"; // Mostra o tipo de usuário
              echo "<td><button class='delete-btn' data-id='" . htmlspecialchars($row['idUsuario']) . "' data-modal='true'>Excluir</button></td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='4'>Nenhum resultado encontrado</td></tr>"; // Ajuste o colspan para corresponder ao número de colunas
          }
          ?>
        </tbody>
      </table>

      <div id="modal" class="modal">
        <div class="modal-content">
          <span id="modal-message"></span>
          <div class="modal-buttons">
            <button id="confirm-btn">Confirmar</button>
            <button id="cancel-btn">Cancelar</button>
          </div>
        </div>
      </div>


      <div class="btn-download">
        <button class="btn-download-2" onclick="downloadPDF()">Baixar PDF</button>
      </div>
    </section>
  </main>

  <!-- ACESSIBILIDADES -->
  <section id="accessibility-section">
    <i class="fas fa-universal-access" id="accessibility-icon"></i>
    <div id="other-things">
      <i class="fas fa-moon" id="dark-mode-toggle"></i>
      <i class="fas fa-sun" id="light-mode-toggle"></i>
      <img class="img_letra" src="../img/aumentartext_1.svg" alt="" srcset="" id="increase-font"></i>
      <img class="img_letra" src="../img/diminuirtext_1.svg" alt="" srcset="" id="decrease-font"></i>
    </div>
  </section>
  <!--FIM ACESSIBILIDADES -->

  <footer>
    <br>
    <div class="social-icons">
      <p> Siga-nos nas nossas redes sociais:</p>

      <a href="https://www.facebook.com/profile.php?id=100063959239107" class="icon" target="_blank"><i class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com/polen_azul?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="icon" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://www.whatsapp.com/catalog/5521981510975/?app_absent=0" class="icon" target="_blank"><i class="fab fa-whatsapp""></i></a>


    </div>
  </footer>

  <script src=" ../js/client-report.js"></script>
</body>
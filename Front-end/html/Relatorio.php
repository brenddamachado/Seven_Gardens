<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relatório de Clientes</title>
  <link rel="stylesheet" href="../css/Relatorio.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
  <link rel="icon" href="../img/iconlogo.ico" type="image/x-icon">

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
            <li class="cadastrar">Visualizar Home</li>
          </ul>
        </div>
      </nav>
    </section>

    <section class="opcoes">
      <h2>Painel de controle</h2>
    </section>
  </header>

  <main>
    <section id="report-summary">
      <h1>Sumário do Relatório de Clientes</h1>
      <p>Total de Clientes Registrados: <strong>150</strong></p>
      <p>Principais Compradores: <strong>30</strong></p>
    </section>

    <section id="client-table">
      <div class="icon-clientes">
        <img src="../img/clientes.svg" alt="Ícone de lista de clientes para gerenciar e acompanhar seus clientes" class="iconCard" />
        <h2>Lista de Clientes</h2>
      </div>
      <table id="tabelaUsuarios">
        <thead>
          <tr>
            <th>ID do Cliente</th>
            <th>Nome</th>
            <th>Compras</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include('../PHP/connect.php'); // Inclui e executa o arquivo, conectando ao banco de dados com PDO

          $sql = "SELECT idUsuario, nome_completo FROM usuario"; // Consulta SQL para buscar os usuários
          $stmt = $conn->prepare($sql);
          $stmt->execute();

          $data = $stmt->fetchAll(PDO::FETCH_ASSOC); // Busca todos os dados e retorna como array associativo

          if (!empty($data)) {
            foreach ($data as $row) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['idUsuario']) . "</td>"; // Usar htmlspecialchars para evitar XSS
              echo "<td>" . htmlspecialchars($row['nome_completo']) . "</td>";
              echo "<td>Compras</td>"; // Ajuste conforme necessário
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='3'>Nenhum resultado encontrado</td></tr>"; // Exibe esta mensagem se $data estiver vazio
          }
          ?>
        </tbody>

      </table>

      <div class="btn-download">
        <button onclick="downloadPDF()">Baixar PDF</button>
      </div>
    </section>
  </main>

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
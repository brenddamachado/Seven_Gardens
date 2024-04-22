// arquivo: fetchData.php
<?php
$host = 'localhost'; // ou o IP do servidor de banco de dados
$dbname = 'sevengardens';
$username = 'root';
$password = '';

// Cria a conexão com o banco de dados
$conn = new mysqli($host, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Consulta para buscar dados
$sql = "SELECT id, nome, compras FROM clientes";
$result = $conn->query($sql);

// Verifica se a consulta retornou linhas
if ($result->num_rows > 0) {
  $data = [];

  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }

  // Retorna os dados em formato JSON
  echo json_encode($data);
} else {
  echo "0 results";
}

$conn->close();
?>
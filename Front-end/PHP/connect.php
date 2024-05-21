<?php
$host = 'localhost';
$dbname = 'sevengardens';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  // Em vez de redirecionar, retorne um erro em JSON
  header('Content-Type: application/json');  // Define o cabeçalho de tipo de conteúdo como JSON
  echo json_encode(['success' => false, 'message' => 'Erro de conexão com o banco de dados: ' . $e->getMessage()]);
  exit;
}
?>
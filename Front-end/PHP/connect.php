<?php
$host = 'localhost';
$dbname = 'sevengardens';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  // Redireciona para a página de erro na pasta Front-end
  header('Location: ../Front-end/Erro.html');
  exit;
}

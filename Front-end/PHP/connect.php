<?php
$host = '127.0.0.1';
$dbname = 'sevengardens';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Redireciona para a página de erro na pasta Front-end
    header('Location: ../Front-end/Erro.html');
    exit;
}
?>

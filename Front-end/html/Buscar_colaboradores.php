<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sua_base_de_dados"; /* <<<<<Colocar o Nome>>>>>>> */

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$query = $data['query'];

$sql = "SELECT idUsuario, nome_completo FROM usuario WHERE tipo_usuario = 'Colaborador' AND nome_completo LIKE ?";
$stmt = $conn->prepare($sql);
$search = "%{$query}%";
$stmt->bind_param('s', $search);
$stmt->execute();
$result = $stmt->get_result();

$colaboradores = [];
while ($row = $result->fetch_assoc()) {
    $colaboradores[] = $row;
}

echo json_encode($colaboradores);

$stmt->close();
$conn->close();
?>

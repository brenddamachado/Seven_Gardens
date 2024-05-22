<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sua_base_de_dados";   /* <<<<<Colocar o Nome>>>>>>> */

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

$sql = "DELETE FROM usuario WHERE idUsuario = ? AND tipo_usuario = 'Colaborador'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$success = $stmt->execute();

$response = ["success" => $success];
echo json_encode($response);

$stmt->close();
$conn->close();
?>

<?php
global $conn;
$db_name = 'seven_gardens_db';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

try {
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
} catch (Throwable $th) {
    throw $th;
}
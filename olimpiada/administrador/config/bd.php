<?php 
$host = "localhost";
$bd = "olimpiadas";
$usuario = "root";
$contrasenia = "";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd", $usuario, $contrasenia);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $ex) {
    die("Error de conexión: " . $ex->getMessage());
}
?>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    $producto = array(
        'id' => $id,
        'nombre' => $nombre,
        'precio' => $precio,
        'cantidad' => $cantidad
    );

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    $_SESSION['carrito'][] = $producto;

    header("Location: ver_carrito.php");
    exit();
}
?>

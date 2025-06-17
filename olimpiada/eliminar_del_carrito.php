<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $indice = $_POST['indice'];
    
    if (isset($_SESSION['carrito'][$indice])) {
        unset($_SESSION['carrito'][$indice]);
        $_SESSION['carrito'] = array_values($_SESSION['carrito']); // reordenar índices
    }
}

header("Location: ver_carrito.php");
exit();
?>

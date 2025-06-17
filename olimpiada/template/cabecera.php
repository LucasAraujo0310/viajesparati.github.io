<?php
// Evitar error si ya hay sesión activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Obtener carrito o array vacío
$carrito = $_SESSION['carrito'] ?? [];

// Calcular total de cantidad
$total_cantidad = 0;
foreach ($carrito as $item) {
    $total_cantidad += $item['cantidad'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>VIAJES PARA TI</title>

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/styledefooter.css" />
  <link rel="stylesheet" href="./css/estilodeautol.css"/>

  
  <link rel="stylesheet" href="./css/estadias.css" />
</head>
<body>

<header>
  <div class="container">
    <nav aria-label="Primary navigation">
      <a href="index.php" class="logo" tabindex="0">AEROLÍNEAS ARGENTINAS</a>
       
      <div class="mi-bloque">
        <ul>
          <!-- Ícono de avión como enlace -->
          <li>
            <a href="pasajesaereos.php" title="Vuelos">
              <i class="bi bi-airplane" style="font-size: 2rem; color: white;"></i>
            </a>
          </li>
          <li>
            <a href="estadias.php" title="Estadías">
              <i class="bi bi-house-door" style="font-size: 2rem; color: white;"></i>
            </a>
          </li>
          <li>
            <a href="alquilerdeauto.php" title="Autos">
              <i class="bi bi-car-front" style="font-size: 2rem; color: white;"></i>
            </a>
          </li>
          <li>
            <a href="paquetes.php" tabindex="0" title="Paquetes completos">
              <i class="bi bi-box-seam" style="font-size: 2rem; color: white;"></i>
            </a>
          </li>
        </ul>
      </div>

      <!-- Contenedor para carrito, usuario y buscador -->
      <div class="d-flex align-items-center gap-3">
        <div>
          <!-- Contenedor para usuario, carrito y buscador -->
          <div class="d-flex align-items-center gap-3">
            <!-- Icono usuario -->
            <a href="registrarse.php" title="Iniciar sesión o registrarse" class="icono-navbar">
              <i class="bi bi-person-circle"></i>
            </a>

            <a href="ver_carrito.php" class="cart-button" aria-label="Ir al carrito">
              <i class="bi bi-cart4"></i>
              <?php if ($total_cantidad > 0): ?>
                <span class="cart-count" id="cartCount"><?php echo $total_cantidad; ?></span>
              <?php endif; ?>
            </a>

            <!-- Buscador -->
            <form class="search-form" role="search">
              <input class="form-control" type="search" placeholder="Buscar" />
              <button class="btn btn-buscar" type="submit">Buscar</button>
            </form>
          </div>
        </div>
      </div>
    </nav>
  </div>
</header>

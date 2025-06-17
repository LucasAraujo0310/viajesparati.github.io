<?php
session_start();

// Procesar producto recibido y agregarlo al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto'])) {
  $producto = $_POST['producto'];

  // Precios definidos
  $precios = [
    "Suite de Lujo en Playa" => 300,
    "Apartamento Urbano Moderno" => 180,
    "Cabaña Acogedora en el Campo" => 80,
    "Refugio en Montaña" => 150,
    "Hostal Económico en Playa" => 60,
  ];

  $precio = $precios[$producto] ?? 0;

  if ($precio > 0) {
    if (!isset($_SESSION['carrito'])) {
      $_SESSION['carrito'] = [];
    }

    // Ver si ya está en el carrito
    $encontrado = false;
    foreach ($_SESSION['carrito'] as &$item) {
      if ($item['nombre'] === $producto) {
        $item['cantidad']++;
        $encontrado = true;
        break;
      }
    }
    unset($item); // liberar referencia

    // Si no se encontró, agregarlo nuevo
    if (!$encontrado) {
      $_SESSION['carrito'][] = [
        'nombre' => $producto,
        'cantidad' => 1,
        'precio' => $precio
      ];
    }

    // Redirigir al carrito
    header("Location: ver_carrito.php");
    exit();
  }
}
?>
<?php include("template/cabecera.php"); ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet" />

<main class="reserva-estadias container" role="main">
  <header>
    <h1>Reserva tu Estadía Ideal</h1>
    <p> encuentra alojamientos con comodidad y precios ajustados a ti.</p>  
  </header>
  

  <section class="filters" aria-label="Filtros de búsqueda de estadías">
    <!-- filtros (si los tienes) -->
  </section>

  <section class="gallery" id="gallery" aria-label="Galería de estadías y alojamientos">
    <?php
    // Listado de productos
    $estadias = [
      ["nombre" => "Suite de Lujo en Playa", "precio" => 300, "imagen" => "https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80", "descripcion" => "Habitación con balcón privado y vista panorámica al océano."],
      ["nombre" => "Apartamento Urbano Moderno", "precio" => 180, "imagen" => "https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80", "descripcion" => "Alojamiento céntrico con diseño contemporáneo y todas las comodidades."],
      ["nombre" => "Cabaña Acogedora en el Campo", "precio" => 80, "imagen" => "https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80", "descripcion" => "Escapa del ruido y disfruta la naturaleza en esta cálida cabaña."],
      ["nombre" => "Refugio en Montaña", "precio" => 150, "imagen" => "https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80", "descripcion" => "Disfruta la tranquilidad en un refugio moderno con vistas increíbles."],
      ["nombre" => "Hostal Económico en Playa", "precio" => 60, "imagen" => "https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80", "descripcion" => "Alojamiento básico y cómodo a pocos pasos del mar."]
    ];

    foreach ($estadias as $estadia):
    ?>
      <article class="card" tabindex="0">
        <img src="<?php echo $estadia['imagen']; ?>" alt="<?php echo htmlspecialchars($estadia['descripcion']); ?>" loading="lazy" />
        <div class="card-content">
          <h2 class="card-title"><?php echo $estadia['nombre']; ?></h2>
          <p class="card-description"><?php echo $estadia['descripcion']; ?></p>
          <div class="card-price">$<?php echo $estadia['precio']; ?> por noche</div>
          <form method="post">
            <input type="hidden" name="producto" value="<?php echo $estadia['nombre']; ?>">
            <button type="submit" class="buy-btn" aria-label="Comprar <?php echo $estadia['nombre']; ?>">Comprar</button>
          </form>
        </div>
      </article>
    <?php endforeach; ?>
  </section>
</main>

<script src="./javascript/scriptdeestadia.js"></script>
<?php include("template/pie.php"); ?>

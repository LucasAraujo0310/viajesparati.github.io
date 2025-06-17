<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Agregar producto desde GET (cuando se clickea "Comprar" en la página de vuelos)
if (isset($_GET['nombre']) && isset($_GET['precio'])) {
    // Sanitizamos manualmente el nombre para evitar usar filtro obsoleto
    $nombre = strip_tags(trim($_GET['nombre']));
    $precio = filter_var($_GET['precio'], FILTER_VALIDATE_FLOAT);

    if ($nombre && $precio !== false) {
        // Verificar si el producto ya está en el carrito para aumentar cantidad
        $existe = false;
        foreach ($_SESSION['carrito'] as &$item) {
            if ($item['nombre'] === $nombre) {
                $item['cantidad']++;
                $existe = true;
                break;
            }
        }
        if (!$existe) {
            $_SESSION['carrito'][] = [
                'nombre' => $nombre,
                'precio' => $precio,
                'cantidad' => 1,
            ];
        }
    }
}

$carrito = $_SESSION['carrito'] ?? [];
$mensaje = "";

// Procesar acciones del carrito (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['eliminar'])) {
        $indiceEliminar = (int)$_POST['eliminar'];
        if (isset($_SESSION['carrito'][$indiceEliminar])) {
            unset($_SESSION['carrito'][$indiceEliminar]);
            $_SESSION['carrito'] = array_values($_SESSION['carrito']);
            $mensaje = "Producto eliminado correctamente.";
        }
        $carrito = $_SESSION['carrito'];
    }

    if (isset($_POST['actualizar'])) {
        foreach ($_POST['cantidades'] as $indice => $cantidad) {
            $cantidad = (int)$cantidad;
            if ($cantidad > 0) {
                $_SESSION['carrito'][$indice]['cantidad'] = $cantidad;
            } else {
                unset($_SESSION['carrito'][$indice]);
            }
        }
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
        $carrito = $_SESSION['carrito'];
        $mensaje = "Carrito actualizado correctamente.";
    }

    if (isset($_POST['comprar'])) {
        $_SESSION['carrito'] = [];
       $_SESSION['carrito'] = [];
        header("Location: procesamientodepagos.php");
    exit;
    }
}
?>

<?php include("template/cabecera.php"); ?>

<link rel="stylesheet" href="./css/estilodecarrito.css"/>

<div class="mi-carrito">
  <header>
    <h1>Tu Carrito de Compras</h1>
  </header>

  <?php if ($mensaje): ?>
    <p style="color: green; font-weight: bold;"><?php echo htmlspecialchars($mensaje); ?></p>
  <?php endif; ?>

  <main>
    <form action="" method="post" novalidate>
      <table aria-label="Lista de productos en el carrito">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($carrito)): ?>
            <tr>
              <td colspan="5">No hay productos en el carrito.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($carrito as $index => $item):
              $subtotal = $item['precio'] * $item['cantidad'];
            ?>
              <tr>
                <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                <td>
                  <input
                    type="number"
                    name="cantidades[<?php echo $index; ?>]"
                    value="<?php echo htmlspecialchars($item['cantidad']); ?>"
                    min="0"
                    style="width: 50px;"
                    aria-label="Cantidad de <?php echo htmlspecialchars($item['nombre']); ?>"
                  />
                </td>
                <td>$<?php echo number_format($item['precio'], 2); ?></td>
                <td>$<?php echo number_format($subtotal, 2); ?></td>
                <td>
                  <button
                    type="submit"
                    name="eliminar"
                    value="<?php echo $index; ?>"
                    aria-label="Eliminar <?php echo htmlspecialchars($item['nombre']); ?>"
                    style="background: none; border: none; color: red; cursor: pointer;"
                  >
                    Eliminar
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>

      <?php
      $total = 0;
      foreach ($carrito as $item) {
          $total += $item['precio'] * $item['cantidad'];
      }
      ?>

      <div class="totals" aria-live="polite" style="margin-top: 1rem;">
        <span><strong>Total: $<?php echo number_format($total, 2); ?></strong></span>
      </div>

      <?php if (!empty($carrito)): ?>
        <div style="margin-top: 1rem;">
          <button type="submit" name="actualizar" value="true">Actualizar Carrito</button>
         <a href="procesamientodepagos.php" style="margin-left: 1rem; padding: 8px 12px; background-color: green; color: white; text-decoration: none; border-radius: 4px;">
      Comprar
      </a>
        </div>
      <?php endif; ?>
    </form>
  </main>
</div>

<?php include("template/pie.php"); ?>


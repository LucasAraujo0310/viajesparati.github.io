<?php include("template/cabecera.php"); ?>

<link rel="stylesheet" href="./css/styledepasajes.css" />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

<div class="flight-app">
  <div class="container" role="main">
    <header>
      <h1>Compra tus Pasajes de Vuelo</h1>
      <p>Encuentra y reserva vuelos al mejor precio, de forma rápida y segura.</p>
    </header>

    <form class="flight-form" aria-label="Formulario para compra de pasajes de vuelo" novalidate>
      <!-- Campos del formulario -->
      <div class="input-group">
        <input type="text" id="origin" name="origin" placeholder=" " autocomplete="off" required aria-required="true" />
        <label for="origin">Origen</label>
        <span class="material-icons input-icon" aria-hidden="true">flight_takeoff</span>
      </div>
      <div class="input-group">
        <input type="text" id="destination" name="destination" placeholder=" " autocomplete="off" required aria-required="true" />
        <label for="destination">Destino</label>
        <span class="material-icons input-icon" aria-hidden="true">flight_land</span>
      </div>
      <div class="input-group">
        <input type="date" id="depart-date" name="depart-date" placeholder=" " required aria-required="true" />
        <label for="depart-date">Fecha de Salida</label>
        <span class="material-icons input-icon" aria-hidden="true">event</span>
      </div>
      <div class="input-group">
        <input type="date" id="return-date" name="return-date" placeholder=" " />
        <label for="return-date">Fecha de Regreso (opcional)</label>
        <span class="material-icons input-icon" aria-hidden="true">event_repeat</span>
      </div>
      <div class="input-group">
        <select id="passengers" name="passengers" required aria-required="true">
          <option value="" disabled selected></option>
          <option value="1">1 pasajero</option>
          <option value="2">2 pasajeros</option>
          <option value="3">3 pasajeros</option>
          <option value="4">4 pasajeros</option>
          <option value="5">5 pasajeros</option>
          <option value="6">6 pasajeros</option>
        </select>
        <label for="passengers">Pasajeros</label>
        <span class="material-icons input-icon" aria-hidden="true">groups</span>
      </div>
      <button type="submit" aria-label="Buscar vuelos">Buscar Vuelos</button>
    </form>

    <!-- GALERÍA DE VUELOS CON BOTONES DE COMPRA Y PRECIOS -->
    <div class="images-gallery" aria-label="Galería de vuelos">
      <?php
      $vuelos = [
        ["titulo" => "Vuelo a Madrid", "precio" => 400, "img" => "https://images.unsplash.com/photo-1533473359331-0135ef1b58bf"],
        ["titulo" => "Vuelo Ejecutivo", "precio" => 1200, "img" => "https://images.unsplash.com/photo-1533473359331-0135ef1b58bf"],
        ["titulo" => "Vuelo sobre Europa", "precio" => 1000, "img" => "https://images.unsplash.com/photo-1533473359331-0135ef1b58bf"],
        ["titulo" => "Atardecer en el Aeropuerto", "precio" => 200, "img" => "https://images.unsplash.com/photo-1533473359331-0135ef1b58bf"]
      ];

      foreach ($vuelos as $vuelo) {
        echo '<div class="flight-card">';
        echo '<img src="' . $vuelo["img"] . '" alt="' . htmlspecialchars($vuelo["titulo"]) . '" loading="lazy" />';
        echo '<h2>' . htmlspecialchars($vuelo["titulo"]) . '</h2>';
        echo '<p>Precio: $' . number_format($vuelo["precio"], 2, ',', '.') . '</p>';
        echo '<button class="buy-btn" data-nombre="' . htmlspecialchars($vuelo["titulo"]) . '" data-precio="' . $vuelo["precio"] . '">Comprar</button>';
        echo '</div>';
      }
      ?>
    </div>
  </div>
</div>

<!-- SCRIPT DE REDIRECCIÓN AL CARRITO CON NOMBRE Y PRECIO -->
<script>
  document.querySelectorAll('.buy-btn').forEach(button => {
    button.addEventListener('click', () => {
      const nombre = encodeURIComponent(button.getAttribute('data-nombre'));
      const precio = encodeURIComponent(button.getAttribute('data-precio'));
      window.location.href = `ver_carrito.php?nombre=${nombre}&precio=${precio}`;
    });
  });
</script>

<!-- ESTILOS INTERNOS PARA BOTÓN DE COMPRA -->
<style>
  .buy-btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 8px;
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
    transition: background 0.3s;
  }

  .buy-btn:hover {
    background-color: #0056b3;
  }
</style>

<!-- SCRIPT EXTERNO (si lo usás para validación o animaciones extra) -->


<?php include("template/pie.php"); ?>

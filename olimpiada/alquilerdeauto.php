<?php
include("template/cabecera.php");
?>

<div class="intro-text">
  <h1>Encuentra el auto perfecto para tu viaje</h1>
  <p>Explora nuestra increíble flota de autos premium y disfruta de la mejor experiencia de alquiler con la confianza que mereces.</p>
</div>

<main class="container" role="main" aria-label="Listado de autos para alquiler">
<?php
$autos = [
    [
      "modelo" => "Tesla Model 3",
      "precio" => 80,
      "imagen" => "img/tesla.png",
      "alt" => "Tesla Model 3 color azul metálico estacionado frente a un paisaje urbano en tiempo crepuscular",
      "caracteristicas" => [
        "Eléctrico", "Autonomía: 480 km", "5 asientos", "Transmisión automática", "Conectividad Wi-Fi"
      ]
    ],
    [
      "modelo" => "Audi Q5",
      "precio" => 90,
      "imagen" => "img/audi q5.png",
      "alt" => "Audi Q5 SUV color negro con luces encendidas en carretera de noche",
      "caracteristicas" => [
        "SUV deportivo", "Motor gasolina 2.0L Turbo", "5 asientos", "Tracción integral Quattro", "Transmisión automática"
      ]
    ],
    [
      "modelo" => "BMW Serie 5",
      "precio" => 110,
      "imagen" => "img/bmw serie 5.jpg",
      "alt" => "BMW Serie 5 sedán ejecutivo color azul oscuro estacionado frente a edificio moderno",
      "caracteristicas" => [
        "Sedán ejecutivo", "Motor diésel 3.0L", "5 asientos", "Transmisión automática", "Navegación GPS integrada"
      ]
    ],
    [
      "modelo" => "img/Mercedes-Benz Clase C",
      "precio" => 105,
      "imagen" => "img/mercedes benz c.jpg",
      "alt" => "Mercedes-Benz Clase C sedán color azul oscuro estacionado en carretera de montaña",
      "caracteristicas" => [
        "Sedán de lujo", "Motor gasolina 2.0L Turbo", "5 asientos", "Interior premium", "Transmisión automática"
      ]
    ],
    [
      "modelo" => "Ford Mustang",
      "precio" => 95,
      "imagen" => "img/mustan.jpg",
      "alt" => "Ford Mustang deportivo coupé rojo estacionado en la ciudad al atardecer",
      "caracteristicas" => [
        "Deportivo coupé", "Motor V8 potente", "4 asientos", "Transmisión manual", "Sistema de sonido premium"
      ]
    ],
    [
      "modelo" => "Toyota Corolla",
      "precio" => 45,
      "imagen" => "img/toyota carrola.jpg",
      "alt" => "Toyota Corolla sedán compacto color azul estacionado en zona residencial soleada",
      "caracteristicas" => [
        "Sedán compacto", "Motor gasolina 1.8L", "5 asientos", "Alta eficiencia combustible", "Transmisión automática"
      ]
    ],
    [
      "modelo" => "Jeep Wrangler",
      "precio" => 100,
      "imagen" => "img/Jeep Wrangler SUV.jpg",
      "alt" => "Jeep Wrangler SUV todoterreno color negro estacionado en zona de montaña",
      "caracteristicas" => [
        "SUV todoterreno", "Motor gasolina 3.6L V6", "5 asientos", "Tracción 4x4", "Transmisión automática"
      ]
    ],
    [
      "modelo" => "Nissan Leaf",
      "precio" => 55,
      "imagen" => "img/Nissan Leaf eléctrico.jpg",
      "alt" => "Nissan Leaf eléctrico compacto color azul claro estacionado en zona urbana",
      "caracteristicas" => [
        "Eléctrico compacto", "5 asientos", "Alta eficiencia energética", "Transmisión automática", "Conectividad inteligente"
      ]
    ],
    [
      "modelo" => "Hyundai Tucson",
      "precio" => 60,
      "imagen" => "img/Hyundai Tucson SUV.jpg",
      "alt" => "Hyundai Tucson SUV compacto color azul estacionado cerca de parque natural",
      "caracteristicas" => [
        "SUV compacto", "Motor gasolina 2.0L", "5 asientos", "Transmisión automática", "Sistema de seguridad avanzada"
      ]
    ]
];

foreach ($autos as $auto) {
    $modelo = htmlspecialchars($auto["modelo"], ENT_QUOTES, 'UTF-8');
    $precio = $auto["precio"];
    $alt = htmlspecialchars($auto["alt"], ENT_QUOTES, 'UTF-8');
    $aria = "Auto modelo $modelo. Precio $precio dólares por día. Características: " . implode(", ", $auto["caracteristicas"]);
    echo <<<HTML
<article class="car-card" tabindex="0" aria-label="$aria">
  <img src="{$auto['imagen']}" alt="$alt" class="car-image" />
  <div class="car-info">
    <h2 class="car-model">$modelo</h2>
    <p class="car-price">$$precio / día</p>
    <ul class="features-list">
HTML;
    foreach ($auto["caracteristicas"] as $caract) {
      $caract_esc = htmlspecialchars($caract, ENT_QUOTES, 'UTF-8');
      echo "<li>$caract_esc</li>";
    }
    echo <<<HTML
    </ul>
    <form method="get" action="ver_carrito.php" style="margin-top: 1rem;">
      <input type="hidden" name="nombre" value="$modelo" />
      <input type="hidden" name="precio" value="$precio" />
      <button type="submit" class="rent-button" aria-label="Alquilar $modelo">Alquilar</button>
    </form>
  </div>
</article>
HTML;
}
?>
</main>

<?php include("template/pie.php"); ?>

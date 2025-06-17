

 
 <?php include("template/cabecera.php"); ?>

   
  <link rel="stylesheet" href="./css/estilosparapaquetes.css"/>
<section class="packages">

  <article class="package" tabindex="0" aria-labelledby="title1">
    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/e806f6f9-355b-4ca4-a3f0-5a2f605d6491.png" alt="Imagen de ciudad nocturna con auto y hotel iluminado en tonos azules" />
    <h2 id="title1">Escapada Urbana con Auto y Hotel en Ciudad de México</h2>
    <p class="description">Disfruta una escapada a Ciudad de México con coche de alquiler y estadía en hotel 4 estrellas.</p>
    <ul class="features" aria-label="Características">
      <li>Auto compacto incluido por 3 días</li>
      <li>4 noches en hotel céntrico en Ciudad de México</li>
      <li>Desayuno diario incluido</li>
      <li>Asistencia 24/7</li>
    </ul>
    <div class="buy-section">
      <div class="price">$450 USD</div>
      <form action="carrito.php" method="post">
        <input type="hidden" name="id" value="1">
        <input type="hidden" name="nombre" value="Escapada Urbana con Auto y Hotel en Ciudad de México">
        <input type="hidden" name="precio" value="450">
        <input type="hidden" name="cantidad" value="1">
        <button type="submit" class="btn-book" role="button">Reservar</button>
      </form>
    </div>
  </article>

  <article class="package" tabindex="0" aria-labelledby="title2">
    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/52422455-c34a-439e-87b7-fb9860f2d18c.png" alt="Imagen de playa tropical con el mar azul y cielo al atardecer para paquete de vuelo y hotel" />
    <h2 id="title2">Aventura de Playa con Vuelo y Estadia en Cancún</h2>
    <p class="description">Viaja a Cancún con vuelo ida y vuelta y hospedaje en resort todo incluido.</p>
    <ul class="features" aria-label="Características">
      <li>Vuelo ida y vuelta desde tu ciudad</li>
      <li>5 noches en resort 5 estrellas en Cancún</li>
      <li>Acceso a actividades acuáticas</li>
      <li>Traslados incluidos</li>
    </ul>
    <div class="buy-section">
      <div class="price">$1100 USD</div>
      <form action="carrito.php" method="post">
        <input type="hidden" name="id" value="2">
        <input type="hidden" name="nombre" value="Aventura de Playa con Vuelo y Estadia en Cancún">
        <input type="hidden" name="precio" value="1100">
        <input type="hidden" name="cantidad" value="1">
        <button type="submit" class="btn-book" role="button">Reservar</button>
      </form>
    </div>
  </article>

  <article class="package" tabindex="0" aria-labelledby="title3">
    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/83df8182-d6fb-418a-be95-b74a0f97db1e.png" alt="Imagen de carretera panorámica con avion volando y hotel moderno para paquete combinado" />
    <h2 id="title3">Viaje Completo: Auto, Vuelo y Hotel en Barcelona</h2>
    <p class="description">Combo perfecto con auto, vuelo y estadía para explorar Barcelona sin preocupaciones.</p>
    <ul class="features" aria-label="Características">
      <li>Vuelo ida y vuelta incluido</li>
      <li>Auto categoría SUV por 5 días</li>
      <li>6 noches en hotel boutique en Barcelona</li>
      <li>Seguro de viaje incluido</li>
    </ul>
    <div class="buy-section">
      <div class="price">$1600 USD</div>
      <form action="carrito.php" method="post">
        <input type="hidden" name="id" value="3">
        <input type="hidden" name="nombre" value="Viaje Completo: Auto, Vuelo y Hotel en Barcelona">
        <input type="hidden" name="precio" value="1600">
        <input type="hidden" name="cantidad" value="1">
        <button type="submit" class="btn-book" role="button">Reservar</button>
      </form>
    </div>
  </article>

  <article class="package" tabindex="0" aria-labelledby="title4">
    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ff2cbf95-d045-4353-8adb-8fa8b76d98c5.png" alt="Imagen de auto económico estacionado frente a hotel sencillo para paquete económico" />
    <h2 id="title4">Estadía y Auto Económico en Bogotá</h2>
    <p class="description">Viaja cómodo con alojamiento y auto económico para tus traslados locales en Bogotá.</p>
    <ul class="features" aria-label="Características">
      <li>Auto económico por 4 días</li>
      <li>3 noches en hotel 3 estrellas en Bogotá</li>
      <li>Libre uso de GPS</li>
    </ul>
    <div class="buy-section">
      <div class="price">$380 USD</div>
      <form action="carrito.php" method="post">
        <input type="hidden" name="id" value="4">
        <input type="hidden" name="nombre" value="Estadía y Auto Económico en Bogotá">
        <input type="hidden" name="precio" value="380">
        <input type="hidden" name="cantidad" value="1">
        <button type="submit" class="btn-book" role="button">Reservar</button>
      </form>
    </div>
  </article>

</section>


  
 
 <?php include("template/pie.php"); ?>
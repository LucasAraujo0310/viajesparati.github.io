<?php include("template/cabecera.php"); ?>

<div class="travel-page" role="main" aria-label="Página principal de viajes modernos">
  <section class="hero" aria-label="Imagen principal inspiradora">
    <h1 class="hero-text">Descubre destinos increíbles solo en nuestra aerolínea</h1>
  </section>

  <section class="destinations" aria-label="Lista de destinos turísticos recomendados">

    <article class="card" tabindex="0">
      <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80" alt="Playa paradisíaca con aguas cristalinas y arena blanca" />
      <div class="card-content">
        <h3 class="card-title">Playa de Cancún</h3>
        <p class="card-description">Relájate en las hermosas playas de arena blanca y aguas turquesas.</p>
        <p class="card-price">Precio: $1.200</p>
        <a href="ver_carrito.php?nombre=Cancún&precio=1200" class="buy-btn" role="button" aria-label="Comprar viaje a Cancún">Comprar</a>
      </div>
    </article>

    <article class="card" tabindex="0">
      <img src="https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=800&q=80" alt="Montañas nevadas con cielo azul claro y paisajes naturales" />
      <div class="card-content">
        <h3 class="card-title">Montañas de Suiza</h3>
        <p class="card-description">Disfruta de paisajes impresionantes y actividades al aire libre.</p>
        <p class="card-price">Precio: $2.300</p>
        <a href="ver_carrito.php?nombre=Suiza&precio=2300" class="buy-btn" role="button" aria-label="Comprar viaje a Suiza">Comprar</a>
      </div>
    </article>

    <article class="card" tabindex="0">
      <img src="https://images.unsplash.com/photo-1508672019048-805c876b67e2?auto=format&fit=crop&w=800&q=80" alt="Safari en África con animales salvajes en su hábitat natural" />
      <div class="card-content">
        <h3 class="card-title">Safari en África</h3>
        <p class="card-description">Vive la aventura de ver la vida salvaje en su hábitat natural.</p>
        <p class="card-price">Precio: $1.900</p>
        <a href="ver_carrito.php?nombre=África&precio=1900" class="buy-btn" role="button" aria-label="Comprar viaje a África">Comprar</a>
      </div>
    </article>

    <article class="card" tabindex="0">
      <img src="https://images.unsplash.com/photo-1470770841072-f978cf4d019e?auto=format&fit=crop&w=800&q=80" alt="Vista panorámica de Roma con el Coliseo al atardecer" />
      <div class="card-content">
        <h3 class="card-title">Roma, Italia</h3>
        <p class="card-description">Sumergite en la historia y cultura de la ciudad eterna.</p>
        <p class="card-price">Precio: $2.100</p>
        <a href="ver_carrito.php?nombre=Roma&precio=2100" class="buy-btn" role="button" aria-label="Comprar viaje a Roma">Comprar</a>
      </div>
    </article>

    <article class="card" tabindex="0">
      <img src="https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=800&q=80" alt="Ciudad futurista iluminada en la noche con luces azules y negras" />
      <div class="card-content">
        <h3 class="card-title">Tokio, Japón</h3>
        <p class="card-description">Explorá una ciudad vibrante con una mezcla única de tradición y tecnología.</p>
        <p class="card-price">Precio: $2.500</p>
        <a href="ver_carrito.php?nombre=Tokio&precio=2500" class="buy-btn" role="button" aria-label="Comprar viaje a Tokio">Comprar</a>
      </div>
    </article>

    <article class="card" tabindex="0">
      <img src="https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=800&q=80" alt="Ciudad futurista iluminada en la noche con luces azules y negras" />
      <div class="card-content">
        <h3 class="card-title">Dubái, Emiratos</h3>
        <p class="card-description">Descubrí el lujo y la innovación en una ciudad deslumbrante.</p>
        <p class="card-price">Precio: $2.600</p>
        <a href="ver_carrito.php?nombre=Dubái&precio=2600" class="buy-btn" role="button" aria-label="Comprar viaje a Dubái">Comprar</a>
      </div>
    </article>

  </section>
</div>

<style>
  .destinations {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    padding: 2rem;
  }

  .card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease;
  }

  .card:hover {
    transform: translateY(-5px);
  }

  .card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
  }

  .card-content {
    padding: 1rem;
    text-align: center;
  }

  .card-title {
    font-size: 1.25rem;
    font-weight: bold;
    margin: 0.5rem 0;
  }

  .card-description {
    font-size: 1rem;
    color: #555;
    margin-bottom: 0.5rem;
  }

  .card-price {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0.5rem 0 1rem;
    color: #007bff;
  }

  .buy-btn {
    display: inline-block;
    padding: 0.5rem 1.25rem;
    background-color: #007bff;
    color: white;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s;
  }

  .buy-btn:hover {
    background-color: #0056b3;
  }
</style>

<?php include("template/pie.php"); ?>


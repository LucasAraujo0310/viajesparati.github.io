<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<title>Barra de Navegación Moderna</title>
<style>
  /* Reset and base */
  *, *::before, *::after {
    box-sizing: border-box;
  }
  body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    background-color: #121212;
    color: #ffffff;
  }
  a {
    text-decoration: none;
    color: inherit;
  }

  /* Navbar container */
  nav {
    background-color: #000;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 12px 24px;
    gap: 32px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.7);
    position: sticky;
    top: 0;
    z-index: 1000;
  }

  /* Nav links */
  .nav-link {
    position: relative;
    font-size: 1.1rem;
    font-weight: 600;
    color: #0ea5e9; /* Modern blue color */
    padding: 8px 12px;
    border-radius: 8px;
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  .nav-link:hover,
  .nav-link:focus {
    background-color: #0ea5e9;
    color: #000000;
    outline: none;
  }

  /* Responsive adjustments */
  @media (max-width: 640px) {
    nav {
      flex-wrap: wrap;
      gap: 16px;
      padding: 16px 12px;
    }
    .nav-link {
      font-size: 1rem;
      padding: 10px 16px;
      flex: 1 1 40%;
      text-align: center;
    }
  }
</style>
</head>
<body>
<nav role="navigation" aria-label="Barra principal de navegación">
  <a href="producto.php" class="nav-link" tabindex="0">Inicio</a>
 <a href="/olimpiada/index.php" class="nav-link">Ver Sitio Web</a>
  <a href="terminacion.php" class="nav-link" tabindex="0">Paquetes</a>
 
</nav>

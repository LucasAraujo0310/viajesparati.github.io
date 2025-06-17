<?php include("template/cabecera.php"); ?>

 <link rel="stylesheet" href="./css/seccion.css" />

<main class="login-page">
  <section class="container" aria-label="Inicio de sesión">
    <h1>Iniciar Sesión</h1>
    <p class="subtitle">Por favor, introduce tus credenciales para continuar</p>
    <form action="#" method="POST" novalidate>
      <div class="form-group">
        <input type="email" id="email" name="email" placeholder=" " required aria-required="true" aria-describedby="emailHelp" />
        <label for="email">Correo electrónico</label>
      </div>
      <div class="form-group">
        <input type="password" id="password" name="password" placeholder=" " required aria-required="true" />
        <label for="password">Contraseña</label>
      </div>
      <div class="forgot-password">
        <a href="registro.php" tabindex="0">registrarse</a>
      </div>
     <a href="index.php" class="login-page-button" aria-label="Iniciar sesión">Entrar</a>

    </form>
  </section>
</main>


 
 <?php include("template/pie.php"); ?>
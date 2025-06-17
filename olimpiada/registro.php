<?php include("template/cabecera.php"); ?>
  

 <link rel="stylesheet" href="./css/estiloderegistro.css"/>

</head>
<body>
  <div class="registro-unik-container">
    <form class="registro-unik-form-wrapper" novalidate aria-label="Formulario de registro">
      <h2>Crear Cuenta</h2>
      <form class="registro-unik-form" autocomplete="off" novalidate>
        <label class="registro-unik-label" for="registro-unik-nombre">Nombre Completo</label>
        <input class="registro-unik-input" type="text" id="registro-unik-nombre" name="nombre" placeholder="Tu nombre completo" required autocomplete="name" />

        <label class="registro-unik-label" for="registro-unik-usuario">Usuario</label>
        <input class="registro-unik-input" type="text" id="registro-unik-usuario" name="usuario" placeholder="Nombre de usuario" required autocomplete="username" />

        <label class="registro-unik-label" for="registro-unik-email">Correo Electrónico</label>
        <input class="registro-unik-input" type="email" id="registro-unik-email" name="email" placeholder="usuario@ejemplo.com" required autocomplete="email" />

        <label class="registro-unik-label" for="registro-unik-password">Contraseña</label>
        <input class="registro-unik-input" type="password" id="registro-unik-password" name="password" placeholder="Contraseña fuerte" required autocomplete="new-password" />

       <a href="registrarse.php" class="registro-unik-submit" role="button" text-aling:center;>Registrarse</a>

      </form>
    </form>
  </div>
  <script>
    // Basic form submit handler to prevent page reload
    document.querySelector('.registro-unik-form-wrapper form').addEventListener('submit', function(event) {
      event.preventDefault();
      alert('Registro enviado (simulado).');
    });
  </script>
<?php include("template/pie.php"); ?>


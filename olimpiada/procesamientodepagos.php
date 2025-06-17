<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Procesamiento de Pago</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
 
</head>
<body>
  <button class="exit-button" aria-label="Salir" title="Salir" type="button" onclick="window.location.href='index.php'">
    <span class="material-icons">arrow_back</span>
  </button>

  <main class="container" role="main" aria-label="Formulario de procesamiento de pago">
    <h1>Procesamiento de Pago</h1>
    <p class="subtitle">Ingresa los datos de tu tarjeta de crédito para completar la compra de forma segura.</p>
    <form id="payment-form" novalidate autocomplete="off">
      <div class="row">
        <div>
          <label for="first-name">Nombre</label>
          <input type="text" id="first-name" name="firstName" placeholder="Nombre" required autocomplete="cc-given-name" />
        </div>
        <div>
          <label for="last-name">Apellido</label>
          <input type="text" id="last-name" name="lastName" placeholder="Apellido" required autocomplete="cc-family-name" />
        </div>
      </div>
      <label for="card-number">Número de Tarjeta</label>
      <div class="card-brand-container">
        <input
          type="tel"
          inputmode="numeric"
          pattern="[0-9\s]{13,19}"
          maxlength="19"
          id="card-number"
          name="cardNumber"
          placeholder="1234 5678 9012 3456"
          required
          autocomplete="cc-number"
          aria-describedby="card-brand"
          aria-label="Número de tarjeta de crédito"
        />
        <img src="" alt="" id="card-brand-logo" class="card-brand-logo" role="img" aria-live="polite" />
      </div>
      <div class="row">
        <div>
          <label for="expiry-date">Fecha de Expiración</label>
          <input
            type="month"
            id="expiry-date"
            name="expiryDate"
            placeholder="MM/AAAA"
            min="2024-01"
            required
            autocomplete="cc-exp"
          />
        </div>
        <div>
          <label for="cvv">CVV</label>
          <input
            type="password"
            inputmode="numeric"
            pattern="[0-9]{3,4}"
            maxlength="4"
            id="cvv"
            name="cvv"
            placeholder="123"
            required
            autocomplete="cc-csc"
            title="Código de seguridad de 3 o 4 dígitos"
          />
        </div>
      </div>
      <button type="submit" aria-label="Procesar pago">Procesar Pago</button>
    </form>

    <section class="payment-methods" aria-label="Métodos de pago aceptados">
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/5310ffe5-ee56-4408-bb99-c3eef134737c.png" alt="Logo de Mercado Pago en azul moderno" />
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/235e3a12-38e4-4db1-9107-403f28202b0f.png" alt="Logo de PayPal en azul moderno" />
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ccea1162-d80c-4254-a0f2-e37b29dbc5f6.png" alt="Logo de Visa en azul moderno" />
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/5e299b8e-65cd-4178-b4d2-7a0b8a07681e.png" alt="Logo de Mastercard en azul moderno" />
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/1828056e-2060-4361-9881-ee60bfe7e89f.png" alt="Logo de American Express en azul moderno" />
    </section>
  </main>

  <script>
   
  </script>
</body>
</html>

<script src="./javascript/scriptdepago.js"></script>

 <link rel="stylesheet" href="./css/pagocss.css"/>
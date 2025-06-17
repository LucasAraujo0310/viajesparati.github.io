
    (function(){
      'use strict';

      const PASSWORD = "ggga"; // Contraseña para autenticar acceso

      const loginSection = document.getElementById('login-section');
      const adminSection = document.getElementById('admin-section');
      const loginButton = document.getElementById('login-button');
      const passwordInput = document.getElementById('password');
      const loginError = document.getElementById('login-error');

      const form = document.getElementById('product-form');
      const productList = document.getElementById('product-list');

      let products = [];

      // Function to render products list dynamically
      function renderProducts() {
        productList.innerHTML = '';

        if (products.length === 0) {
          productList.innerHTML = '<p>No hay productos registrados.</p>';
          return;
        }

        products.forEach((product) => {
          const card = document.createElement('div');
          card.className = 'product-card';

          const img = document.createElement('img');
          img.className = 'product-image';
          img.alt = `Imagen del producto ${product.name}`;
          img.src = product.imageSrc || 'https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ad750973-e709-4668-9793-024aa93286b0.png';

          const details = document.createElement('div');
          details.className = 'product-details';
          details.innerHTML = `
            <p><strong>ID:</strong> ${product.id}</p>
            <p><strong>Nombre:</strong> ${product.name}</p>
            <p><strong>Precio:</strong> $${product.price.toFixed(2)}</p>
            <p><strong>Lugar:</strong> ${product.place}</p>
            <p><strong>Descripción:</strong> ${product.description}</p>
          `;

          card.appendChild(img);
          card.appendChild(details);

          productList.appendChild(card);
        });
      }

      // Handle login
      loginButton.addEventListener('click', () => {
        if (passwordInput.value === PASSWORD) {
          loginSection.style.display = 'none';
          adminSection.style.display = 'flex';
          loginError.style.display = 'none';
          passwordInput.value = '';
          productList.focus();
        } else {
          loginError.style.display = 'block';
          passwordInput.setAttribute('aria-invalid', 'true');
          passwordInput.focus();
        }
      });

      // Handle form submit
      form.addEventListener('submit', event => {
        event.preventDefault();

        const id = form.id.value.trim();
        const name = form.name.value.trim();
        const price = parseFloat(form.price.value);
        const place = form.place.value.trim();
        const description = form.description.value.trim();
        const imageFile = form.image.files[0];

        if (!id || !name || isNaN(price) || price < 0 || !place || !description || !imageFile) {
          alert('Por favor, complete todos los campos correctamente.');
          return;
        }

        // Validate duplicate ID
        if (products.some(p => p.id === id)) {
          alert('El ID del producto ya existe.');
          return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
          const product = {
            id,
            name,
            price,
            place,
            description,
            imageSrc: e.target.result,
          };

          products.push(product);
          renderProducts();          
          form.reset();
          form.id.focus();
        };
        reader.readAsDataURL(imageFile);
      });

      // Initial render
      renderProducts();
    })();
 
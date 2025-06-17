
   // Logo URLs for card brands
    const cardBrands = {
      visa: {
        name: "Visa",
        url: "https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg",
        alt: "Logo de Visa"
      },
      mastercard: {
        name: "Mastercard",
        url: "https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg",
        alt: "Logo de Mastercard"
      },
      amex: {
        name: "American Express",
        url: "https://upload.wikimedia.org/wikipedia/commons/3/30/American_Express_logo_%282018%29.svg",
        alt: "Logo de American Express"
      },
      default: {
        name: "",
        url: "",
        alt: ""
      }
    };

    // Function to detect card brand based on number prefix
    function detectCardBrand(cardNumber) {
      const number = cardNumber.replace(/\s/g, '');
      if (/^4[0-9]{0,}$/.test(number)) {
        return 'visa';
      }
      else if (/^(5[1-5][0-9]{0,}|2(?:2[2-9]|[3-6][0-9]|7[01]|720)[0-9]{0,})$/.test(number)) {
        return 'mastercard';
      }
      else if (/^3[47][0-9]{0,}$/.test(number)) {
        return 'amex';
      }
      else {
        return 'default';
      }
    }

    const cardNumberInput = document.getElementById('card-number');
    const cardBrandLogo = document.getElementById('card-brand-logo');

    cardNumberInput.addEventListener('input', (e) => {
      // Format card number with spaces every 4 digits
      let value = cardNumberInput.value.replace(/\D/g, '');
      let formatted = '';
      for (let i = 0; i < value.length; i += 4) {
        if (i > 0) formatted += ' ';
        formatted += value.substring(i, i + 4);
      }
      cardNumberInput.value = formatted.substring(0, 19);

      // Detect card brand and update logo
      const brandKey = detectCardBrand(value);
      const brand = cardBrands[brandKey];
      if (brand && brand.url) {
        cardBrandLogo.src = brand.url;
        cardBrandLogo.alt = brand.alt;
        cardBrandLogo.classList.add('visible');
      } else {
        cardBrandLogo.src = '';
        cardBrandLogo.alt = '';
        cardBrandLogo.classList.remove('visible');
      }
    });

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      if (!form.checkValidity()) {
        form.reportValidity();
        return;
      }
      alert('Pago procesado con éxito (simulado).');
      form.reset();
      cardBrandLogo.src = '';
      cardBrandLogo.alt = '';
      cardBrandLogo.classList.remove('visible');
    });
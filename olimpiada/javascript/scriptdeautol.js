

  document.querySelectorAll('.rent-button').forEach(button => {
    button.addEventListener('click', () => {
      const carName = button.closest('.car-card').querySelector('.car-model').textContent;
      alert('Gracias por elegir ' + carName + '! Nos pondremos en contacto contigo pronto.');
    });
  });

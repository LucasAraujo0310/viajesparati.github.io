

  const reserva = document.querySelector('.reserva-estadias');
  const locationFilter = reserva.querySelector('#location-filter');
  const priceFilter = reserva.querySelector('#price-filter');
  const checkinFilter = reserva.querySelector('#checkin-time');
  const checkoutFilter = reserva.querySelector('#checkout-time');
  const gallery = reserva.querySelector('#gallery');
  const cards = gallery.querySelectorAll('.card');

  function filterCards() {
    const locationVal = locationFilter.value;
    const priceVal = priceFilter.value;
    const checkinVal = checkinFilter.value;
    const checkoutVal = checkoutFilter.value;

    cards.forEach(card => {
      const matchesLocation = locationVal === 'todos' || card.dataset.location === locationVal;
      const matchesPrice = priceVal === 'todos' || card.dataset.price === priceVal;
      const matchesCheckin = checkinVal === 'todos' || card.dataset.checkin === checkinVal;
      const matchesCheckout = checkoutVal === 'todos' || card.dataset.checkout === checkoutVal;

      if (matchesLocation && matchesPrice && matchesCheckin && matchesCheckout) {
        card.style.display = '';
      } else {
        card.style.display = 'none';
      }
    });
  }

  locationFilter.addEventListener('change', filterCards);
  priceFilter.addEventListener('change', filterCards);
  checkinFilter.addEventListener('change', filterCards);
  checkoutFilter.addEventListener('change', filterCards);


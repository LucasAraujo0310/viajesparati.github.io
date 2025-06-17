    // Basic form validation: Ensure return date >= depart date if set
    const form = document.querySelector('.flight-form');
    const departDateInput = form.querySelector('input[name="depart-date"]');
    const returnDateInput = form.querySelector('input[name="return-date"]');

    form.addEventListener('submit', (e) => {
      const departDate = departDateInput.value;
      const returnDate = returnDateInput.value;
      if (returnDate && returnDate < departDate) {
        e.preventDefault();
        alert('La fecha de regreso debe ser igual o posterior a la fecha de salida.');
        returnDateInput.focus();
      }
    });

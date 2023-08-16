// Calculate function
function calculateTotal() {
    const rows = document.querySelectorAll('tbody tr');
    let subtotal = 0;
  
    rows.forEach(row => {
      const priceElement = row.querySelector('.price');
      const qtyInput = row.querySelector('.prod_qty');
      const subTotalElement = row.querySelector('.sub-total');
  
      const price = parseFloat(priceElement.textContent.replace('RM', ''));
      const qty = parseInt(qtyInput.value);
      const subTotal = price * qty;
  
      subTotalElement.textContent = 'RM' + subTotal.toFixed(2);
      subtotal += subTotal;
    });
  
    const totalAmountElement = document.querySelector('.total-amount');
    const totalElement = document.querySelector('.total');
  
    totalAmountElement.textContent = 'RM' + subtotal.toFixed(2);
    totalElement.textContent = 'RM' + subtotal.toFixed(2);
  }
  
  // Event listener for calculate shipping button
  const calculateShipButton = document.querySelector('.calculate-ship');
  calculateShipButton.addEventListener('click', calculateTotal);
  
  // Initial calculation
  calculateTotal();
  
  // Quantity change event listeners
  const quantityInputs = document.querySelectorAll('.prod_qty');
  quantityInputs.forEach(input => {
    input.addEventListener('input', calculateTotal);
    input.addEventListener('change', calculateTotal);
  });
  
  // Quantity increment/decrement buttons
  const minusButtons = document.querySelectorAll('.minus');
  const plusButtons = document.querySelectorAll('.plus');
  
  minusButtons.forEach(button => {
    button.addEventListener('click', function() {
      const input = button.nextElementSibling;
      if (input.value > 1) {
        input.value = parseInt(input.value) - 1;
        calculateTotal();
      }
    });
  });
  
  plusButtons.forEach(button => {
    button.addEventListener('click', function() {
      const input = button.previousElementSibling;
      input.value = parseInt(input.value) + 1;
      calculateTotal();
    });
  });
  
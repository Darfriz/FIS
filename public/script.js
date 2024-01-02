
  //AUTO SET DATE
  const todayButton = document.getElementById('today-button');
  const dateInput = document.getElementById('date');
  
  todayButton.addEventListener('click', () => {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;
    dateInput.value = formattedDate;
  });
  
  //PASENGGER BUTTON
  const passengerButtons = document.querySelectorAll('.passenger-button');
  const passengersInput = document.getElementById('passengers');
  
  passengerButtons.forEach(button => {
    button.addEventListener('click', () => {
    const selectedValue = button.value;
    passengersInput.value = selectedValue;
  
    passengerButtons.forEach(btn => {
      btn.classList.remove('active');
    });
    button.classList.add('active');
    });
  });

//CALCULATE TOTAL PRICE
document.addEventListener("DOMContentLoaded", function () {
  // Define the pricing data as an object
  const pricingData = {
    Perlis: { Penang: 50, KL: 100, Terengganu: 150, Johor: 200 },
    Penang: { Perlis: 50, KL: 50, Terengganu: 100, Johor: 150 },
    KL: { Perlis: 100, Penang: 50, Terengganu: 50, Johor: 100 },
    Terengganu: { Perlis: 150, Penang: 100, KL: 50, Johor: 50 },
    Johor: { Perlis: 200, Penang: 150, KL: 100, Terengganu: 50 },
  };

  // Function to update the total price based on form inputs
  function updateTotalPrice() {
    const fromLocation = document.getElementById("from_location").value;
    const toLocation = document.getElementById("to_location").value;
    const passengers = parseInt(document.getElementById("passengers").value);

    if (fromLocation && toLocation && !isNaN(passengers) && passengers > 0) {
      const price = pricingData[fromLocation][toLocation];
      if (price) {
        const totalPrice = price * passengers;
        document.getElementById("total-price").textContent = "RM" + totalPrice;
      } else {
        document.getElementById("total-price").textContent = "Invalid selection";
      }
    } else {
      document.getElementById("total-price").textContent = "RM0";
    }
  }

  // Event listeners for form inputs
  const fromLocationSelect = document.getElementById("from_location");
  const toLocationSelect = document.getElementById("to_location");
  const passengerButtons = document.querySelectorAll(".passenger-button");

  fromLocationSelect.addEventListener("change", updateTotalPrice);
  toLocationSelect.addEventListener("change", updateTotalPrice);

  passengerButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const passengers = this.value;
      document.getElementById("passengers").value = passengers;
      updateTotalPrice();
    });
  });
});

// Event listener for passenger buttons
document.getElementById("passenger-buttons").addEventListener("click", function(event) {
  if (event.target.classList.contains("passenger-button")) {
      var passengerCount = parseInt(event.target.value);
      updateTotalPrice(passengerCount);

      // Update the hidden input field for passengers count
      document.getElementById("passengers").value = passengerCount;
  }
});
  
  //Form submission
  function handleFormSubmit(event) {
    event.preventDefault(); // Prevent form submission

    // Display success message
    var successMessage = document.getElementById('success-message');
    successMessage.style.display = 'block';
    var flightContainer = document.querySelector('.flight-container');
    flightContainer.style.display = 'none';

    // Hide error message if visible
    var errorMessage = document.getElementById('error-message');
    errorMessage.style.display = 'none';
    var flightContainer = document.querySelector('.flight-container');
    flightContainer.style.display = 'none';
  }



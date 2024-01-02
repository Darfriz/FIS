<!DOCTYPE html>
<html>
  <head>
    <title>FAA FLIGHT INFORMATION SYSTEM</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  </head>
  <body class="background-image" style="background-image: url('images/interior.jpg');">
    <header>
      <a href="#" class="logo">FAA<br> FLIGHT INFORMATION SYSTEM</a>
      <ul>
      <li> <a href="{{ route('home') }}">Home</a></li>
      <li><a href="{{ route('flight') }}" class="active">Flight</a></li>
      <li> <a href="{{ route('dashboard') }}">Database</a></li>
      <li> <a href="{{ route('analytics') }}">Analytics</a></li>
      @if(auth()->check())
        <li><a href="{{ url('/') }}">Account</a></li>
        @else
          <li><a href="{{ route('login') }}">Account</a></li>
      @endif
    </ul>
    </header> <br><br><br><br><br><br>
    <div id="success-message" class="success-message" style="display: none;">
      Success! 
      Booking Successfully.
    </div>
    <div id="error-message" class="error-message" style="display: none;">
      Booking Error! <br>
      Something Is Wrong
    </div>  

    <!-- Display flash messages -->
    @if(session('success'))
      <div class="success-message">
        {{ session('success') }}
      </div>
    @endif

    <div class="flight-container">
      <h2>Flight Booking</h2>
      <div class="price-container">
        <h3>Total Price:</h3>
        <span id="total-price">RM0</span>
      </div><br>
      <form action="{{ route('flight') }}" method="POST">
      @csrf
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" required>
  
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
  
          <label for="from_location">From:</label>
          <select id="from_location" name="from_location" required>
            <option value="">Select an option</option>
            <option value="Perlis">Kangar Private Airport (KPA)</option>
            <option value="Penang">Penang International Airport (PEN)</option>
            <option value="KL">Kuala Lumpur International Airport (KLIA)</option>
            <option value="Johor">Johor Senai International Airport (JHB)</option>
            <option value="Terengganu">Kuala Terengganu Sultan Mahmud Airport (TGG)</option>
          </select>
  
          <label for="to_location">To:</label>
          <select id="to_location" name="to_location" required>
            <option value="">Select an option</option>
            <option value="Perlis">Kangar Private Airport (KPA)</option>
            <option value="Penang">Penang International Airport (PEN)</option>
            <option value="KL">Kuala Lumpur International Airport (KLIA)</option>
            <option value="Johor">Johor Senai International Airport (JHB)</option>
            <option value="Terengganu">Kuala Terengganu Sultan Mahmud Airport (TGG)</option>
          </select>
  
          <label for="date">Date:</label>
          <input type="date" id="date" name="date" required>
          <button type="button" id="today-button">Book For Today</button><br> 
  
          <label for="passengers">Number of Passengers:</label>
          <div id="passenger-buttons">
            <button type="button" class="passenger-button" value="1">1</button>
            <button type="button" class="passenger-button" value="2">2</button>
            <button type="button" class="passenger-button" value="3">3</button>
            <button type="button" class="passenger-button" value="4">4</button>
            <button type="button" class="passenger-button" value="5">5</button>
          </div>
          <input type="hidden" id="passengers" name="passengers" value="">
  
          <input type="submit" value="Book Flight" class="sign-in-button">
      </form>
    </div>
  <script src="script.js"></script>
  </body>
</html>
<!-- 
perlis-penang-kl-trengganu-johor
calculate and display price in the price container after user select the from_location, to_location and number of passengers according to the pricing below:

from Perlis to Penang = RM50 
from Perlis to KL = RM100 
from Perlis to Terengganu = RM150 
from Perlis to Johor = RM200 

from Penang to Perlis = RM50
from Penang to KL = RM50 
from Penang to Terengganu = RM100
from Penang to Johor = RM150 

from KL to Perlis = RM100 
from KL to Penang = RM50 
from KL to Terengganu = RM50 
from KL to Johor = RM100 

from Terengganu to Perlis = RM150 
from Terengganu to Penang = RM100 
from Terengganu to KL = RM50 
from Terengganu to Johor = RM50 

from Johor to Perlis = RM200  
from Johor to Penang = RM150 
from Johor to KL = RM100 
from Johor to Terengganu = RM50 

total price = price * number of passengers


 -->


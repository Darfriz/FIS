<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        
    </head>
    <div class="plane-container">
        <img src="./images/plane.png" alt="Plane" class="plane-image" >
        <img src="./images/cloud.png" alt="Plane" class="cloud-image" >
        <div class="button-container">
            <button class="register-button" onclick="redirectToRegister()">Register Now!!!</button>
        </div>  
    </div>

    <body>
        
        
        <body class="background-image" style="background-image: url('images/background.png');">
        <header>
    <a href="#" class="logo" style="color: black;">FAA<br> FLIGHT INFORMATION SYSTEM</a>
    <ul>
      <li> <a href="{{ route('home') }}" class="active">Home</a></li>
      <li><a href="{{ route('flight') }}">Flight</a></li>
      <li> <a href="{{ route('dashboard') }}">Database</a></li>
      <li> <a href="{{ route('analytics') }}">Analytics</a></li>
      <li><a href="{{ route('login') }}">Account</a></li>
    </ul>
  </header> <br>

<div class="image-gallery-container">
    <div class="image-gallery">
      <div class="coast-container">
        <a href="https://www.neoscapesmaldives.com/resort/" target="_blank">
        <img src="./images/coast.jpg" alt="Coast Image">
        <div class="image-overlay">
          <p>Discover Kuala Perlis<br>In Perlis</p>
        </div>
      </div></a>
    </div>

    <div class="image-gallery">
      <div class="coast-container">
        <a href="https://www.fourseasons.com/" target="_blank">
        <img src="./images/hotel.jpg" alt="Hotel Image">
        <div class="image-overlay">
          <p>Get Exclusive<br> Hotel Discount With Us</p>
        </div>
      </div></a>
    </div>

    <div class="image-gallery">
      <div class="coast-container">
        <a href="https://www.visa.com.my/pay-with-visa/find-a-card/credit-cards.html" target="_blank">
        <img src="./images/visa.jpg" alt="Hotel Image">
        <div class="image-overlay">
          <p>Visa & Mastercard<br> Are Accepted Here</p>
        </div>
      </div></a>
    </div>
  </div>

  <div class="friend-container">
    <div class="friend-text">
      Spent Quality Time With Your Friends & Family!
    </div>
    <img src="./images/friends.jpg" alt="Image">

  
  </div>

  <script src="{{ asset('script.js') }}"></script>
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <style>
    .logout-container {
        text-align: center;
        margin-top: 20px;
    }

    .logout-button {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 5px;
        padding: 10px 50px;
        border-radius: 20px;
        text-decoration: none;
        color: #fff;
        background-color: #3498db;
        color: #000000;
        background-color: #00e5ff;
        transition: background-color 0.3s, color 0.3s;
    }
    .logout-button:hover {
        background-color: #2c3e50;
        background-color: #d9041a;
        color: #fff;
    }
</style>
      </head>
    

    <body>
        
        
        <body class="background-image" style="background-image: url('images/glass.jpg');">
        <header>
    <a href="#" class="logo" style="color: black;">FAA<br> FLIGHT INFORMATION SYSTEM</a>
    <ul>
      <li> <a href="{{ route('home') }}">Home</a></li>
      <li><a href="{{ route('flight') }}">Flight</a></li>
      <li> <a href="{{ route('dashboard') }}">Database</a></li>
      <li> <a href="{{ route('analytics') }}">Analytics</a></li>
      @if(auth()->check())
        <li><a href="{{ url('/') }}" class="active">My Account</a></li>
        @else
          <li><a href="{{ route('login') }}" class="active">Account</a></li>
      @endif
    </ul>
  </header><br><br><br><br><br><br><br><br><br>

  <div class="logout-container">
    @auth
        <a href="#" class="logout-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endauth
</div>


</script>
  <script src="{{ asset('script.js') }}"></script>
    </body>
</html>
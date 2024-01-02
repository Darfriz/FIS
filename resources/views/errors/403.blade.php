<!DOCTYPE html>
<html>
    <head>
        <title>FAA FLIGHT INFORMATION SYSTEM</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body class="background-image" style="background-image: url('images/paper.jpg');">
        <header>
            <a href="#" class="logo">FAA <br>FLIGHT INFORMATION SYSTEM</a>
            <ul>
                <li> <a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('flight') }}">Flight</a></li>
                <li> <a href="{{ route('dashboard') }}" class="active">Database</a></li>
                <li> <a href="{{ route('analytics') }}" class="active">Analytics</a></li>
                @if(auth()->check())
                    <li><a href="{{ url('/') }}">Account</a></li>
                    @else
                    <li><a href="{{ route('login') }}">Account</a></li>
                @endif
            </ul>
            
        </header>
        <br><br><br>
        <div class="forbidden-container">
            <img src="images/logo.png" alt="logo" /><br>
            <h1><b>ERROR 403 - FORBIDDEN</b></h1><br>
            <h4>The response status code indicates that the server<br>
                understands the request but refuses to authorize it.<br>
                Only Admin Is Allowed To View Dashboard & Analytics.<br>
                If You Belive This Is A Mistake, <br> Kindly Contact Database Manager.</h4>
            <br><br>
            <h6>Copyright &copy 2024 FAA Industry. Developed By FAA Developement Team. All Rights Reserved</h6>
        </div>

        </body>
    <script src="script.js"></script>
    <style>
        .forbidden-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1, h4 {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .forbidden-container img {
            max-width: 40%;
            max-height: 40%;
    }

    </style>
</html>

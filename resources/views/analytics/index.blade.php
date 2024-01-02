<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "fis-database";

// Create a connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch the latest row from the analytics_table
$sql_latest_row = "SELECT * FROM analytics_table ORDER BY id DESC LIMIT 1";
$result_latest_row = mysqli_query($connection, $sql_latest_row);
$row_latest_row = mysqli_fetch_assoc($result_latest_row);

// Fetch data for the graph
$sql_graph_data = "SELECT id, nett_profit FROM analytics_table";
$result_graph_data = mysqli_query($connection, $sql_graph_data);

// Initialize arrays to store data for the graph
$labels = [];
$nett_profits = [];

// Loop through the result and extract data for the graph
while ($row = mysqli_fetch_assoc($result_graph_data)) {
    $labels[] = $row['id'];
    $nett_profits[] = $row['nett_profit'];
}

// Close the connection
mysqli_close($connection);
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Analytics</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .analytics-container {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(41, 174, 255, 1);
            border-radius: 20px;
            /*box-shadow: 0 0 10px rgba(0, 0, 0, 1);*/
            text-align: center;
            font-size: 18px;
            color: #fff;
            transition: transform 0.3s ease-in-out;
        }

        .analytics-container p {
            margin: 5px 0;
        }

        .analytics-container:hover {
            transform: scale(1.1); /* Adjust the scaling factor as needed */
            background-color: rgba(0, 82, 133, 1);
        }

        #chartContainer {
            width: 400px;
            height: auto;
            margin: 0 auto; /* Set margin to auto to center horizontally */
            display: block; /* Set display to block for margin: auto to work */
            padding: 20px;
            background-color: rgba(255, 255, 255, 1);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 1);
            text-align: center;
            font-size: 18px;
            color: #333;
            text-align: center;
            /* Center-align block-level elements */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;    
        }

        /* Add styles for the progress bar */
        progress {
            width: 100%;
            height: 20px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 50px;
            background-color: #f1f1f1;
        }

        progress::-webkit-progress-bar {
            background-color: #f1f1f1;
            border-radius: 50px;
        }

        progress::-webkit-progress-value {
            background-color: #00d47f;
            border-radius: 50px;
        }

        progress::-moz-progress-bar {
            background-color: #00d47f;
            border-radius: 50px;
        }

        progress::-ms-fill {
            background-color: #00d47f;
            border-radius: 50px;
        }

        label {
            font-weight: bold;
            font-size: 16px;
            display: block;
            margin-bottom: 5px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); /* Adjust the minimum and maximum width as needed */
            gap: 20px; /* Adjust the gap between grid items */
            justify-content: center;
        }

    </style>
    </head>
    <body class="background-image" style="background-image: url('images/cold.jpg');">
        <header>
        <a href="#" class="logo" style="color: black;">FAA<br> FLIGHT INFORMATION SYSTEM</a>
            <ul>
                <li> <a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('flight') }}">Flight</a></li>
                <li> <a href="{{ route('dashboard') }}">Database</a></li>
                <li> <a href="{{ route('analytics') }}" class="active">Analytics</a></li>
                @if(auth()->check())
            <li><a href="{{ url('/') }}">My Account</a></li>
            @else
            <li><a href="{{ route('login') }}">Account</a></li>
        @endif
            </ul>
        </header> <br><br><br><br><br><br><br>

    <div class="grid-container">
        <div class="analytics-container">
            <p>Total Gross Profit = <br>
            <h2><b>RM {{ $totalGrossProfit }}</b></h2></p>
        </div>

        <div class="analytics-container">
            <p>Total Tax = <br>
            <h2><b>RM {{ $totalTax }}</b></h2></p>
        </div>

        <div class="analytics-container">
            <p>Total Operational Cost = <br>
            <h2><b>RM {{ $totalOperationalCost }}</b></h2></p>
        </div>

        <div class="analytics-container">
            <p>Total Nett Profit = <br>
            <h2><b>RM {{ $totalNettProfit }}</b></h2></p>
        </div>


        <div class="analytics-container"> 
        <!-- Progress bar for monthly target -->
        <?php
        // Calculate the progress percentage based on nett_profit and the monthly target
        $monthlyTarget = 1000; // Set the target to RM 1,000
        $nettProfit = $row_latest_row['nett_profit'];
        $progressPercentage = ($nettProfit / $monthlyTarget) * 100;

        // Limit the progress percentage to a maximum of 100%
        $progressPercentage = min($progressPercentage, 100);
        ?>
        <div>
            <label for="monthly_target"><p>Monthly Sales Target = RM 1,000</p></label>
            <progress id="monthly_target" max="100"></progress>
            <h3><span><?php echo $progressPercentage . '%'; ?></span></h3>
        </div>
    </div><br><br><br><br>

    
    <div id="chartContainer">
            <canvas id="nettProfitChart"></canvas>
        </div>

        
    <script>
    // JavaScript code to create the graph
    var ctx = document.getElementById('nettProfitChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Nett Profit',
                data: <?php echo json_encode($nett_profits); ?>,
                borderColor: 'rgba(0, 212, 127, 1)', 
                backgroundColor: 'rgba(0, 212, 127, 0.5)', 
                borderWidth: 2,
                pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                pointBorderColor: 'rgba(255, 255, 255, 1)', 
                pointHoverBackgroundColor: 'rgba(75, 192, 192, 1)', 
                pointHoverBorderColor: 'rgba(255, 255, 255, 1)', 
            }]
        },
        options: {
            responsive: false, // Set responsive to false to avoid resizing the chart automatically
            maintainAspectRatio: false, // Set maintainAspectRatio to false to make the graph smaller
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'ID',
                        color: 'rgba(0, 0, 0, 1)', // Change the x-axis title color to black
                        font: {
                            weight: 'bold' // Make the x-axis title bold
                        }
                    },
                    ticks: {
                        color: 'rgba(0, 0, 0, 1)', // Change the x-axis tick color to black
                        font: {
                            weight: 'bold' // Make the x-axis tick labels bold
                        }
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Nett Profit (RM)',
                        color: 'rgba(0, 0, 0, 1)', // Change the y-axis title color to black
                        font: {
                            weight: 'bold' // Make the y-axis title bold
                        }
                    },
                    ticks: {
                        color: 'rgba(0, 0, 0, 1)', // Change the y-axis tick color to black
                        font: {
                            weight: 'bold' // Make the y-axis tick labels bold
                        }
                    }
                }
            }
        }
    });
    
        // Function to animate the progress bar
        function animateProgressBar(progressBar, targetValue, duration) {
        const startTime = performance.now();
        const startValue = progressBar.value;
        const change = targetValue - startValue;
        
        function step(timestamp) {
            const currentTime = timestamp - startTime;
            const progress = Math.min(currentTime / duration, 1);
            const newValue = startValue + change * progress;
            
            progressBar.value = newValue;
            
            if (currentTime < duration) {
                requestAnimationFrame(step);
            }
        }
        
        requestAnimationFrame(step);
    }

    // Get the progress bar element
    const progressBar = document.getElementById('monthly_target');

    // Animate the progress bar to the desired percentage (progressPercentage) within 2 seconds (2000 milliseconds)
    animateProgressBar(progressBar, <?php echo $progressPercentage; ?>, 1000);
    </script> 
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{asset('sass/meteor.css')}}>
    <link rel="stylesheet" href={{asset('css/style_results.css')}}>
    <title>Results</title>
</head>
<body>
    
    <div class="star"></div>
    <div class="meteor-1"></div>
    <div class="meteor-2"></div>
    <div class="meteor-3"></div>
    <div class="meteor-4"></div>
    <div class="meteor-5"></div>
    <div class="meteor-6"></div>
    <div class="meteor-7"></div>
    <div class="meteor-8"></div>
    <div class="meteor-9"></div>
    <div class="meteor-10"></div>
    <div class="meteor-11"></div>
    <div class="meteor-12"></div>
    <div class="meteor-13"></div>
    <div class="meteor-14"></div>
    <div class="meteor-15"></div>
    
    <div class="result_text">
        <ul>Fastest Asteroid
            <li>
                {{$fastest_ast}}
            </li>
        </ul>
    </div>
    
    <div class="result_text">
        <ul>Closest Asteroid
            <li>
                {{$closest_ast}}
            </li>
        </ul>
    </div>
    
    <div class="result_text">
        <ul>Average Size
            <li>
                {{$average_size}}
            </li>
        </ul>
    </div>

    
    <div class="container" id="chartjs" style="height: 400px; width:400px;">
        <canvas id="myChart" width="1000" height="1000"></canvas>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>

        var asteroid_label = {!!json_encode($asteroid_dates)!!};
        var asteroid_data = {{json_encode($asteroidfinalNumber)}};
        
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: asteroid_label,
                datasets: [{
                    label: '# of Votes',
                    data: asteroid_data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        </script>
</body>
</html>
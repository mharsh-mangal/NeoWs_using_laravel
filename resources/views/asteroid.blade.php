<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
        <link rel="stylesheet" href={{asset('sass/meteor.css')}}>
        <link rel="stylesheet" href={{asset('css/style.css')}}>
        <title>Asteroid Data</title>
    </head>
<body>

        <div>
            <form action="result" method="post">
                <!--url('/') gives base url of the project which is mentioned in the .env file -->
                @csrf
                <div class="container">
                    <h1>Enter the following information</h1>
                    
                <div class="form-group">
                    <label for="start_date">Start Date:</label>
                    <input style=" width: 180px; " type="date" name="from" id="from" class="form-control dates" placeholder="Select Date" value=""/>
                </div>    
                
                <div class="form-group">
                    <label for="end_date">End Date:</label>
                    <input style=" width: 180px; " type="date" name="to" id="to" class="form-control dates" value=""/>
                </div>
    
                <button class="btn btn-primary" id= "sbmtButton">
                        Submit
                </button>
                
            </form>
        </div>
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

     
        <script src={{asset('js/datechecker.js')}}></script>
    </body>
</html>


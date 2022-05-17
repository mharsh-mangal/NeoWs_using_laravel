<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Select a Date Range</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script>
    $( function() {
        //format dates
        $("#from").datepicker({dateFormat:"yy-mm-dd"});
        $("#to").datepicker({dateFormat:"yy-mm-dd"});

      //daterange
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
        function getDate( element ) {
      var date;
            try {
            date = $.datepicker.parseDate( dateFormat, element.value );
                } catch( error ) {
        date = null;
            }
 
        return date;
        }
    } );

    getData();
    //Getting items from API
    function getData() {
        $.ajax({
            url:'https://api.nasa.gov/neo/rest/v1/feed?start_date=2015-09-07&end_date=2015-09-08&api_key=DEMO_KEY'
        }).done(function data() {
            console.log(data);
        });
    }

  </script>
</head>
<body>
 
<label for="from">From</label>
<input type="text" id="from" name="from">
<label for="to">to</label>
<input type="text" id="to" name="to">

<button type="submit" form="form1" value="Submit">Submit</button>
 
 
</body>
</html>
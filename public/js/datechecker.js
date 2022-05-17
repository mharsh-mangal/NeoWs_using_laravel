$(document).ready(function(){

    function numberofDays(from, to) {
        var firstDate = new Date(from);
        var secondDate = new Date(to);

        var difference_ms= firstDate.getTime() - secondDate.getTime();

        var difference_days = difference_ms/(1000 * 86400);
        //return difference_days;
        return Math.round(Math.abs(difference_days));
    }

    $('.dates').change(function() {
            var from_date = $('#from').val();
            var to_date = $('#to').val();
            if (from_date != '' && to_date != '') 
                {
                    if (to_date >= from_date) {
                        var num_days = numberofDays(from_date , to_date)
                        if(num_days > 7){
                            alert('Dates cannot be more than 7 days apart');
                            document.getElementById("sbmtButton").disabled = true;
                        }
                        else{
                            document.getElementById("sbmtButton").disabled = false;
                        }
                    }
                    else{
                        $('#warning').show();
                        alert('End Date cannot be less than Start Date');
                        document.getElementById("sbmtButton").disabled = true;
                    }    
                }
                
    });

});
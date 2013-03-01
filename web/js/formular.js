/* 
  Java-script methods
    implements functions for the autocomplete and the sticky navigation bar
    @author andreas maerki
 */



// Autocompleter
$(function() {
    $( ".airportField" ).autocomplete({
        source: 'lib/AutoSearcher.php' , 
        minLength : 2
    });
});



// check forumalr
// checks wich fields are filled out 
function chkFormular () {
    if (document.Form2000.aircraftField.value == "" && 
        document.Form2000.airportToField.value == "" && 
        document.Form2000.airportFromField.value == "") {
        alert("Please enter a flightnumber or a airport!");
        document.Form2000.aircraftField.focus();
        return false;
    }
    else if ((document.Form2000.aircraftField.value !== "") && 
        (document.Form2000.airportToField.value !== "")) {
        alert("Flightnumber and airport exclude each other!");
        document.Form2000.aircraftField.focus();
        return false;
    }
    else if ((document.Form2000.aircraftField.value !== "") && 
        (document.Form2000.airportFromField.value !== "")) {
        alert("Flightnumber and airport exclude each other!");
        document.Form2000.aircraftField.focus();
        return false;
    }
    else if ((document.Form2000.filter.value > 15) || 
        (document.Form2000.filter.value < 1)) {
        alert("Amount must lie between 1 and 15");
        document.Form2000.filter.focus();
        return false;
    }
    else {
        return true;
    }
}


// Spinner filter
$(function() {
    var spinner = $( "#spinner" ).spinner();
    spinner.spinner( "value", 10);
    $( "#disable" ).click(function() {
        if ( spinner.spinner( "option", "disabled" ) ) {
            spinner.spinner( "enable" );
        } else {
            spinner.spinner( "disable" );
        }
    });
    spinner.spinner({
        min: 1, 
        max: 15
    });
    $( "button" ).button();
});


//sticky navigation bar. Bar stays allways on top
$(function() {
 
    // grab the initial top offset of the navigation 
    var sticky_navigation_offset_top = $('#navigationBar').offset().top;
     
    var sticky_navigation = function(){
        var scroll_top = $(window).scrollTop(); // our current vertical position from the top
         
        // if scrolled more than the navigation, change its position to fixed to stick to top,
        // otherwise change it back to relative
        if (scroll_top > sticky_navigation_offset_top) { 
            $('#navigationBar').css({
                'position': 'fixed', 
                'top':-10, 
                'left':'relative'
            });
        } else {
            $('#navigationBar').css({
                'position': 'relative'
            }); 
        }   
    };
     
    // run function on load
    sticky_navigation();
     
    // and run it again every time on scroll
    $(window).scroll(function() {
        sticky_navigation();
    });
 
});


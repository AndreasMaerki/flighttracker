/* 
  Java Skript Methoden 
 */


// date picker
$(function() {
    $( ".dateField" ).datepicker({
        changeMonth: true
    });
});


// Autocompleter
$(function() {
    $( ".airportField" ).autocomplete({
        source: 'lib/AutoSearcher.php' , 
        minLength : 2
    });
});



// check forumalr
// Wird verwendet um zu überwachen welche Felder ausgefüllt sind 
// Filter wird nach 1-15 geprüft
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
         
        // if we've scrolled more than the navigation, change its position to fixed to stick to top,
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
     
    // run our function on load
    sticky_navigation();
     
    // and run it again every time you scroll
    $(window).scroll(function() {
        sticky_navigation();
    });
 
});
//$('#entries').click(function(e){
//    // console.log(e.target.getAttribute('id')); 
//    var clickedItem =e.target.getAttribute('id');
//    $.ajax({
//        type: "POST",
//        url: "/controller/Ajax/index.php",
//        data: {
//            fname: clickedItem,
//            loc: clickedItem
//        }
//    }).done(function( msg ) {
//        alert( "Data Saved: " + msg );
//    });
//        
//        
//});
//function erzXHRObject(){
//var xhr = new XMLHttpRequest();
//    return xhr;
//}
var clickedItem = null;
//var resOb =erzXHRObject();
// float function
$(document).ready(function() {
     $('.entry').on({
        'click':function(event) {
            $('#overlay').show();
            $('#overlay > div').load('/controller/Ajax/index.php');
            event.preventDefault();           
        }
    });
     
    $(document).on('click', '#close-overlay', function() {
        $('#overlay').hide();
    })
    $('#entries').click(function(e){
        // console.log(e.target.getAttribute('id')); 
        clickedItem =e.target.getAttribute('id');
       // alert(clickedItem);
//        clickedItem = "c=ba&pw=geheim";
//        resOb.open('post', '/controller/Ajax/index.php' + clickedItem, true);
//        resOb.setRequestHeader("content-type", "application/x-www-form-urlencoded");
//        resOb.setRequestHeader("content-length",clickedItem.length);
//        resOb.onreadystatechange = handleResponse;
//        resOb.send (clickedItem);

        
            $.ajax({
            url: '/controller/Ajax/index.php', //This is the current doc
            type: "POST",
            data: ({fname: clickedItem}),
            success:function(data){
                clickedItem.html(data);
            }
        });

        
    });
   
})

//function handleResponse(){
//
//    if (resOb.readyState ==4 ){
//        //alert(clickedItem);
//        document.getElementById("hans").onclick = resOb.responseText;
//    }
//}
//function sendReqGET(){
//    var clickedItem =e.target.getAttribute('id');
//    resOb.open('get','/controller/Ajax/index.php?' + clickedItem, true);
//    resOb.onreadystatechange = handleResponse;
//    resOb.send (null);
//}

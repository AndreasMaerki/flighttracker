/* 
  Java Skript Methoden 
 */


// date picker
$(function() {
$( ".dateField" ).datepicker({ changeMonth: true });
});


// Autocompleter
$(function() {
$( ".airportField" ).autocomplete({
source: 'lib/AutoSearcher.php' , minLength : 2
});
});



// check forumalr
// Wird verwendet um zu überwachen welche Felder ausgefüllt sind 
// Filter wird nach 1-15 geprüft
function chkFormular () {
 if (document.Form2000.aircraftField.value == "" && 
     document.Form2000.airportToField.value == "" && 
     document.Form2000.airportFromField.value == "") {
    alert("Bitte eine Flugnummer oder ein Flughafen eingeben!");
    document.Form2000.aircraftField.focus();
    return false;
  }
  else if ((document.Form2000.aircraftField.value !== "") && 
     (document.Form2000.airportToField.value !== "")) {
    alert("Bitte entscheiden ob Flug oder Ankunfts Flughafen Suche!");
    document.Form2000.aircraftField.focus();
    return false;
  }
  else if ((document.Form2000.aircraftField.value !== "") && 
     (document.Form2000.airportFromField.value !== "")) {
    alert("Bitte entscheiden ob Flug oder Abflug Flughafen Suche!");
    document.Form2000.aircraftField.focus();
    return false;
  }
  else if ((document.Form2000.filter.value > 15) || 
     (document.Form2000.filter.value < 1)) {
    alert("Anzahl Flüge muss zwischen 1 und 15 liegen");
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
spinner.spinner({min: 1, max: 15});
$( "button" ).button();
 });
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
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

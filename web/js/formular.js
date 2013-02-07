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

//sticky navigation bar. stays allways on top
$(function() {
 
    // grab the initial top offset of the navigation 
    var sticky_navigation_offset_top = $('#navigationBar').offset().top;
     
    var sticky_navigation = function(){
        var scroll_top = $(window).scrollTop(); // our current vertical position from the top
         
        // if we've scrolled more than the navigation, change its position to fixed to stick to top,
        // otherwise change it back to relative
        if (scroll_top > sticky_navigation_offset_top) { 
            $('#navigationBar').css({ 'position': 'fixed', 'top':-10, 'left':'relative' });
        } else {
            $('#navigationBar').css({ 'position': 'relative' }); 
        }   
    };
     
    // run our function on load
    sticky_navigation();
     
    // and run it again every time you scroll
    $(window).scroll(function() {
         sticky_navigation();
    });
 
});
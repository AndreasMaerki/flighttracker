<?php

include_once "{$_SERVER['DOCUMENT_ROOT']}/view/View.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/home/NextFlightsView.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/home/FlightDetailView.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/config/config.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/controller/NextFlightsController.php";

class HomeView extends View {

    public function display() {
        $nextFlightsURI = URI_NEXT_FLIGHTS;       
        echo "<h2>Enter a flightnumber or search for a airport:</h2>\n";
        
        echo "<div id=\"homeForm\">\n";
        echo "<form name=\"Form2000\" onsubmit=\"return chkFormular();\" action={$nextFlightsURI} method=\"POST\">\n";
        
        echo "<div class=\"homeFormCenter\">\n";
        echo "<label for=\"aircraftField:\">Flight Nr.:</label>\n";
        echo "<input type=\"search\" id=\"aircraftNrField\" name=\"aircraftField\">\n";
        echo "</div>\n";
        
        echo "<div class=\"homeFormCenter\">\n";
        echo "<label for=\"airportField\:\">Airport:</label>\n";
        echo "<input type=\"search\" class=\"airportField\" name=\"airportField\">\n";
        echo "</div>\n";

        // Filter
        echo "<div class=\"homeFormBelow\">\n";      

        // Button find
        echo "<input class =\"button\"  id=\"submitButton33\" type=\"submit\" name=\"search\"  value=\"find\">\n";
        echo "</form>\n</div>\n";
        echo "</div>\n";
        echo "<br>\n";
        echo "<br>\n";
    }

}

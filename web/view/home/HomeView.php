<?php

include_once 'view/View.php';
include_once 'view/home/NextFlightsView.php';
include_once 'view/home/FlightDetailView.php';
include_once 'config/config.php';
include_once 'controller/NextFlightsController.php';

class HomeView extends View {

    public function display() {
       // $uri = URI_HOME;
        $nextFlightsURI = URI_NEXT_FLIGHTS;       
       // $searchUri = URI_SEARCH_CONTROLLER;
        echo "<h2>Search your Flight:</h2>\n";

        // Formularbeginn
        echo "<div id=\"homeForm\">\n";
        echo "<form action={$nextFlightsURI} method=\"POST\">\n";

        // Flugzeugnummer suche
        echo "<div class=\"homeFormCenter\">\n";
        echo "<label for=\"aircraftField:\">Flight Nr.:</label>\n";
        echo "<input type=\"search\" id=\"aircraftNrField\" name=\"aircraftField\">\n";
        echo "</div>\n";

        // Ankunft
        echo "<div id=\"homeFormLeft\">\n";
        echo "<label for=\"airportToField\:\">Going to:</label>\n";
        echo "<input type=\"search\" class=\"airportField\" name=\"airportToField\">\n";
        echo "<label for=\"arrivalDateField\">Arrival Date:</label>\n";
        echo "<input type=\"search\" class=\"dateField\" name=\"arrivalDateField\">\n";
        echo "</div>\n";

        // Abflug
        echo "<div id=\"homeFormRight\">\n";
        echo "<label for=\"airportFromField:\">Leaving from:</label>\n";
        echo "<input type=\"search\" class=\"airportField\" name=\"airportFromField\">\n";
        echo "<label for=\"departDateField:\">Depart Date:</label>\n";
        echo "<input type=\"search\" class=\"dateField\" name=\"departDateField\">\n";
        echo "</div>\n";

        // Filter
        echo "<div class=\"homeFormBelow\">\n";      
        echo "<label for=\"filter\">Filter:</label>\n";
        echo "<select type=\"search\" class=\"airportField\" name=\"filter\" size=\"1\">\n";
        for ($i=1;$i<16;$i++){           
            if ($i == 10){
               echo "<option selected=\"selected\">$i</option>\n";
            }else {
                echo "<option>$i</option>\n";
            }
        }
        echo "</select>\n";

        // Button Find
        echo "<input class =\"button\"  type=\"submit\" name=\"search\" value=\"find\">\n";
        echo "</form>\n</div>\n";
        echo "</div>\n";


      
        echo "<br>\n";
        echo "<br>\n";
    }

}

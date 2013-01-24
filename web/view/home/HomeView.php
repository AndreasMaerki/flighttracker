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
         echo "<h2>Search your Fly:</h2>";

        // Formularbeginn
        echo "<div id=\"formular\">";
        echo "<form action={$nextFlightsURI} method=\"POST\">";

        // Flugzeugnummer suche
        echo "<div class=\"formularMiddl\">";
        echo "<label for=\"aircraftField:\">Flight Nr.:</label>";
        echo "<input type=\"search\" id=\"aircraftNrField\" name=\"aircraftField\">\n";
        echo "</div>";

        // Ankunft
        echo "<div id=\"formularLeft\">";
        echo "<label for=\"airportToField\:\">Airport To:</label>";
        echo "<input type=\"search\" class=\"airportField\" name=\"airportToField\">\n";
        echo "<label for=\"arrivalDateField\">Arrival Date:</label>";
        echo "<input type=\"search\" class=\"dateField\" name=\"arrivalDateField\">\n";
        echo "</div>";

        // Abflug
        echo "<div id=\"formularRight\">";
        echo "<label for=\"airportFromField:\">Airport From:</label>";
        echo "<input type=\"search\" class=\"airportField\" name=\"airportFromField\">\n";
        echo "<label for=\"departDateField:\">Depart Date:</label>";
        echo "<input type=\"search\" class=\"dateField\" name=\"departDateField\">\n";
        echo "</div>";

        // Filter
        echo "<div class=\"formularDown\">";      
        echo "<label for=\"filter\">Filter:</label>";
        echo "<select type=\"search\" class=\"airportField\" name=\"filter\" size=\"1\">";
        for ($i=1;$i<16;$i++){           
            if ($i == 10){
               echo "<option selected=\"selected\">$i</option>";
            }else {
                echo "<option>$i</option>";
            }
        }
        echo "</select>";

        // Button Find
        echo "<input class =\"button\"  type=\"submit\" name=\"search\" value=\"find\">";
        echo "</form>\n</div>";
        echo "</div>";


      
        echo "<br>";
        echo "<br>";
    }

}

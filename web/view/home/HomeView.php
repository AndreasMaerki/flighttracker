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
 

        // Formularbeginn
        echo "<div id=\"formular\">";
        echo "<form action={$nextFlightsURI} method=\"POST\">";

        // Flugzeugnummer suche
        echo "<li class=\"formularMiddl\">";
        echo "<label for=\"aircraftField:\">Flight Nr.:</label>";
        echo "<input type=\"search\" id=\"aircraftNrField\" name=\"aircraftField\">\n";
        echo "</li>";

        // Ankunft
        echo "<li id=\"formularLeft\">";
        echo "<label for=\"airportToField\:\">Airport To:</label>";
        echo "<input type=\"search\" class=\"airportField\" name=\"airportToField\">\n";
        echo "<label for=\"arrivalDateField\">Arrival Date:</label>";
        echo "<input type=\"search\" class=\"dateField\" name=\"arrivalDateField\">\n";
        echo "</li>";

        // Abflug
        echo "<li id=\"formularRight\">";
        echo "<label for=\"airportFromField:\">Airport From:</label>";
        echo "<input type=\"search\" class=\"airportField\" name=\"airportFromField\">\n";
        echo "<label for=\"departDateField:\">Depart Date:</label>";
        echo "<input type=\"search\" class=\"dateField\" name=\"departDateField\">\n";
        echo "</li>";

        // Filter
        echo "<li class=\"formularDown\">";      
        echo "<label for=\"filter\">Filter:</label>";
        echo "<select type=\"search\" class=\"airportField\" name=\"filter\" size=\"1\">
         <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
        <option>6</option><option>7</option><option>8</option>
        <option>9</option><option selected=\"selected\">10</option><option>11</option>
       <option>12</option><option>13</option><option>14</option><option>15</option></select>";

        // Button Find
        echo "<input class=\"button\" type=\"submit\" name=\"search\" value=\"find\">";
        echo "</form>\n</li>";
        echo "</div>";


      
        echo "<br>";
        echo "<br>";
    }

}
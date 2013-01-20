<?php

include_once 'view/View.php';
include_once 'view/home/NextFlightsView.php';
include_once 'view/home/FlightDetailView.php';
include_once'config/config.php';
include_once 'controller/NextFlightsController.php';

class HomeView extends View {

    public function display() {
        $uri = URI_HOME;
        $nextFlightsUri = URI_NEXT_FLIGHTS;
        $specificFlightsUri = URI_SPECIFIC_FLIGHT;
        $searchUri = URI_SEARCH_CONTROLLER;
//unten $searchUri link
        // SUCHFORMULAR


        $nextFlightsURI = URI_NEXT_FLIGHTS;
        //routing not good so far!!
        echo"<div id=\"searchField\">";
        //echo htmlspecialchars($_SERVER['PHP_SELF']);// next flights Controller gets the self
        echo "<form action=\"{$nextFlightsURI}\" method=\"POST\">";

        echo "Flugzeugnummer: <input type=\"search\" class=\"aircraftField\" name=\"aircraftField\">\n";
        echo "Airport From: <input type=\"search\" class=\"airportField\" name=\"airportFromField\">\n";
        echo "Airport To: <input type=\"search\" class=\"airportField\" name=\"airportToField\">\n";
        echo "<select name=\"top5\" size=\"1\">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>";


        // Button
        echo "<input class=\"button\" type=\"submit\" name=\"search\" value=\"find\">";
        echo "</form>\n</div>";


        // alte Buttons       
        /*             echo <<<HOMEVIEW
          <div id= HomeContainer>
          <p>Click on one of the icons to either serach for a specific flight, or to display the next arrivals and departures on a specific Airport.</p>

          <div id= "homeImages">
          <a href="{$searchUri}" ><img src="/images/bigMagnifier.png" alt="bigMagnifier" width="256" height="256" /></a>
          <a href="{$specificFlightsUri}"><img src="/images/bigMagnifierAirport.png" alt="bigMagnifierAirport" width="256" height="256" /></a>
          </div>

          HOMEVIEW; */
    }

}
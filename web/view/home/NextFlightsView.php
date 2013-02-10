<?php

include_once "{$_SERVER['DOCUMENT_ROOT']}/view/View.php";

class NextFlightsView extends View {

    private $departingFlights;
    private $arrivingFlights;

    
    function __construct($arrivingFlightsArray, $departingFlightsArray) {
        $this->arrivingFlights = $arrivingFlightsArray;
        $this->departingFlights = $departingFlightsArray;
    }

    public function display() {
        $nextFlightsURI = URI_NEXT_FLIGHTS;
        
        if ($this->arrivingFlights) {
            $airport = $this->arrivingFlights[0]->getAirport_to();
            $airportName = $airport->getName();
            $airportDesc = $airport->getDescription();
        }
        echo <<<AIRPORTDETAILS
				<div id= "AirportDetails">
					<p>Airpot name: $airportName </p>
                                        <p>Airpot Description:</br> $airportDesc </p>
				</div>
	
AIRPORTDETAILS;
        
        // Kontrolle Offset
        
         echo "<li><a href=\"{$nextFlightsURI}?Page=1&Offset=0\">Page 1</a></li>\n";
         echo "<li><a href=\"{$nextFlightsURI}?Page=2&Offset=10\">Page 2</a></li>\n";
         echo "<li><a href=\"{$nextFlightsURI}?Page=3&Offset=20\">Page 3</a></li>\n";
         echo "<li><a href=\"{$nextFlightsURI}?Page=4&Offset=30\">Page 4</a></li>\n";
         echo "<li><a href=\"{$nextFlightsURI}?Page=5&Offset=40\">Page 5</a></li>\n";
         echo "<li><a href=\"{$nextFlightsURI}?Page=6&Offset=50\">Page 6</a></li>\n";
         echo "<li><a href=\"{$nextFlightsURI}?Page=7&Offset=60\">Page 7</a></li>\n";
         echo "<li><a href=\"{$nextFlightsURI}?Page=8&Offset=70\">Page 8</a></li>\n";
         echo "<li><a href=\"{$nextFlightsURI}?Page=9&Offset=80\">Page 9</a></li>\n";
            
        $this->nextArrivals();
        $this->nextDepartures();
    }

    private function nextArrivals() {
     
       
        
        echo "<div id=\"arrivalsContainer\">";
        echo "<h3 class= \"tableDescription\">Next arivivals:</h3>\n";
        echo <<<TABLEHEADER
				<div id="tableContainer" class="tableContainer">
				<table id= "arrivalsTable" class="FlightTable">
					<thead class="fixedHeader">
                                            <tr>
						<th scope="col" >Flightnumber</th>
						<th scope="col" >Airline</th>
						<th scope="col" >Scheduled for</th>
						<th scope="col" >Expected at</th>
						<th scope="col" >Departure Airport</th>
						<th scope="col" >Plane type</th>
						<th scope="col" >Status</th>
                                            </tr>
					</thead>
					<tbody class= "scrollContent">
TABLEHEADER;
        foreach ($this->arrivingFlights as &$flight) {
            $arrivalTime = $flight->getArrival_sced();
            $flightNumber = $flight->getNumber();
            $airline = $flight->getAirline()->getName();
            $planeType = $flight->getAircraft()->getCode();
            $DepartureAirport = $flight->getAirport_from()->getName();
            $scheduledArrivalTime = $flight->getArrival_sced();
            $expectedArrivalTime = $flight->getArrival_calc();
            $staus = $flight->getFlightstatus();


            echo "<tr>
                    <td>$flightNumber</td>
                    <td>$airline</td>
                    <td>$scheduledArrivalTime</td>
                    <td>$expectedArrivalTime</td>
                    <td>$DepartureAirport</td>
                    <td>$planeType</td>
                    <td>$staus</td>
                </tr>\n";
        }// end foreach


        echo "</tbody>\n";
        echo "</table>\n";
        echo "</div>\n"; //close the tableContainer
        echo "</div>\n";
    }

//end method 

    private function nextDepartures() {
        echo "<div id=\"DeparturesContainer\">";
        echo "<h3 class= \"tableDescription\">Next departures:</h3>\n";
        echo <<<TABLEHEADER
				<div id="tableContainer" class="tableContainer">
				<table id= "departuresTable" class="FlightTable">
					<thead class="fixedHeader">
                                            <tr>
						<th scope="col" >Flightnumber</th>
						<th scope="col" >Airline</th>
						<th scope="col" >Scheduled for</th>
						<th scope="col" >Expected at</th>
						<th scope="col" >Destination Airport</th>
						<th scope="col" >Plane type</th>
						<th scope="col" >Status</th>
                                            </tr>
					</thead>
					<tbody class= "scrollContent">

TABLEHEADER;
        //foreach 
        foreach ($this->departingFlights as &$flight) {
            /*
              $flightNumber = $flight->getFlightNumber();
              $airline = $flight->getAirline();
              $planeType = $flight->getPlaneType();
              $destinationAirport = $flight->getDestinationAirport();
              $scheduledDepartureTime = date("d.m.Y H:i", $flight->getScheduledDepartureTime());
              $expectedDepartureTime = date("d.m.Y H:i", $flight->getExpectedDepartureTime());
              $staus = $flight->getStatus();
             */


            $arrivalTime = $flight->getNumber();
            $flightNumber = $flight->getNumber();
            $airline = $flight->getAirline()->getName();
            $planeType = $flight->getAircraft()->getCode();
            $scheduledDepartureTime = $flight->getDepart_sced();
            $expectedDepartureTime = $flight->getDepart_calc();
            $staus = $flight->getFlightstatus();
            $destination = $flight->getairport_to()->getName();


            echo "
				<tr>
                    <td>$flightNumber</td>
                    <td>$airline}</td>
                    <td>$scheduledDepartureTime</td>
                    <td>$expectedDepartureTime</td>
                    <td>$destination</td>
                    <td>$planeType</td>
                    <td>$staus</td>
                </tr>\n";
        }//end foreach       

        echo "</tbody>\n";
        echo "</table>\n";
        echo "</div>\n"; //close the tableContainer
        echo "</div>\n";
       
    }

//end method 
}
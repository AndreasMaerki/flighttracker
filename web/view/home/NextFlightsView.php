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

        echo <<<AIRPORTDETAILS
				<div id= "AirportDetails">
					<p>Airpot name:</p>
					<p>Adress:</p>
					<p>Country:</p>
				</div>
	
AIRPORTDETAILS;

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
        //foreach this is the real code!!
        foreach ($this->arrivingFlights as &$flight) {
            $arrivalTime = (string) date("d.m.Y H:i", $flight->getArrival_sced());
            $flightNumber = (string) $flight->getNumber();
            $airline = (string) $flight->getAirline();
            $planeType = (string) $flight->getAircraft();
            $DepartureAirport = (string) $flight->getAirport_from();
            $scheduledArrivalTime = (string) date("d.m.Y H:i", $flight->getArrival_sced());
            $expectedArrivalTime = (string) date("d.m.Y H:i", $flight->getArrival_calc());
            $staus = (string) $flight->getFlightstatus();


            echo "<tr>
                    <td>\"$flightNumber\"</td>
                    <td>\"$airline\"</td>
                    <td>\"$scheduledArrivalTime\"</td>
                    <td>\"$expectedArrivalTime\"</td>
                    <td>\"$departureAirport\"</td>
                    <td><a href=\"/images/testImages/A380_On_Ground.jpg\">\"$planeType\"</a></td>
                    <td>\"$staus\"</td>
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

            $arrivalTime = date("d.m.Y H:i", $flight->getArrival_sced());
            $flightNumber = $flight->getNumber();
            $airline = $flight->getAirline();
            $planeType = $flight->getAircraft();
            $DepartureAirport = $flight->getAirport_from();
            //$scheduledArrivalTime = date("d.m.Y H:i", $flight->getArrival_sced());
            //$expectedArrivalTime = date("d.m.Y H:i", $flight->getArrival_calc());
            $staus = $flight->getFlightstatus();


            echo "
				<tr>
                    <td>\"$flightNumber\"</td>
                    <td>\"$airline}</td>
                    <td>\"$scheduledDepartureTime\"</td>
                    <td>\"$expectedDepartureTime\"</td>
                    <td>\"$destinationAirport\"</td>
                    <td><a href=\"/images/testImages/A380_On_Ground.jpg\">\"$planeType\"</a></td>
                    <td>\"$staus\"</td>
                </tr>\n";
        }//end foreach       

        echo "</tbody>\n";
        echo "</table>\n";
        echo "</div>\n"; //close the tableContainer
        echo "</div>\n";
       
    }

//end method 
}
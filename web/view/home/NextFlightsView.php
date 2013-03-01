<?php
/**
 * Description of NextFlightsView
 * displayes arriving and departing flights from the previously selected airport 
 * since the flightinformationsystm returns a max of 15 flights on a request and
 * since we want to restrict the dataflow to the minimum, we decidet to generate 
 * subpages. when such a subpage is called, the next 15 flights will be requested
 * from the fis.
 * @author Andreas Maerki, Mathias Cuel, Philipe Rothen, Marc Hangartner
 */
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/View.php";

class NextFlightsView extends View {

    private $departingFlights;
    private $arrivingFlights;
    private $airport;

    function __construct($arrivingFlightsArray, $departingFlightsArray, $airport) {
        $this->arrivingFlights = $arrivingFlightsArray;
        $this->departingFlights = $departingFlightsArray;
        $this->airport = $airport;
    }

    public function display() {
        $nextFlightsURI = URI_NEXT_FLIGHTS;

        if (count($this->arrivingFlights) >= 1) {
            $airport = $this->arrivingFlights[0]->getAirport_to();
            $airportName = $airport->getName();
            $airportDesc = $airport->getDescription();
            $airportImage = $airport->getImage();

            if (empty($airportImage)) {
                $airportImage = "/images/airport/default2.jpg";
            }

            echo <<<AIRPORTDETAILS
				<div id= "AirportDetails">
					<h2>$airportName</h2><br><br>
                                        <h3>Airpot Description</h3><br><br> $airportDesc<br><br>
                                        <img src="$airportImage" alt="$airportName" border="0"><br><br><br>
                                </div>
AIRPORTDETAILS;
        } 
        elseif (count($this->departingFlights) >= 1) {
            $airport = $this->departingFlights[0]->getAirport_from();
            $airportName = $airport->getName();
            $airportDesc = $airport->getDescription();
            $airportImage = $airport->getImage();

            if (empty($airportImage)) {
                $airportImage = "/images/airport/default2.jpg";
            }

            echo <<<AIRPORTDETAILS
				<div id= "AirportDetails">
					<h2>$airportName</h2><br><br>
                                        <h3>Airpot Description</h3><br><br> $airportDesc<br><br>
                                        <img src="$airportImage" alt="$airportName" border="0"><br><br><br>
                                </div>
AIRPORTDETAILS;
        } 
        else {
            echo "<br><br>Airport deatails not found!<br><br>";
        }

        // Pages selection
        echo "<ul id =\"NextFlightsPageButtons\">";
        for ($i = 0; $i < 5; $i++) {
            $offsetNumber = $i * 10;
            $pageNumber = $i + 1;

            echo "<li><a href=\"
           {$nextFlightsURI}?offset={$offsetNumber}&Airport={$this->airport}\">Page {$pageNumber}</a></li>\n";
        }
        echo "<ul>\n";
        echo "<div class = \"clear\"</div>\n";
        $this->nextArrivals();
        $this->nextDepartures();
    }

    private function nextArrivals() {

        echo "<div id=\"arrivalsContainer\">\n";
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
        if (count($this->arrivingFlights) >= 1)
        {
            foreach ($this->arrivingFlights as &$flight) {
                $arrivalTime = $flight->getArrival_sced();
                $flightNumber = $flight->getNumber();
                $airline = $flight->getAirline()->getName();
                $planeType = $flight->getAircraft()->getCode();
                $DepartureAirport = $flight->getAirport_from()->getName();
                $scheduledArrivalTime = $flight->getArrival_sced();
                $expectedArrivalTime = $flight->getArrival_calc();
                $status = $flight->getFlightstatus();

                switch ($status) {
                    case "A":
                        $status_text = "Flight enroute";
                        break;
                    case "L":
                        $status_text = "Flight landed";
                        break;
                    case "S":
                        $status_text = "Flight sceduled";
                        break;
                    default:
                        $status_text = "Flight sceduled";
                }
                
                $track_uri = URI_TRACK;
                echo "<tr>
                        <td><a href=\"".$track_uri."?flightnumber=".$flightNumber."\">  $flightNumber</td>
                        <td>$airline</td>
                        <td>$scheduledArrivalTime</td>
                        <td>$expectedArrivalTime</td>
                        <td>$DepartureAirport</td>
                        <td>$planeType</td>
                        <td>$status_text</td>
                    </tr>\n";
            }// end foreach
        }

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
        if (count($this->departingFlights) >= 1)
        {
            foreach ($this->departingFlights as &$flight) {

                $arrivalTime = $flight->getNumber();
                $flightNumber = $flight->getNumber();
                $airline = $flight->getAirline()->getName();
                $planeType = $flight->getAircraft()->getCode();
                $scheduledDepartureTime = $flight->getDepart_sced();
                $expectedDepartureTime = $flight->getDepart_calc();
                $status = $flight->getFlightstatus();
                $destination = $flight->getairport_to()->getName();
                switch ($status) {
                    case "A":
                        $status_text = "Flight enroute";
                        break;
                    case "L":
                        $status_text = "Flight landed";
                        break;
                    case "S":
                        $status_text = "Flight sceduled";
                        break;
                    default:
                        $status_text = "Flight sceduled";
                }

                echo "
                    <tr>
                        <td>$flightNumber</td>
                        <td>$airline</td>
                        <td>$scheduledDepartureTime</td>
                        <td>$expectedDepartureTime</td>
                        <td>$destination</td>
                        <td>$planeType</td>
                        <td>$status_text</td>
                    </tr>\n";
            }//end foreach       
        }
        
        echo "</tbody>\n";
        echo "</table>\n";
        echo "</div>\n";
        echo "</div>\n";
    }//end method 
}
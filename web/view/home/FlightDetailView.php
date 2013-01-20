<?php


class FlightDetailView extends View{

	private $flightnumber;

	function __construct($flightnumber){
		$this->flightnumber = $flightnumber;
	}

	// where can i request the flight?

	public function display() {//getImage is not jet implemented in Flight class
		if ($flight){
			echo "<div class=\"airplane-details\">\n";
			echo "<p><img id= \"detailViewImage\" src=\"/resources/{$flight->getImage()}\" alt=\"{$flight->getName()}\" /></p>\n";
			echo "<h2>Flight-details for flight Number: {flight->getNumber()}</h2>\n";
			echo "<p>Plane type: {$flight->getAirport_from()}</p><br />\n";
			echo "<p>Destination Airport: {$flight->getAirpot_to()}</p><br />\n";
			echo "<p>Scheduled for:" . date("d.m.Y H:i", $flight->getArrival_calc()) . "</p><br />\n";
			echo "<p>Expected:" . date("d.m.Y H:i", $flight->getDepart_calc()) . "</p><br />\n";
			echo "<p>Flight status:{$flight->getFlightstatus}</p><br />\n";
			echo "<p>Owner: {$flight->getAirline}</p><br />\n";
			echo "</div>\n";
		}else{
			echo "<h1>Sorry! The requested resource could not be found</h1>\n";
			echo "<p>Please enter a valid flight number. If you think it is a mistake on our site, please drop us a <a href=\"URI_CONTACT\">line</a></p>";
		}
	}
}
<?php

final class FlightXMLAdapter {

    private $client;
    private $host;
    private $user;
    private $password;


    function __construct($host, $user, $password) {
	$this->host = $host;
        $this->user = $user;
        $this->password = $password;

        $this->open();
    }

    public function __destruct() {
        $this->close();
    }

    private function open() {

	$options = array('trace' => true,
                         'exceptions' => 0,
                         'login' => $this->user,
                         'password' => $this->password, );
	//try {

        $this->client = new SoapClient($this->host, $options);

	//catch(SoapFault $result) {
	//	$this->client = null;
	//}

	//catch(Exception $result) {
	//	$this->client = null;
	//}
	//}


    }

    private function close() {
        if ($this->client != null) {
            $this->client = null;
        }
    }


    public function getFlightsFromAirport($airport, $howMany) {

	$params = array("airport" => $airport, "howMany" => $howMany, "filter" => "", "offset" => "0");
	$result = $this->client->Scheduled($params);

	$list = array();

	if (!empty($result->ScheduledResult->scheduled))
	{

		$amount = count($result->ScheduledResult->scheduled);
		$flights = null;

		if ($amount > 0)
		{

		

			foreach($result->ScheduledResult->scheduled as &$element)
			{

				// ** Debugging output
				//echo "<pre>";
				//print_r($element);
				//echo "</pre>";


					$number = $element->ident;
    				$airline = "";
    				$airport_from = $element->originName ." (". $element->originCity .")";
    				$airport_to = $element->destinationName ." (". $element->destinationCity .")";
    				$aircraft = $element->aircrafttype;
    				$flightstatus = "noch setzen";

    				$arrival_sced = $element->estimatedarrivaltime;
    				$arrival_calc = "4";
    				$depart_sced = $element->filed_departuretime;
    				$depart_calc = "dont know";
    				$timestamp = "e";
    				$longitude = "e";
    				$latitude = "e";
    				$groundspeed = "e";
    				$heading = "e";
    				$id="1";
    				$name="2han";
    				$description="3";
    				$image="4";


				$flight = new Flight($id, $name, $description, $image, $number, $airline, $airport_from, $airport_to, 
                         $aircraft, $flightstatus, $arrival_sced, $arrival_calc,
			 $depart_sced, $depart_calc, $timestamp, $longitude,
                         $latitude, $groundspeed, $heading);

				$list[] = $flight;			

			}


		}
		else
		{
	
		}

	}

	return $list;
    }

}


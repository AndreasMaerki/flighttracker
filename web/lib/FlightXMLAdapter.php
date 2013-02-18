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


    public function getFlight($flightnumber){

            $params_inFlight = array("ident" => $flightnumber, "howMany" => "1");
            $result_inFlight = $this->client->InFlightInfo($params_inFlight);

            $airline = "";
            $arrival_sced = "";
            $arrival_calc = "";
            $depart_sced = "";
            $depart_calc = "";
            $longitude = "";
            $latitude = "";
            $coordinates_log = "";
            $timestamp = "";
            $groundspeed = "";
            $heading = "";
            $flightstatus = "";
            
            if (!empty($result_inFlight->InFlightInfoResult)) {

                // Hauptinformationen abfragen
                $params = array("ident" => $result_inFlight->InFlightInfoResult->faFlightID, "howMany" => 1, "offset" => 0);
                $result = $this->client->FlightInfoEx($params);

                // Debugging
                //echo "<pre>";
                //print_r($result);
                //echo "</pre>"; 
            
                if (!empty($result->FlightInfoExResult->flights)) {

                    if (($result_inFlight->InFlightInfoResult->timeout == "timed_out") &&
                        ($result_inFlight->InFlightInfoResult->timestamp == "0")){
                        
                        $flightstatus = "S";

                        // Wenn Flugzeug nicht in der Luft und Track Daten abgelaufen sind, die Koordinaten
                        // des Zielflughafens holen.
                        $params_airport = array("airportCode" => $result_inFlight->InFlightInfoResult->origin);
                        $result_airport = $this->client->AirportInfo($params_airport);

                        if (!empty($result_airport->AirportInfoResult)) {
                            $longitude = $result_airport->AirportInfoResult->longitude;
                            $latitude = $result_airport->AirportInfoResult->latitude; 
                        }
                        
                    }
                    else
                    {
 
                        if ($result_inFlight->InFlightInfoResult->timeout == "timed_out") {
                            $flightstatus = "L";
                        }
                        else
                        {
                            $flightstatus = "A";
                        }
        
                        $timestamp = $result_inFlight->InFlightInfoResult->timestamp;
                        $longitude = $result_inFlight->InFlightInfoResult->longitude;
                        $latitude = $result_inFlight->InFlightInfoResult->latitude;
                        
                        // Trackinginformationen des Flugs holen
                        $params_track = array("ident" => $flightnumber);
                        $result_track = $this->client->GetLastTrack($params_track);

                        $track_amount = count($result_track->GetLastTrackResult->data);

                        if ($track_amount > 0) {

                            $track_show_amount = ($track_amount / 100 * FXML_TRACKSPERCENT);
                            $track_to_skip = (int)($track_amount / $track_show_amount);
                            $track_skip = $track_to_skip;
                            $counter = 1;
                            
                            // Debugging
                            //echo "<pre>";
                            //print_r($result_track);
                            //echo "</pre>";
                            
                            foreach($result_track->GetLastTrackResult->data as &$element){

                                if(($counter == $track_amount) || ($counter == $track_skip) || ($counter == 1)){
                                    if (($counter == $track_amount)){
                                        $longitude = $element->longitude;
                                        $latitude = $element->latitude; 
                                    }

                                    $coordinates_log = $coordinates_log ."". $element->latitude .",". $element->longitude .";";
                                    $track_skip += $track_to_skip;
                                }

                                $counter++;
                            }
                        }
                    
                        if ($result_inFlight->InFlightInfoResult->arrivalTime == "0"){
                            // Flug ist noch in der Luft
                            $arrival_calc = $result->FlightInfoExResult->flights->estimatedarrivaltime;

                        }
                        else
                        {
                            // Flug ist bereits gelandet
                            $arrival_calc = $result->FlightInfoExResult->flights->actualarrivaltime;
                        }
         
                        $depart_calc = $result_inFlight->InFlightInfoResult->departureTime;

                        $groundspeed = $result_inFlight->InFlightInfoResult->groundspeed;
                        $heading = $result_inFlight->InFlightInfoResult->heading;

                    }
                    
                    $flight_time_array = explode(":", $result->FlightInfoExResult->flights->filed_ete);
                    $flight_time_seconds = ($flight_time_array[0] * 60 * 60) +($flight_time_array[1] * 60) + $flight_time_array[2];
                    
                    $arrival_sced = $result->FlightInfoExResult->flights->filed_departuretime + $flight_time_seconds;
                    $depart_sced = $result->FlightInfoExResult->flights->filed_departuretime;
                    
                    

                    $flight = null;

                    $number = $flightnumber;
                    $airport_from = $result->FlightInfoExResult->flights->origin;
                    $airport_to = $result->FlightInfoExResult->flights->destination;
                    $aircraft = $result->FlightInfoExResult->flights->aircrafttype;

                    if ($arrival_sced != "") {
                        $arrival_sced = date("Y-m-d H:i:s", $arrival_sced);
                    }
                    if ($arrival_calc != "") {
                        $arrival_calc = date("Y-m-d H:i:s", $arrival_calc);
                    }
                    if ($depart_sced != "") {
                        $depart_sced = date("Y-m-d H:i:s", $depart_sced);
                    }
                    if ($depart_calc != "") {
                        $depart_calc = date("Y-m-d H:i:s", $depart_calc);
                    }
                    if ($timestamp != "") {
                        $timestamp = date("Y-m-d H:i:s", $timestamp);
                    }
                    
                    $flight = new Flight($number, $airline, $airport_from, $airport_to, 
                                         $aircraft, $flightstatus, $arrival_sced, $arrival_calc, 
                                         $depart_sced, $depart_calc, $timestamp, $longitude,
                                         $latitude, $coordinates_log, $groundspeed, $heading);
                    
                    return $flight;
                    
                }
            }
            
        // Debugging
        //echo "<pre>";
        //print_r($result);
        //echo "</pre>";   
    }
    
    
    public function getAirportDepartures($airport, $howMany, $offset) {

	//$params_airport = array("airportCode" => $airport);
	//$result_airport = $this->client->AirportInfo($params_airport);
        
        //echo "<hr><pre>";
        //print_r($result_airport);
        //echo "</pre>";
        
        
	$params = array("airport" => $airport, "howMany" => $howMany, "filter" => "", "offset" => $offset);
	$result = $this->client->Scheduled($params);

        //echo "<hr><pre>";
        //print_r($result);
        //echo "</pre>";

	$airportDepartures = array();

	if (!empty($result->ScheduledResult->scheduled)) {
            
		$amount = count($result->ScheduledResult->scheduled);
		//$flight = null;
                

		if ($amount > 0) {  
                    
			foreach($result->ScheduledResult->scheduled as &$element){
                             
                            $number = $element->ident;
                            $airline = "";
                            $airport_from = $element->origin;
                            $airport_to = $element->destination;
                            $aircraft = $element->aircrafttype;
                            $flightstatus = "S";
                            $arrival_sced = date("Y-m-d H:i:s", $element->estimatedarrivaltime);
                            $arrival_calc = "";
                            $depart_sced = date("Y-m-d H:i:s", $element->filed_departuretime);
                            $depart_calc = "";
                            $timestamp = "";
                            $longitude = "";
                            $latitude = "";
                            $coordinates_log = "";
                            $groundspeed = "";
                            $heading = "";

                            $airportDepartures[] = new Flight($number, $airline, $airport_from, $airport_to, 
                                                 $aircraft, $flightstatus, $arrival_sced, $arrival_calc, 
                                                 $depart_sced, $depart_calc, $timestamp, $longitude,
                                                 $latitude, $coordinates_log, $groundspeed, $heading);
                                
                                
							
			}
		}
		else
		{
                    return null;
		}
	}
        
	return $airportDepartures;
    }
    
    public function getAirportArrivals($airport, $howMany, $offset) {

	//$params_airport = array("airportCode" => $airport);
	//$result_airport = $this->client->AirportInfo($params_airport);
        
        //echo "<hr><pre>";
        //print_r($result_airport);
        //echo "</pre>";
        
        
	$params = array("airport" => $airport, "howMany" => $howMany, "filter" => "", "offset" => $offset);
	$result = $this->client->Enroute($params);
        
        //echo "<hr><pre>";
        //print_r($result);
        //echo "</pre>";

        
	$airportArrivals = array();
       
	if (!empty($result->EnrouteResult->enroute)) {
            
		$amount = count($result->EnrouteResult->enroute);
		//$flight = null;

                
		if ($amount > 0) {  
                    
			foreach($result->EnrouteResult->enroute as &$element){
                            
                            $number = $element->ident;
                            $params_inFlight = array("ident" => $number, "howMany" => "1");
                            $result_inFlight = $this->client->InFlightInfo($params_inFlight);

                            $params_flightinfo = array("ident" => $result_inFlight->InFlightInfoResult->faFlightID, "howMany" => 1, "offset" => 0);
                            $result_flightinfo = $this->client->FlightInfoEx($params_flightinfo);

                            // Flugstatus setzen
                            if ($result_inFlight->InFlightInfoResult->timeout == "timed_out") {
                                $flightstatus = "L";
                            }
                            else {
                                $flightstatus = "A";
                            }

                            // Tatsächliche Abflugzeit definieren
                            if ($element->actualdeparturetime == "0") {
                                $depart_calc = date("Y-m-d H:i:s", $result_inFlight->InFlightInfoResult->departureTime);
                            }
                            else {
                                $depart_calc = date("Y-m-d H:i:s", $element->actualdeparturetime);
                            }
                            
                            // Tatsächliche / geplante Ankunftszeit definieren
                            if ($result_inFlight->InFlightInfoResult->arrivalTime == "0") {
                                $arrival_calc = date("Y-m-d H:i:s", $result_flightinfo->FlightInfoExResult->flights->estimatedarrivaltime);
                            }
                            else {
                                $arrival_calc = date("Y-m-d H:i:s", $result_inFlight->InFlightInfoResult->arrivalTime);
                            }
                            
                            //echo "<hr><pre>";
                            //print_r($element);
                            //echo "</pre>";
                            
                            //echo "<pre>";
                            //print_r($result_inFlight);
                            //echo "</pre>";
                            
                            //echo "<pre>";
                            //print_r($result_flightinfo);
                            //echo "</pre>";
                            
                            $airline = "";
                            $airport_from = $element->origin;
                            $airport_to = $element->destination;
                            $aircraft = $element->aircrafttype;
                            $arrival_sced = date("Y-m-d H:i:s", $element->estimatedarrivaltime);
                            $depart_sced = date("Y-m-d H:i:s", $element->filed_departuretime);
                            $timestamp = "";
                            $longitude = "";
                            $latitude = "";
                            $coordinates_log = "";
                            $groundspeed = "";
                            $heading = "";

                            $airportArrivals[] = new Flight($number, $airline, $airport_from, $airport_to, 
                                                 $aircraft, $flightstatus, $arrival_sced, $arrival_calc, 
                                                 $depart_sced, $depart_calc, $timestamp, $longitude,
                                                 $latitude, $coordinates_log, $groundspeed, $heading);
                                
                                
							
			}
		}
		else
		{
                    return null;
		}
	}
        
	return $airportArrivals;
    }
}


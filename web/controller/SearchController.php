
<?php

//include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/FlightXMLAdapter.php";
include_once ("{$_SERVER['DOCUMENT_ROOT']}/lib/MysqlAdapter.php");
class SearchController {
    private $offset;
    private $sqlAdapter;

    public function setOffset($offset){
        $this->offset = $offset;    
    }
    function __construct() {
        $this->sqlAdapter = new MysqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    public function getFlight($flightnumber) {
        $flight = $this->sqlAdapter->getFlight($flightnumber);
        return $flight;
    }

    public function searchArrivingFlightsfromHomeView($aircraftField, $airportFieldTo, $airportFieldFrom, $filter) {

        // Airport such string nur code2 behalten
        $airportFieldToNew = $this->getAirportCodeFromPOST($airportFieldTo);
        $airportFieldFromNew = $this->getAirportCodeFromPOST($airportFieldFrom);
        echo " $airportFieldToNew";
        
        if ($aircraftField != '') {// Uebergabe von post im SearchController
            $flight = $this->sqlAdapter->getFlight($aircraftField);
            return $flight;
        }


        // ankunfts Airport feld ist ausgefüllt
        if ($airportFieldToNew != '') {// Uebergabe von post im SearchController
            $arrivals = $this->sqlAdapter->getAirportArrivals($airportFieldToNew, $filter,0); //offset noch uebergeben
            return $arrivals;
        }

        // Abflug ist ausgefüllt
        if ($airportFieldFromNew != '') {// Uebergabe von post im SearchController
            $departures = $this->sqlAdapter->getAirportDepartures($airportFieldFromNew, $filter, 0); //offset noch uebergeben
            return $departures;
        }
    }

    // Search Airport
    public function getAirportsFromACountry($searchString) {
        $airportsInCountry = $this->sqlAdapter->getAirportByCountry($searchString);

        return $airportsInCountry;
    }

    // Search Aircraft
    public function getAircraft($searchString) {
        $ret = $this->sqlAdapter->getAircraft($searchString);
        return ret;
    }

    // Search Airlines
    public function getAirlines($searchString) {
        if($searchString){
        $airline = $this->sqlAdapter->getAirline(); // uebergabeparameter??
        }else{
        $airline = $this->sqlAdapter->getAirlineById(); // uebergabeparameter??
        }
    }

   

    public function float() {
        echo"float not implemented";
    }
    
    
    public function getAllCountrys($airport_country){
        $ret= $this->sqlAdapter->getCountry();
        return $ret;
    }
    
     // Schneidet alles ausser code2 ab bei airport suche
    public function getAirportCodeFromPOST($searchString) {
        $airportCode = explode(' ', $searchString, 2);
        // Entfernt noch die Klammern
        //$airportCodeRet = substr($airportCode[0], 1, strlen($airportCode[0]) - 2);
        $airportCodeRet = str_replace("(", "",$airportCode[0]);
        $airportCodeRet = str_replace(")", "",$airportCodeRet);
        return $airportCodeRet;
    }

}

?>

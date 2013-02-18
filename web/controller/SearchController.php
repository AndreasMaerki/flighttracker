
<?php

//include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/FlightXMLAdapter.php";
include_once ("{$_SERVER['DOCUMENT_ROOT']}/lib/MysqlAdapter.php");
class SearchController {

    private $offset;
    private $sqlAdapter;

    public function setOffset($offset) {
        $this->offset = $offset;
    }

    function __construct() {
        $this->sqlAdapter = new MysqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    public function getFlight($flightnumber) {
        $flight = $this->sqlAdapter->getFlight($flightnumber);
        return $flight;
    }

    

    // Search Airport
    public function getAirportsFromACountry($searchString) {
        $airportsInCountry = $this->sqlAdapter->getAirportByCountry($searchString);

        return $airportsInCountry;
    }

    // Search Aircraft
    public function getAircraft($searchString) {
        $ret = $this->sqlAdapter->getAircraftByCode($searchString);
        return $ret;
    }
    public function getAllAircrafts(){
        $ret = $this->sqlAdapter->getAircraft();
        

        return $ret;
    }

    /**
     * 
     * @return string array with names of all airlines found db
     */
    public function getAllAirlineNames() {
        $airlineArray = $this->sqlAdapter->getAirline();
        $ret = Array();
        if ($airlineArray) {
            foreach ($airlineArray as $airlineObject) {
                array_push($ret, $airlineObject->getName());
            }
        }
        return $ret;
    }

    public function getAllAirlinePictures() {
        $airlineArray = $this->sqlAdapter->getAirline();
        $ret = Array();
        if ($airlineArray) {
            foreach ($airlineArray as $airlineObject) {
                array_push($ret, $airlineObject->getImage());
            }
        }
        return $ret;
    }

    /**
     * 
     * @return type array with all airline-codes found in db
     */
    public function getAllAirlineCodes() {
        $airlineCodesArray = $this->sqlAdapter->getAirline(); //not implemented
        $ret = Array();
        if ($airlineCodesArray) {
            foreach ($airlineCodesArray as $airlineObject) {
                array_push($ret, $airlineObject->getCode());
            }
        }
        return $ret;
    }

    public function getAllAirlines() {
        $ret = $this->sqlAdapter->getAirline();
        return $ret;
    }

    /**
     * 
     * @param type $searchString
     * @return type string containing airline matching the search string
     */
    public function getAirlinesByName($searchString) {
        if ($searchString) {
            $ret = $this->sqlAdapter->getAirlineByName($searchString);
        }
        return $ret;
    }

    public function getAirlinesPicByName($searchString) {
        if ($searchString) {
            $ret = $this->sqlAdapter->getAirlineByCountry($searchString)->getImage();
        }
        return $ret;
    }

     public function searchArrivingFlightsfromHomeView($aircraftField, $airportField, $offset) {
        // Airport such string nur code2 behalten
        $airportFieldNew = $this->getAirportCodeFromPOST($airportField);

        if ($aircraftField != '') {// Uebergabe von post im SearchController
            $flight[] = $this->sqlAdapter->getFlight($aircraftField);
            return $flight;
        }
        // ankunfts Airport feld ist ausgefüllt
        if ($airportFieldNew != '') {// Uebergabe von post im SearchController
            $arrivals = $this->sqlAdapter->getAirportArrivals($airportFieldNew, "10", $offset); //offset noch uebergeben

            return $arrivals;
        } 
    }

    public function searchDepartFlightsfromHomeView($aircraftField, $airportField, $offset) {
        $airportFieldNew = $this->getAirportCodeFromPOST($airportField);
        
        if ($aircraftField != '') {// Uebergabe von post im SearchController
            $flight = $this->sqlAdapter->getFlight($aircraftField);
            return $flight;
        }
         if ($airportFieldNew != '') {// Uebergabe von post im SearchController
            $departs = $this->sqlAdapter->getAirportDepartures($airportFieldNew, "10", $offset); //offset noch uebergeben
            return $departs;
        }
        
    }

    public function float() {
        echo"float not implemented";
    }

    public function getAllCountrys() {
        $ret = $this->sqlAdapter->getCountry(); 
        return $ret;
    }

    // Schneidet alles ausser code2 ab bei airport suche
    public function getAirportCodeFromPOST($searchString) {
        $airportCode = explode(' ', $searchString, 2);
        // Entfernt noch die Klammern
        //$airportCodeRet = substr($airportCode[0], 1, strlen($airportCode[0]) - 2);
        $airportCodeRet = str_replace("(", "", $airportCode[0]);
        $airportCodeRet = str_replace(")", "", $airportCodeRet);
        return $airportCodeRet;
    }

}

?>

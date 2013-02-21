
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
    /**
     * 
     * @param type $flightnumber in the form of: LX001
     * @return type object of type flight
     */
    public function getFlight($flightnumber) {
        $flight = $this->sqlAdapter->getFlight($flightnumber);
        return $flight;
    }

    

    /**
     * 
     * @param type $searchString: a country code
     * @return type object array with airports
     */
    public function getAirportsFromACountry($searchString) {
        $airportsInCountry = $this->sqlAdapter->getAirportByCountry($searchString);
        return $airportsInCountry;
    }

    /**
     * 
     * @param type $searchString: aircraft type in the form of: A380
     * @return type object of type aircraft
     */
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

    /**
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
    /**
     * 
     * @return type object array containing all airlines
     */
    public function getAllAirlines() {
        $ret = $this->sqlAdapter->getAirline();
        return $ret;
    }

    /**
     * @param type $searchString
     * @return type object containing airline matching the search string
     */
    public function getAirlinesByName($searchString) {
        if ($searchString) {
            $ret = $this->sqlAdapter->getAirlineByName($searchString);
        }
        return $ret;
    }

    /**
     * @param type $searchString
     * @return type object containing airlines matching the search string
     */
    public function getAirlinesPicByName($searchString) {
        if ($searchString) {
            $ret = $this->sqlAdapter->getAirlineByCountry($searchString)->getImage();
        }
        return $ret;
    }
    /**
     * @param type $searchString
     * @return type object array containing flights matching the search string
     */

     public function searchArrivingFlightsfromHomeView($aircraftField, $airportField, $offset) {
        // trim string
        $airportFieldNew = $this->getAirportCodeFromPOST($airportField);

        if ($aircraftField != '') { 
            $flight[] = $this->sqlAdapter->getFlight($aircraftField);
            return $flight;
        }
        // arrival field not empty
        if ($airportFieldNew != '') {
            $arrivals = $this->sqlAdapter->getAirportArrivals($airportFieldNew, "10", $offset);
            return $arrivals;
        } 
    }
    /**
     * @param type $aircraftField or $airportField contains the search string
     * @return type object array containing flights matching the search string
     */
    public function searchDepartFlightsfromHomeView($aircraftField, $airportField, $offset) {
        $airportFieldNew = $this->getAirportCodeFromPOST($airportField);
        
        if ($aircraftField != '') {
            $flight = $this->sqlAdapter->getFlight($aircraftField);
            return $flight;
        }
         if ($airportFieldNew != '') {
            $departs = $this->sqlAdapter->getAirportDepartures($airportFieldNew, "10", $offset); //offset noch uebergeben
            return $departs;
        }
        
    }
    /**
     * 
     * @return type object array containing all countries
     */
    public function getAllCountrys() {
        $ret = $this->sqlAdapter->getCountry(); 
        return $ret;
    }

    /**
     * 
     * @param type $searchString containing code2 wich needs to be extracted
     * @return type string
     * cuts all but code2 out of the search string
     */
    public function getAirportCodeFromPOST($searchString) {
        $airportCode = explode(' ', $searchString, 2);
        $airportCodeRet = str_replace("(", "", $airportCode[0]);
        $airportCodeRet = str_replace(")", "", $airportCodeRet);
        return $airportCodeRet;
    }

}

?>

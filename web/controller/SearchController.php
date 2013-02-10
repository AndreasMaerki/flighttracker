
<?php

//include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/FlightXMLAdapter.php";
include_once ("{$_SERVER['DOCUMENT_ROOT']}/lib/MysqlAdapter.php");
class SearchController {

    private $sqlAdapter;

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
            //$this->flightXML = new FlightXMLAdapter(FXML_HOST, FXML_USER, FXML_PASSWORD); //constants from the config file
            //$flights = $this->flightXML->getFlightsFromANumber($aircraftField);
            $flight = $this->sqlAdapter->getFlight($aircraftField);
            return $flight;
        }

        // Ankunft und Ablug wurde Ausgefüllt, zeigt beides an
//        if ($airportFieldToNew != '' && $airportFieldFromNew != '') {// Uebergabe von post im SearchController
//            $this->flightXML = new FlightXMLAdapter(FXML_HOST, FXML_USER, FXML_PASSWORD); //constants from the config file
//            $flights = $this->flightXML->getFlightsFromAirport($airportFieldToNew, $filter);
//            $this->sqlAdapter->get
//            return $flights;
//        }
        // ankunfts Airport feld ist ausgefüllt
        if ($airportFieldToNew != '') {// Uebergabe von post im SearchController
//            $this->flightXML = new FlightXMLAdapter(FXML_HOST, FXML_USER, FXML_PASSWORD); //constants from the config file
//            $flights = $this->flightXML->getFlightsFromAirport($airportFieldToNew, $filter);
            $arrivals = $this->sqlAdapter->getAirportArrivals($airportFieldToNew, $filter,0); //offset noch uebergeben
            //echo "<br>airport Ankunfts anzeige";
            return $arrivals;
        }

        // Abflug ist ausgefüllt
        if ($airportFieldFromNew != '') {// Uebergabe von post im SearchController
//            $this->flightXML = new FlightXMLAdapter(FXML_HOST, FXML_USER, FXML_PASSWORD); //constants from the config file
//            $flights = $this->flightXML->getFlightsFromAirport($airportFieldFromNew, $filter);
            $departures = $this->sqlAdapter->getAirportDepartures($airportFieldFromNew, $filter, 0); //offset noch uebergeben
            //echo "<br>airport Abflug anzeige";
            return $departures;
        }
    }

    // Search Airport
    public function getAirportFromCountry($searchString) {
        $airportsInCountry = $this->sqlAdapter->getAirportByCountry($searchString);
//        mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or die(mysql_error());
//        mysql_select_db('myFis');
//        $results = Array();
//
//        $req = "SELECT apo_code2, apo_name, apo_city "
//                . "FROM fis_airport "
//                . "WHERE apo_country LIKE '" . $searchString . "'"
//        ;
//
//
//        $query = mysql_query($req);
//
//        while ($row = mysql_fetch_array($query)) {
//            $results[] = $row['apo_name'];
//        }
//
        return $airportsInCountry;
    }

    // Search Aircraft
    public function getAircraftFromAircraft($searchString) {
        $ret = $this->sqlAdapter->getAircraft($searchString);
        return ret;
    }

    // Search Airlines
    public function getAirlinesFromAirlines($searchString) {
        $airline = $this->sqlAdapter->getAirline(); // uebergabeparameter??
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

    public function float() {
        echo"float not implemented";
    }

}

?>

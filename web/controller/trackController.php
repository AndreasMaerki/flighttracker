<?php

include_once "{$_SERVER['DOCUMENT_ROOT']}/controller/Controller.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/trackView/TrackView.php";

/**
 * Andreas Maerki
 */


class TrackController extends Controller {
    private $flightNumber;


    function __construct($flightNumber) {
        $this->flightNumber = $flightNumber;
    }
    public function init() {
        $trackView = new TrackView();
        $trackView->display();
    }

    protected function index() {
        echo "TrackController index not implemented jet";
    }

    protected function show() {
        echo"TrackController show not implemented jet";
    }

    protected function create() {

	//if (!empty($_POST['flightnumber']))
	//{
            
       

            $searchController = new SearchController();
            $flight = $searchController->getFlight($flightnumber);
            $amount_flight = count($flight);



            // Aufbereiten Daten für Java API
            $track_coordinates = explode(";", (String)$flight->getCoordinates_log());
            $java_coordinates = array();
            $amount_coordinates = count($track_coordinates);

            if ($amount_coordinates) {
                foreach($track_coordinates as &$element){

                    $coordinates = explode(",", (String)$element);

                    if (isset($coordinates[0]) && isset($coordinates[1]))
                    {
                        $java_coordinate = "new google.maps.LatLng(". $coordinates[0] .", ". $coordinates[1] .")";
                        $java_coordinates[] = $java_coordinate;
                    }
                }

                $java_coordinates_string = implode(", ", $java_coordinates);
                $java_coordinates_string = "var flightPlanCoordinates = [ ". $java_coordinates_string ." ];";

            }
            else {
                $java_coordinates_string = "";
            }

            $java_coordinate = (String)$flight->getLatitude() .", ". (String)$flight->getLongitude();

            $java_info_box = "<b>Flugnummer ".(String)$flight->getNumber()."</b><br><br>".
                             "Flugzeugtyp: ".(String)$flight->getAircraft()->getCode()."<br>".
                             "Von: ".(String)$flight->getAirport_from()->getName()."<br>".
                             "Nach: ".(String)$flight->getAirport_to()->getName()."<br>";



            if ($amount_flight > 0) {
                include_once 'views/FlightView.php';
            }
        
    }

    public function float() {
        echo"float not implemented";
    }

}

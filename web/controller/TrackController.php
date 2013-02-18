<?php

include_once "{$_SERVER['DOCUMENT_ROOT']}/controller/Controller.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/controller/SearchController.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/trackView/TrackView.php";

/**
 * Andreas Maerki
 */


class TrackController extends Controller {
    
    private $flightnumber;
    private $trackView;
       
    public function init() {
            $this->trackView = new TrackView("", "", "");
            $this->trackView->display_form();
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
            
            if (isset($_POST['flightnumber'])) {
                $this->flightnumber = $_POST['flightnumber'];
            }
            elseif (isset($_GET['flightnumber'])) {
               $this->flightnumber = $_GET['flightnumber']; 
            }
            
            if (isset($this->flightnumber))
            {
            $searchController = new SearchController();
            $flight = $searchController->getFlight($this->flightnumber);
            $amount_flight = count($flight);

            if ($amount_flight >= 1) {
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

            switch((String)$flight->getFlightstatus())
            {
                case "A":
                    $flightstatus = "Flight enroute";
                    break;
                case "L":
                    $flightstatus = "Flight landed";
                    break;
                case "S":
                    $flightstatus = "Flight sceduled";
                    break;
                default:
                    $flightstatus = "Flight sceduled";
            }
            
            if ((String)$flight->getAircraft()->getImage() != "") {
                $flightimage = "<img src=\"". (String)$flight->getAircraft()->getImage()."\" border=\"0\" alt=\"".str_replace("'", "", (String)$flight->getAircraft()->getCode())."\">";
            }
            else {
                $flightimage = "<img src=\"images/aircraft/default.jpg\" border=\"0\" alt=\"".str_replace("'", "", (String)$flight->getAircraft()->getCode())."\">";
            }
            
            if ((String)$flight->getDepart_calc() != "") {
                $flightdeparturetime = (String)$flight->getDepart_calc();
            }
            else {
                $flightdeparturetime = (String)$flight->getDepart_sced();
            }

            if ((String)$flight->getArrival_calc() != "") {
                $flightarrivaltime = (String)$flight->getArrival_calc();
            }
            else {
                $flightarrivaltime = (String)$flight->getArrival_sced();
            }
            
            $java_coordinate = (String)$flight->getLatitude() .", ". (String)$flight->getLongitude();

            $java_info_box = "<font face=\"Lucida Grande\">".
                                "<table align=\"center\" width=\"450\" border=\"0\" cellpadding=\"0\" cellspacing=\"1\">".
                                    "<tr>".
                                        "<td align=\"left\" width=\"25%\"><b>Flugnummer:</b></td>".
                                        "<td align=\"left\" width=\"50%\">".str_replace("'", "", (String)$flight->getNumber())." <i>(". $flightstatus .")</i></td>".
                                        "<th rowspan=\"4\" width=\"25%\">".$flightimage."</td>".
                                    "</tr>".
                                    "<tr>".
                                        "<td align=\"left\" width=\"25%\"><b>Flugzeugtyp:</b></td>".
                                        "<td align=\"left\" width=\"50%\">".str_replace("'", "", (String)$flight->getAircraft()->getCode())."</td>".
                                    "</tr>".
                                    "<tr>".
                                        "<td align=\"left\" width=\"25%\"><b>Von:</b></td>".
                                        "<td align=\"left\" width=\"50%\">".str_replace("'", "", (String)$flight->getAirport_from()->getName())."</td>".
                                    "</tr>".
                                    "<tr>".
                                        "<td align=\"left\" width=\"25%\"><b>Nach:</b></td>".
                                        "<td align=\"left\" width=\"50%\">".str_replace("'", "", (String)$flight->getAirport_to()->getName())."</td>".
                                    "</tr>".
                                    "<tr>".
                                        "<td align=\"left\" width=\"25%\"><b>Abflugzeit:</b></td>".
                                        "<td align=\"left\" width=\"50%\">".$flightdeparturetime."</td>".
                                    "</tr>".
                                    "<tr>".
                                        "<td align=\"left\" width=\"25%\"><b>Ankunftszeit:</b></td>".
                                        "<td align=\"left\" width=\"50%\">".$flightarrivaltime."</td>".
                                    "</tr>".
                               "</table></font>";

                $this->trackView = new TrackView($java_coordinate, $java_info_box, $java_coordinates_string);
                $this->trackView->display();

           
            }
            else {
                
                $this->trackView = new TrackView("", "", "");

                echo "<div align=\"center\"><h3><b>Sorry!</b> Flightnumber ". $this->flightnumber ." can not be found... </h2><br>Maybe this flight has multiple flight numbers!</div><br><br>";
            }
            

            $this->trackView->display_form();

        }
            
    }

    public function float() {
        echo"float not implemented";
    }

}

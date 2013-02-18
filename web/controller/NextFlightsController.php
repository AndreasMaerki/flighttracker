<?php

include_once ("{$_SERVER['DOCUMENT_ROOT']}/controller/Controller.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/model/Flight.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/lib/FlightXMLAdapter.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/view/home/NextFlightsView.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/controller/SearchController.php");

class NextFlightsController extends Controller {

    public static $searchFROMAirport = "figg";
    public static $searchTOAirport = "fagg";
    private $flightXML;

    protected function index() {

        echo "please search a Airport";
    }

    protected function show() {
        echo "show not implemented";
    }

        /**
     *
     * Gibt weitere flüge an mit dem gewähltem offset
     *  
     */
    protected function init() {
        $searchController = new SearchController();

        // neue anfrage mit offset / 10 Einträge
        $arrivingFlights = $searchController->searchArrivingFlightsfromHomeView(
                "", $_GET["Airport"], $_GET["offset"]);
        
        $departingFlights = $searchController->searchDepartFlightsfromHomeView(
                 "", $_GET["Airport"], $_GET["offset"]);
        
       // $amount = count($arrivingFlights);
        if (!empty($arrivingFlights) || !empty($departingFlights)) {      
            $view = new NextFlightsView($arrivingFlights, $departingFlights, $_GET["Airport"]);
            $view->display();
        } else {
            echo "Sorry, no flights for Airport <b>" . $_GET["Airport"] . "</b> found!";
        }
    }
    
    protected function create() {
        // create instace of SearchController and send the searchstring to the apropriate method
        $searchController = new SearchController();

        // erste Anfrage mit den ersten 10 Einträgen
        $arrivingFlights = $searchController->searchArrivingFlightsfromHomeView
                ($_POST['aircraftField'], $_POST['airportField'], "0");
   
        $departingFlights = $searchController->searchDepartFlightsfromHomeView
                ($_POST['aircraftField'], $_POST['airportField'], "0");

       // $amount = count($arrivingFlights);
        if (!empty($arrivingFlights) || !empty($departingFlights)){
            //echo $_POST['airportField'];
            $view = new NextFlightsView($arrivingFlights, $departingFlights, $_POST['airportField']);
            $view->display();
        } else {
            echo "Sorry, no flights for Airport <b>" . $airport . $_POST['airportField'] . "</b> found!";
        }
    }


    public function float() {
        echo"float not implemented";
    }

}

?>
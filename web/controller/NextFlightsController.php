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

    protected function init() {

        $searchController = new SearchController();

        for ($i = 1; $i < 10; $i++) {
            if ($_GET["Page"] == $i) {
                $searchController->setOffset($i * 10);
                echo $i * 10 . NextFlightsController::$searchFROMAirport;
            }
        }


        $arrivingFlights = $searchController->searchArrivingFlightsfromHomeView("", NextFlightsController::$searchFROMAirport, NextFlightsController::$searchTOAirport, 10);

        $amount = count($arrivingFlights);
        if ($amount > 0) {
            echo "im fagg if";
            $view = new NextFlightsView($arrivingFlights, $departingFlights);
            $view->display();
        } else {
            echo "Sorry, no flights for Airport man <b>" . NextFlightsController::$searchFROMAirport . "</b> found!";
        }

        //$this->create();
    }

    protected function create() {
        //echo"NextFlightsController create not implemented";
        // create instace of SearchController and send the searchstring to the apropriate method
        $searcherController = new SearchController();
        self::$searchFROMAirport = $_POST['airportFromField'];
        self::$searchTOAirport = $_POST['airportToField'];

        echo NextFlightsController::$searchFROMAirport;
        echo "sjdfhkjsdhfkjdhfkjdf_fuck";


        $arrivingFlights = $searcherController->searchArrivingFlightsfromHomeView($_POST['aircraftField'], $_POST['airportToField'], $_POST['airportFromField'], $_POST['filter']);

        // do the same for departing flights here. replace the current method call with the right one        
        $departingFlights = $searcherController->searchArrivingFlightsfromHomeView($_POST['aircraftField'], $_POST['airportToField'], $_POST['airportFromField'], $_POST['filter']);
        // test if $flightsArrival is not empty
        $amount = count($arrivingFlights);
        if ($amount > 0) {
            echo "im if";
            $view = new NextFlightsView($arrivingFlights, $departingFlights);
            $view->display();
        } else {
            echo "Sorry, no flights for Airport <b>" . $airport . $_POST['airportFromField'] . "</b> found!";
        }
    }

    public function float() {
        echo"float not implemented";
    }

}

?>
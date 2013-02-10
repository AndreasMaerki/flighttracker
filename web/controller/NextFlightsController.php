<?php

include_once ("{$_SERVER['DOCUMENT_ROOT']}/controller/Controller.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/model/Flight.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/lib/FlightXMLAdapter.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/view/home/NextFlightsView.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/controller/SearchController.php");

class NextFlightsController extends Controller {

   
    protected function index() {

        echo "please search a Airport";
    }

    protected function show() {
        echo "show not implemented";
    }

    protected function init() {
        echo "init not implemented";
    }

    protected function create() {
        //echo"NextFlightsController create not implemented";
        // create instace of SearchController and send the searchstring to the apropriate method
        $searcherController = new SearchController();
        $arrivingFlights = $searcherController->searchArrivingFlightsfromHomeView($_POST['aircraftField'], 
                $_POST['airportToField'], $_POST['airportFromField'], $_POST['filter']);

        // do the same for departing flights here. replace the current method call with the right one        
        $departingFlights = $searcherController->searchArrivingFlightsfromHomeView($_POST['aircraftField'], $_POST['airportToField'], $_POST['airportFromField'], $_POST['departDateField'], $_POST['arrivalDateField'], $_POST['filter']);
        // test if $flightsArrival is not empty
        $amount = count($arrivingFlights);
        if ($amount > 0) {
            echo "im if";
            $view = new NextFlightsView($arrivingFlights, $departingFlights);
            $view->display();
        } else {
            echo "Sorry, no flights for Airport <b>" . $airport . "</b> found!";
        }
    }
    
    public function float() {
        echo"float not implemented";
    }

}

?>
<?php

include_once ('controller/Controller.php');
include_once ('lib/AirportXMLAdapter.php');
include_once('view/home/NextFlightsView.php');
include_once 'view/airportView/AirportView.php';
include_once('model/Airport.php');

class AirportController extends Controller {

	
	function __construct() { 
		//$this->airportXML = new AirportXMLAdapter(FXML_HOST, FXML_USER, FXML_PASSWORD);// übergabe definieren
	}

	protected function index() {
            $view = new AirportVeiw();
            $view->display();
            
	}

	protected function show() {
		echo " show not implemented";
	}

	protected function init() {
		echo "init not implemented";
	}
	protected function create() {

		if (isset($_POST['Airport'])){

			$requestedAirport = $_POST['airport'];//send the requested Airport to the Database
			//database connection here!
			//$airports = $this->airportXML->getAirport($requestedAirport);
                        $airports = null;
			$amount = count($airports);

			if ($amount > 0)
			{
				$view= new AirportView();
                                $view->setAirports($airports);
				$view->display();

			}else{
                            $view= new AirportView();
                            $view->setErrorMessage($airports);
                            $view->display();
			}
		}

	}

}


<?php

include_once ('controller/Controller.php');
include_once ('lib/AirportXMLAdapter.php');
include_once('view/home/NextFlightsView.php');
include_once('model/Airport.php');

class AirportController extends Controller {

	private $airport;	
	
	private $AirportXML;

	function __construct() {
		$this->airportXML = new AirportXMLAdapter(FXML_HOST, FXML_USER, FXML_PASSWORD);// übergabe definieren
	}

	protected function index() {

		echo "Search an airport please";

	}

	protected function show() {
		echo " show not implemented";
	}

	protected function init() {
		echo "init not implemented";
	}

	protected function create() {

		if (isset($_POST['Airport'])){

			$requestedAirport = $_POST['Airport'];
			//should be AirportXML
			$airports = $this->airportXML->getAirport($requestedAirport);
			$amount = count($airports);

			if ($amount > 0)
			{
				$view= new AirportsView($airports);
				$view->display();


			}else{
				echo "Sorry, Airport <b>". $airport ."</b> found!";
			}
		}

	}

}

?>
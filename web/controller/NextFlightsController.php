<?php

include_once ('controller/Controller.php');
include_once ('model/Flight.php');
include_once ('lib/FlightXMLAdapter.php');
include_once('view/home/NextFlightsView.php');

class NextFlightsController extends Controller {

	private $flightXML;

	function __construct() {
		$this->flightXML = new FlightXMLAdapter(FXML_HOST, FXML_USER, FXML_PASSWORD);//constants from the config file
	}

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
	
		echo"NextFlightsController create not implemented";
		if (isset($_POST['airportToField'])){// �bergabe von post im SearchController
			$this->flightXML = new FlightXMLAdapter(FXML_HOST, FXML_USER, FXML_PASSWORD);//constants from the config file
			$airport = $_POST['airportToField'];
                        $filter = $_POST['filter'];
			$flights = $this->flightXML->getFlightsFromAirport($airport, $filter);
			$flights2=$this->flightXML->getFlightsFromAirport($airport, $filter);
			$amount = count($flights);
			if ($amount > 0){
                            echo "im if";
				$view= new NextFlightsView($flights,$flights2);
				$view->display();
			}else{
				echo "Sorry, no flights for Airport <b>". $airport ."</b> found!";
			}
		}

	}

}

?>
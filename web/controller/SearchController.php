<?php
include_once 'view/searchView/SearchView.php';
include_once 'controller/Controller.php';
include_once 'model/Flight.php';
include_once 'lib/FlightXMLAdapter.php';
include_once'view/home/NextFlightsView.php';

class SearchController extends Controller{


    
	protected function init(){
	//echo"<p>init on SerchView called</p>";
		$view = new SearchView();
		$view->display(); 
	}
	
	
	protected function index(){
		echo "SearchController index not implemented jet";
	}
	
	
	protected function show(){
		echo"SearchController show not implemented jet";

	}

	protected function create(){
		if (isset($_POST['airport'])){// übergabe von post im SearchController
			$this->flightXML = new FlightXMLAdapter(FXML_HOST, FXML_USER, FXML_PASSWORD);//constants from the config file
			$airport = $_POST['airport'];
			$flights = $this->flightXML->getFlightsFromAirport($airport, "15");
			$flights2=$this->flightXML->getFlightsFromAirport($airport, "15");
			$amount = count($flights);

			if ($amount > 0)
			{
				$view= new NextFlightsView($flights,$flights2);			
			}else{
				echo "Sorry, no flights for Airport <b>". $airport ."</b> found!";
			}
		}elseif (isset($_POST['aircraft'])){
			
			
		}

	}
	
}

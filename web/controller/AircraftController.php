<?php
include_once 'view/searchView/SearchView.php';
include_once 'controller/Controller.php';
include_once 'model/Flight.php';
include_once 'view/aircraftView/AircraftView.php';
include_once 'config/config.php';

class AircraftController extends Controller{
	
	
	
	
	protected function init(){
	//echo"<p>init on SerchView called</p>";
            
            $country = Array();
    
    mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or die( mysql_error() );
    mysql_select_db('myFis');

    $req = "SELECT DISTINCT apo_country "
    ."FROM fis_airport";

    $query = mysql_query($req);
    
    while($row = mysql_fetch_array($query))
        {
        $country[] = $row[apo_country];
        
        }
            
		$view = new AircraftView($country);
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
		}

	}
	
}

<?php
include_once ("controller/Controller.php");
include_once ("controller/SearchController.php");
include_once ("view/airportView/AirportView.php");
include_once ("model/Airport.php");

class AirportController extends Controller {

	
	function __construct() { 
		
	}

        protected function index() {
            
            
	}

	protected function show() {
		echo " show not implemented";
	}

	protected function init() {
            
            
            $country = $this->getCountry();
    
            $view = new AirportView($country, null, null);
            $view->display();
            
            
	}
	
        
                protected function create() {
                
                // Searchcontroller einbinden
                  $searcherController = new SearchController();
                        $airports = $searcherController->getAirportFromCountry($_POST['airportSearch']
                                );
             
                        // test if $flightsArrival is not empty
                        $amount = count($airports);
			if ($amount > 0){
                            echo "im Airport list";
				$view= new AirportView($this->getCountry(), $amount, $airports);
				$view->display();
			}
                    
                    
               
		

	}
        
        protected function getCountry(){
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
            return $country;
            
        }
        public function float() {
        echo"float not implemented";
    }

}


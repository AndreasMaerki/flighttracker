<?php
include_once ('controller/Controller.php');
include_once ('view/airportView/AirportView.php');
include_once ('model/Airport.php');

class AirportController extends Controller {

	
	function __construct() { 
		
	}

        protected function index() {
            
            
	}

	protected function show() {
		echo " show not implemented";
	}

	protected function init() {
            
            
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
		
            $view = new AirportView($country);
            $view->display();
            
            
	}
	
        
                protected function create() {
                
                // Searchcontroller einbinden
                
                // View neu laden
		$this->init();
		

	}

}


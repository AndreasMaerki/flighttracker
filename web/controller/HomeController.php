<?php

include_once "{$_SERVER['DOCUMENT_ROOT']}/controller/Controller.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/View.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/home/HomeView.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/home/FlightDetailView.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/home/NextFlightsView.php";
/*
include_once "model/Arrivals.php';
include_once "model/Departures.php';
*/

class HomeController extends Controller{

	//shows the next odd 20 flights arriving and departing from the selected Airport. Currently not needed, because of a seperate flightController
	public function showNextFlightsFromAirport($selectedAirport){
		//returnes a object containing an array with flights (to be implemented)
		$arrivingFlights =null;//= new Arrivals($selectedAirport);
		$departingFlights =null;//= new Departures($selectedAirport);
		$view = new NextFlightsView($arrivingFlights,$departingFlights);
		$view->display();
	}

	//default view when page is first loaded
	public function init(){
		$view = new HomeView();
		$view->display();
	}

	//will show details on a given flight number. Currently not needed, because of a seperate flightController
	public function showFlightdetails($flightNumber){
		$view = new FlightDetailView($flightNumber);
		$view->display();
	}

	protected function index(){
	/*
	$view = new HomeView();
		$view->display();
*/
echo "HomeController index not implemented";
	}


	protected function create(){
		echo"HomeController create not implemented jet";

	}
        public function float() {
        echo"float not implemented";
    }



}
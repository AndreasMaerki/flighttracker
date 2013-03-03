<?php

include_once "{$_SERVER['DOCUMENT_ROOT']}/controller/Controller.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/View.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/home/HomeView.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/home/FlightDetailView.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/home/NextFlightsView.php";
/**
 * currently only used to display the the home veiw. 
 */

class HomeController extends Controller{

	/**
         * shows the next +- 10 flights arriving and departing from the selected Airport. Currently not needed, because of a seperate flightController
         * 
         */
	public function showNextFlightsFromAirport($selectedAirport){
		$arrivingFlights =null;
		$departingFlights =null;
		$view = new NextFlightsView($arrivingFlights,$departingFlights);
		$view->display();
	}

	/**
         * default view when page is first loaded
         */
	public function init(){
		$view = new HomeView();
		$view->display();
	}

	/**
         * will show details on a given flight number. Currently not needed, because of a seperate flightController
         * 
         */
	public function showFlightdetails($flightNumber){
		$view = new FlightDetailView($flightNumber);
		$view->display();
	}
     /**
     * create is called after the user has submitted a search string.
     * it sends the query string to the SearchController wich fetches the
     * requiered data from the database.
     */
	protected function create(){
		echo"HomeController create not implemented";

	}

}
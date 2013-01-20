<?php

include_once 'view/View.php';
include_once 'view/home/NextFlightsView.php';
include_once 'view/home/FlightDetailView.php';
include_once'config/config.php';

class HomeView extends View{


	public function display(){
		$uri= URI_HOME;
		$nextFlightsUri =URI_NEXT_FLIGHTS;
		$specificFlightsUri = URI_SPECIFIC_FLIGHT;
		$searchUri = URI_SEARCH_CONTROLLER;
//unten $searchUri link
		echo <<<HOMEVIEW
			<div id= HomeContainer>
				<p>Click on one of the icons to either serach for a specific flight, or to display the next arrivals and departures on a specific Airport.</p>

				<div id= "homeImages">
					<a href="{$searchUri}" ><img src="/images/bigMagnifier.png" alt="bigMagnifier" width="256" height="256" /></a>
					<a href="{$specificFlightsUri}"><img src="/images/bigMagnifierAirport.png" alt="bigMagnifierAirport" width="256" height="256" /></a>
				</div>

HOMEVIEW;

	}




}
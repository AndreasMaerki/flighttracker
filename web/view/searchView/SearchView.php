<?php

include_once 'controller/NextFlightsController.php';
include_once 'config/config.php';

class SearchView extends View{

	

	public function display(){
		$nextFlightsURI = URI_NEXT_FLIGHTS;
		//routing not good so far!!
		echo"<div id=\"searchField\"><form action=\"{$nextFlightsURI}";
		//echo htmlspecialchars($_SERVER['PHP_SELF']);// next flights Controller gets the self
		echo "\" method=\"POST\">Airport: <input type=\"search\" class=\"searchField\" name=\"airport\">\n";
		echo "<input class=\"button\" type=\"submit\" name=\"search\" value=\"find\">";
		echo "</form>\n</div>";
	}

        
	public function getSearchString(){
		$searchString= $_POST['airport'];
		return $searchString;
	}

}

<?php

/**
 * abstract class for all controllers
 *
 * @author Andreas Maerki
 */

abstract class Controller {
	/**
	 * index reads collection data from model
	 * and assigns values to dedicated view template
	 */
	abstract protected function index();

	/**
	 * show reads data of a single resource from model
	 * and assigs values to dedicated view template. Results in a more detailed view../view/searchView/SearchView.php of a specific recource.
	 */

	/* abstract protected function show(); */

	/**
	 * init creates a new empty instance of the resource
	 */

	abstract protected function init();

	/**
	 * create validates and stores sent user data of a newly created resource
	 */

	abstract protected function create();

/* die route Methode ist für das gesamte routing auf der Page zuständig */
	public  function route(){
		
		switch ($_SERVER['REQUEST_METHOD']){// returns  'GET', 'HEAD', 'POST' or 'PUT'.
		case 'GET':
			if (preg_match("/\bFlightDetailView\b/i", $_SERVER['REQUEST_URI'])) {
				$this->showFlightdetails();
				echo "bFlightDetailView was called";// zu testzwecken
				break;
			}elseif(preg_match("/\bnext_flights\b/i", $_SERVER['REQUEST_URI'])){
				$this->init();
				echo "bnext_flights was called";// zu testzwecken
				break;
			}elseif(preg_match("/\bspecific_flight\b/i", $_SERVER['REQUEST_URI'])){
				$this->init();
				echo "bspecific_flight was called";// zu testzwecken
				break;
			}elseif(preg_match("/\btrack\b/i", $_SERVER['REQUEST_URI'])){
				$this->init();
				echo "btrack was called";// zu testzwecken
				break;
			}elseif(preg_match("/\bairplanes\b/i", $_SERVER['REQUEST_URI'])){
				$this->init();
				echo "search_controller was called";// zu testzwecken
				break;
			}elseif(preg_match("/\baircrafts\b/i", $_SERVER['REQUEST_URI'])){
			echo "search_controller was called";// zu testzwecken
				$this->init();
				echo "search_controller was called";// zu testzwecken
				break;
			}elseif(preg_match("/\bcontact\b/i", $_SERVER['REQUEST_URI'])){
				$this->init();
				echo "search_controller was called";// zu testzwecken
				break;
			}else{
				$this->init();
				echo "default init";
				break;
			}

		case 'POST':// store the submitted user data in case of post
				echo "<p>case POST on controller called</p>";// zu testzwecken
			$this->create();
			break;
		default:
			break;
		}

	}
	/* 	try to ignore url typos and replace them with valid chars if possible */
	public static function encodeUrl($url) {
		$specialChars = array(
			"ä"=>"ae",
			"ö"=>"oe",
			"ü"=>"ue",
			"é|ê|è" => "e",
			"á|â|à" => "a",
			"ç" => "c"
		);
		foreach ($specialChars as $find=>$replace){
			$url = preg_replace("/($find)/i", $replace, $url);
		}
		// Replace whitespace chars
		$url = preg_replace('/\s/', '-', $url);
		// Remove all remaining disallowed chars
		$url = preg_replace('/[^a-zA-Z0-9_\-\.]/', '', $url);
		// Replace multiple '-' chars with a single '-'
		$url = preg_replace('/(\-)+/', '-', $url);
		return $url;
	}

}
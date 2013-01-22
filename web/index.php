<!DOCTYPE HTML>
<?php
include_once 'config/config.php';// alle konstanten sind im config file definiert
// bitch
?>

<html lang="de">
<head>
    <meta name="description" content="Flighttracker system">
    <meta name="author" content="Andreas Maerki">
    <meta charset="utf-8">

   
<script src="http://code.jquery.com/jquery-1.9.0.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
    
 <script src="/js/formular.js"></script>

    <title>Flighttracker Home</title>
    <link rel="stylesheet" type="text/css" href="/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/styleMod.css">
    <link rel="stylesheet" type="text/css" href="css/AircraftDetails.css">
    <link rel="stylesheet" type="text/css" href="/css/homeView.css">
    
</head>

<body id="wholePage">
    <div id="wrapper">
        <div id="head">
            <h1>Welcome to Flight Tracker<small>Find flights, Airports, Planes and Airlines in no Time!</small></h1>
        </div>

        <div id="content">
            <nav>
                <ul id="navigationBar">
                    <?php
                    $currentUri = getCurrentURI();
                    foreach (getMenu() as $href => $title) { //getMenu() is coded out below and returns a array
                        // below is a simplified if statement
                        //if URI= the the menuitem add it to the class selected to style it differently, else class is empty
                        echo "<li><a href=\"$href\" " . (($href == $currentUri) ? "class=\"selected\" " : "") . ">$title</a></li>\n";
                    }
                    ?>
                </ul>
            </nav>

            <div id="body">
                <?php
                $controller = null;

                switch(getCurrentURI()){
                
                case URI_TRACK:
                    include_once 'controller/TrackController.php';
                    $controller = new TrackController();
                    break;
                case URI_CONTACT:
                    include_once 'view/contactView/ContactInitView.php';
                    //$controller = new ContactInitView();
                    echo "<p>contact controller not implementet </p>";
                    break;
                case URI_SEARCH_CONTROLLER:
                	include_once 'controller/SearchController.php';
                	$controller = new SearchController();
                	//echo "<p>case SearchController called in index</p>";
                    break;
               case URI_NEXT_FLIGHTS:
                	include_once 'controller/NextFlightsController.php';
                	$controller = new NextFlightsController();
                	echo 'controller/NextFlightsController';
                	//echo "<p>case SearchController called in index</p>";
                    break;
                case URI_SPECIFIC_FLIGHT:
                	include_once('controller/ShowFlightsController.php');
                	//$controller = new SearchController();
                	echo "<p>not implemented jet</p>";
					echo "<p>case ShowFlightsController called in index</p>";
                    break;
                case URI_AIRLINES:
                	include_once('controller/AirlinesController.php');
                	//$controller = new SearchController();
                	echo "<p>not implemented jet</p>";
					echo "<p>case ShowFlightsController called in index</p>";
                    break;
                case URI_AIRPORTS:
                	include_once('controller/AirportController.php');
                	//$controller = new SearchController();
                	echo "<p>not implemented jet</p>";
					echo "<p>case ShowFlightsController called in index</p>";
                    break;    
                case URI_AIRCRAFTS:
                	include_once('view/aircraftView/AircraftView.php');
                	$controller = new AircraftView();
                	$controller->display();
                    break;
                default:
                    include_once 'controller/HomeController.php';
                    $controller = new HomeController();
                    //echo $_SERVER['REQUEST_URI'];
                    //echo getCurrentURI();
                    break;
                
                }
                
                
                if ($controller != null) {
                    	$controller->route();
                }

                ?>
            </div>
        </div>
    </div><?php

    /**
     * @return array containing all menu items in format [base href] => [title]
     */
    function getMenu() {
        return array(
            URI_HOME => '<img src="images/MapsAirplane.png" alt="Page Logo">',
            URI_TRACK => 'Track',
            URI_AIRPORTS => 'Airports',
            URI_AIRLINES => 'Airlines',
            URI_AIRCRAFTS => 'Aircrafts',
            URI_CONTACT => 'Contact'
        );
    }
    
    function getURIs (){
	return array(
            URI_HOME => '<img src="images/MapsAirplane.png" alt="Page Logo">',
            URI_TRACK => 'Track',
            URI_AIRPORTS => 'Airports',
            URI_AIRLINES => 'Airlines',
            URI_AIRCRAFTS => 'Aircrafts',
            URI_CONTACT => 'Contact',
            URI_NEXT_FLIGHTS => 'next_flights',
            URI_SEARCH_CONTROLLER => 'search',
            URI_SPECIFIC_FLIGHT => 'specific_flight',
            URI_SEARCH_CONTROLLER => 'searchcontroller'
        );
}

    /**
     * @return string the requested menu item URI
     */
    function getCurrentURI() {
        $menu = getURIs();
        if (array_key_exists($_SERVER['REQUEST_URI'], $menu)) {//if requested uri is content of $menu
            return $_SERVER['REQUEST_URI'];
        } else {
            foreach (array_keys(getURIs()) as $href) {
                if (preg_match("@^$href@", $_SERVER['REQUEST_URI'])) {// tryes to ignore typing errors
                    return $href;
                }
            }
        }

        return key($menu);
    }

    ?>
</body>
</html>

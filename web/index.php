<!DOCTYPE HTML>
<?php
include_once 'config/config.php'; // all constants defined in the config file

include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Aircraft.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Airline.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Airport.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Arrivals.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Country.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Flight.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/FlightStatus.php";

?>

<html lang="de">
    <head>
        <meta name="description" content="Flighttracker system">
        <meta name="author" content="Andreas Maerki">
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        
        <script src="/js/vendor/jquery-1.9.0.js"></script>
        <script src="/js/vendor/jquery-ui.js"></script>
        <script src="/js/formular.js"></script>

        <!-- all css have to be combined and minified before release -->
        <title>Flighttracker Home</title>
        <link rel="stylesheet" type="text/css" href="/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="/css/General.css">
        <link rel="stylesheet" type="text/css" href="/css/AircraftDetails.css">
        <link rel="stylesheet" type="text/css" href="/css/homeView.css">
        <link rel="stylesheet" type="text/css" href="/css/Forms.css">
        <link rel="stylesheet" type="text/css" href="/css/Contact.css">
        <link rel="stylesheet" type="text/css" href="/css/FloatWindows.css">
        <link rel="stylesheet" type="text/css" href="/css/FloatWindows.css">
        <link rel="stylesheet" type="text/css" href="/css/cupertino/jquery-ui-1.10.0.custom.css">
        <link rel="stylesheet" type="text/css" href="/css/cupertino/jquery-ui-1.10.0.custom.min.css">

    </head>

    <body id="wholePage" onload="initialize()">
        <div id="overlay"><div> </div></div>
        <div id="wrapper">
            <div id="head">
                <h1>Welcome to Flight Tracker<small>Find flights, Airports, Planes and Airlines in no time!</small></h1>
            </div>

            <div id="content">
                <nav>
                    <ul id="navigationBar">
                        <?php
                        $currentUri = getCurrentURI();
                        foreach (getMenu() as $href => $title) { //getMenu() returns array
                            //if URI= menuitem add it to the class selected to style it differently, else class is empty
                            echo "<li><a href=\"$href\" " . (($href == $currentUri) ? "class=\"selected\" " : "") . ">$title</a></li>\n";
                        }
                        ?>
                    </ul>
                </nav>

                <div id="body" >
                    <?php
                    $controller = null;
                    //the uri determines wich controller will be instaciated;
                    switch (getCurrentURI()) {

                        case URI_TRACK:
                            include_once 'controller/TrackController.php';
                            $controller = new TrackController('');
                            break;
                        case URI_CONTACT:
                            include_once 'controller/ContactController.php';
                            $controller = new ContactController();
                            break;
                        case URI_NEXT_FLIGHTS:
                            include_once 'controller/NextFlightsController.php';
                            $controller = new NextFlightsController();
                            break;
                        case URI_AIRLINES:
                            include_once('controller/AirlineController.php');
                            $controller = new AirlineController();
                            break;
                        case URI_AIRLINE_DETAILS://not in use: remove or implement before release!
                            include_once('controller/FloatController.php');
                            $controller = new FloatController();
                            $controller->setFloatId(FLOAT_ID_AIRLINE);
                            break;
                        case URI_AIRPORTS:
                            include_once('controller/AirportController.php');
                            $controller = new AirportController();
                            break;
                        case URI_AIRPORT_DETAILS://not in use: remove or implement before release!
                            include_once('controller/FloatController.php');
                            $controller = new FloatController();
                            $controller->setFloatId(FLOAT_ID_AIRPORT);
                            break;
                        case URI_AIRCRAFTS:
                            include_once('controller/AircraftController.php');
                            $controller = new AircraftController();
                            break;
                        case URI_AIRCRAFT_DETAILS://not in use: remove or implement before release!
                            include_once('controller/FloatController.php');
                            $controller = new FloatController();
                            $controller->setFloatId(FLOAT_ID_AIRCRAFT);
                            break;
                        default:
                            include_once 'controller/HomeController.php';
                            $controller = new HomeController();
                            break;
                    }


                    if ($controller != null) {
                        $controller->route();
                    }
                    ?>
                </div>
                <div id="footer">
                    <p>Copyright &copy; 2013 by Flighttracker Corporation. All rights reserved. </p>
                </div>
            </div>
        </div><?php

                    /**
                     * @return array containing all menu items in format [base href] => [title]
                     */
                    function getMenu() {
                        return array(
                            URI_HOME => '<img src="/images/MapsAirplane.png" alt="Home">',
                            URI_TRACK => 'Track',
                            URI_AIRPORTS => 'Airports',
                            URI_AIRLINES => 'Airlines',
                            URI_AIRCRAFTS => 'Aircrafts',
                            URI_CONTACT => 'Contact'
                        );
                    }
                    /*
                     * @retuen all URIs 
                     *all URIs defined in config.php must be returned with this array for the
                     *navigation to work propperly
                     */
                    function getURIs() {
                        return array(
                            URI_HOME => 'Home',
                            URI_TRACK => 'Track',
                            URI_AIRPORTS => 'Airports',
                            URI_AIRLINES => 'Airlines',
                            URI_AIRCRAFTS => 'Aircrafts',
                            URI_CONTACT => 'Contact',
                            URI_NEXT_FLIGHTS => 'next_flights',
                            URI_SEARCH_CONTROLLER => 'search',
                            URI_SPECIFIC_FLIGHT => 'specific_flight',
                            URI_SEARCH_CONTROLLER => 'searchcontroller',
                            URI_AIRCRAFT_DETAILS => 'aircraft_details',
                            URI_AIRLINE_DETAILS => 'airline_details',
                            URI_AIRPORT_DETAILS => 'airport_details'
                        );
                    }

                    /**
                     * @return string the requested menu item URI
                     */
                    function getCurrentURI() {
                        $menu = getURIs();
                        if (array_key_exists($_SERVER['REQUEST_URI'], $menu)) {//if requested uri is content of $getURIs
                            return $_SERVER['REQUEST_URI'];
                        } else {
                            foreach (array_keys(getURIs()) as $href) {
                                if (preg_match("@^$href@", $_SERVER['REQUEST_URI'])) {// isolates keywords
                                    return $href;
                                }
                            }
                        }

                        return key($menu);
                    }
                    ?>
    </body>
</html>

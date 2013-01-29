<?php

include_once ('controller/Controller.php');
include_once ('view/airlineView/AirlineView.php');
include_once ('model/Airline.php');

class AirlineController extends Controller {

    function __construct() {
        
    }

    protected function index() {
        
    }

    protected function show() {
        echo " show not implemented";
    }

    protected function init() {


        $airline = Array();
        $airlineCode = Array();
        $airlinesPerPage = array();
        $airlineCodesPerPage = array();

        mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or die(mysql_error());
        mysql_select_db('myFis');

        $req = "SELECT DISTINCT ali_code2, ali_name "
                . "FROM fis_airline";

        $query = mysql_query($req);


        while ($row = mysql_fetch_array($query)) {
            $airline[] = $row[ali_code2];
            $airlineCode[] = $row[ali_name];

            $entriesPerPage = 50;
            //if (isset($airline)) {
                $pages = count($airline) / $entriesPerPage + 1;
            //}
        }
        $view = new AirlineView($airline, $airlineCode, $pages);
        $currentPage = $view->getCurrentPage();
        $airlinesToDisplay = $currentPage * $entriesPerPage - $entriesPerPage;

        for ($i = $airlinesToDisplay; $i < ($airlinesToDisplay + 50); $i++) {
            if ($i < count($airline)) {
                array_push($airlinesPerPage,$airline[$i]);
                array_push($airlineCodesPerPage,$airlineCode[$i]);
            }
        }
        $view->setAirlinesOnThisPage($airlinesPerPage);
        $view->setAirlineCodesOnThisPage($airlineCodesPerPage);
        $view->display();
    }

    protected function create() {
        
    }

}


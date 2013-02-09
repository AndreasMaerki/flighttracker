<?php

include_once ("{$_SERVER['DOCUMENT_ROOT']}/controller/Controller.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/view/airlineView/AirlineView.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/view/airlineView/AirlineDetailView.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/model/Airline.php");
include_once "{$_SERVER['DOCUMENT_ROOT']}/config/config.php";


class AirlineController extends Controller {
    private $clickedItem;


    function __construct() {
        
    }

    protected function index() {
        
            
    }



    protected function init() {

        // arrays needed to sort out the relevant airlines on a specific sub-page
        $airline = Array();
        $airlineCode = Array();
        $airlinesPerPage = array();
        $airlineCodesPerPage = array();
        $airlinePicturePerPage = array();
        $desiredEntriesPerPage = 50; 

        mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or die(mysql_error());
        mysql_select_db('myFis');

        $req = "SELECT DISTINCT ali_code2, ali_name "
                . "FROM fis_airline";

        $query = mysql_query($req);


        while ($row = mysql_fetch_array($query)) {
            $airlineCode[] = $row[ali_code2];
            $airline[] = $row[ali_name];
        }
        
        $pages = count($airline) / $desiredEntriesPerPage + 1;
        //the constructor parameters are used to fill the searchfield. they are not responsible for the display
        $view = new AirlineView($airline, $airlineCode, $pages);

            //call method once for every item that needs to be fitered
        $airlinesPerPage = $this->subPageContentFilter( $desiredEntriesPerPage, $airline);
        $airlineCodesPerPage = $this->subPageContentFilter( $desiredEntriesPerPage, $airlineCode);

        $view->setAirlinesOnThisPage($airlinesPerPage);
        $view->setAirlineCodesOnThisPage($airlineCodesPerPage);
        $view->display();
    }

    protected function create() {
        echo 'not jet. be patient!!';
    }
    public function setKlickedItem($param) {
        $this->clickedItem = $param;
    }
    
    public function float() {
        $view = new AirlineDetailView($this->clickedItem);
        $param = $_SERVER['REQUEST_URI'];
        $view->setAirport($param);
        $view->display();
    }

}


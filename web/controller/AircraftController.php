<?php

include_once ("controller/Controller.php");
include_once ("model/Aircraft.php");
include_once ("view/aircraftView/AircraftView.php");

class AircraftController extends Controller {

    protected function init() {

        $aircraftName = Array();
        $acrCode = Array();
        $aircraftsPerPage = array();
        $aircraftCodesPerPage = array();
        $aircraftPicturePerPage = array();
        $desiredEntriesPerPage = 30;


        $aircraftName = Array();
        $acrCode = Array();

        mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or die(mysql_error());
        mysql_select_db('myFis');

        $req = "SELECT acr_series, acr_code "
                . "FROM fis_aircraft";

        $query = mysql_query($req);

        while ($row = mysql_fetch_array($query)) {
            $aircraftName[] = $row[acr_series];
            $acrCode[] = $row[acr_code];
        }

        $pages = count($aircraftName) / $desiredEntriesPerPage + 1;
        //the constructor parameters are used to fill the searchfield. they are not responsible for the display
        $view = new AircraftView($aircraftName, $airlineCode, $pages);

        //call method once for every item that needs to be fitered
        $aircraftsPerPage = $this->subPageContentFilter($desiredEntriesPerPage, $aircraftName);
        $aircraftCodesPerPage = $this->subPageContentFilter($desiredEntriesPerPage, $acrCode);

        $view->setAircraftsOnThisPage($aircraftsPerPage);
        $view->setAircraftCodesOnThisPage($aircraftCodesPerPage);
        $view->display();
    }

    protected function index() {
        echo "SearchController index not implemented jet";
    }

    protected function show() {
        echo"SearchController show not implemented jet";
    }

    protected function create() {


        $this->init();
    }

    public function float() {
        echo"float not implemented";
    }

}

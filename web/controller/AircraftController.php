<?php

include_once ("{$_SERVER['DOCUMENT_ROOT']}/controller/Controller.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/model/Aircraft.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/view/aircraftView/AircraftView.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/controller/SearchController.php");

class AircraftController extends Controller {

    private $searchController;
    private $aircraftName = array();
    private $acrCode = array();
    private $manufacturer = array();
    private $aircraftsPerPage = array();
    private $aircraftCodesPerPage = array();
    private $acrImage = array();
    private $allAircrafts;

    function __construct() {
        $this->searchController = new SearchController();
    }
    //initialisation of the page 
    protected function init() {
        $desiredEntriesPerPage = 30;
        $allAircrafts = $this->searchController->getAllAircrafts();

        foreach ($allAircrafts as $aircraftOb) {
            $image = $aircraftOb->getImage();
            if ($image == "") {//if no image in db, get the default image.
                $image = "/images/aircraft/default.jpg";
            }
            array_push($this->aircraftName, $aircraftOb->getName());
            array_push($this->manufacturer, $aircraftOb->getAircraftManufacturer()->getName());
            array_push($this->acrCode, $aircraftOb->getCode());
            array_push($this->acrImage, $image);
        }

        $pages = count($this->aircraftName) / $desiredEntriesPerPage + 1;
        //the constructor parameters are used to fill the searchfield. they are not responsible for the display
        $view = new AircraftView($this->acrCode, $this->aircraftName, $pages, $allAircrafts);

        //call method once for every item that needs to be fitered
        $aircraftsPerPage = $this->subPageContentFilter($desiredEntriesPerPage, $this->aircraftName);
        $aircraftCodesPerPage = $this->subPageContentFilter($desiredEntriesPerPage, $this->acrCode);
        $aircraftImagesPerPage = $this->subPageContentFilter($desiredEntriesPerPage, $this->acrImage);
        $aircraftMan = $this->subPageContentFilter($desiredEntriesPerPage, $this->manufacturer);

        $view->setAircraftsOnThisPage($aircraftsPerPage);
        $view->setAircraftCodesOnThisPage($aircraftCodesPerPage);
        $view->setAircraftPicOnThisPage($aircraftImagesPerPage);
        $view->setAircraftManufacturer($aircraftMan);
        $view->display();
    }



    /**
     * create is called after the user has submitted a search string.
     * it sends the query string to the SearchController wich fetches the
     * requiered data from the database.
     */
    protected function create() {
        //for the rebuild of the selection list. This is not a optimal solution.
        //swapping the content of the page would be more elegant
        $allAircrafts = $this->searchController->getAllAircrafts();
        foreach ($allAircrafts as $aircraftOb) {
            array_push($this->aircraftName, $aircraftOb->getName());
            array_push($this->manufacturer, $aircraftOb->getAircraftManufacturer()->getName());
            array_push($this->acrCode, $aircraftOb->getCode());
            array_push($this->acrImage, $aircraftOb->getImage());
        }

        $aircraft_code = trim($_POST['aircraftSearch']);

        $aircraft = $this->searchController->getAircraft($aircraft_code);


        if (!empty($aircraft)) {
            $aircraftCode[] = $aircraft[0]->getCode();
            $aircraftPictures[] = $aircraft[0]->getImage();
            $aircraftName[] = $aircraft[0]->getName();
            $aircraftMan[] = $aircraft[0]->getAircraftManufacturer()->getName();
            $view = new AircraftView($this->acrCode, $this->aircraftName, 0, $allAircrafts);
            $view->setAircraftsOnThisPage($aircraftName);
            $view->setAircraftCodesOnThisPage($aircraftCode);
            $view->setAircraftPicOnThisPage($aircraftPictures);
            $view->setAircraftManufacturer($aircraftMan);
            $view->display();
        }
    }

}

<?php

include_once ("{$_SERVER['DOCUMENT_ROOT']}/controller/Controller.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/controller/SearchController.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/view/airlineView/AirlineView.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/view/airlineView/AirlineDetailView.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/model/Airline.php");
include_once "{$_SERVER['DOCUMENT_ROOT']}/config/config.php";

class AirlineController extends Controller {

    private $clickedItem;
    private $searchController;
    private $airlines;
    private $airline;
    private $airlinePictures;
    private $airlineCode;

    function __construct() {
        $this->searchController = new SearchController();
    }

    protected function index() {
        
    }

    protected function init() {

        // arrays needed to sort out the relevant airlines on a specific sub-page
        $this->airlines = $this->searchController->getAllAirlines();
        $this->airline = array();
        $this->airlinePictures = array();
        $this->airlineCode = array();
        $desiredEntriesPerPage = 50;
        foreach ($this->airlines as $airlineOb) {
            array_push($this->airlineCode, $airlineOb->getCode());
            array_push($this->airlinePictures, $airlineOb->getImage());
            array_push($this->airline, $airlineOb->getName());
        }

        for ($i = 0; $i < count($this->airline); $i++) {
            if (!$this->airlinePictures[$i]) {
                $this->airlinePictures[$i] = "images/airline/default2.jpg";
            }
        }


        //al name and code

        $pages = count($this->airline) / $desiredEntriesPerPage + 1;
        //the constructor parameters are used to fill the searchfield. they are not responsible for the display
        $view = new AirlineView($this->airline, $this->airlineCode, $pages, $this->airlines);

        //call method once for every item that needs to be fitered
        $airlinesPerPage = $this->subPageContentFilter($desiredEntriesPerPage, $this->airline);
        $airlineCodesPerPage = $this->subPageContentFilter($desiredEntriesPerPage, $this->airlineCode);
        $airlinePicturesPerPage = $this->subPageContentFilter($desiredEntriesPerPage, $this->airlinePictures);

        $view->setAirlinesOnThisPage($airlinesPerPage);
        $view->setAirlineCodesOnThisPage($airlineCodesPerPage);
        $view->setAirlinePicsOnThisPage($airlinePicturesPerPage);
        $view->display();
    }

    protected function create() {
        $this->airlineCode = array();
        $this->airline = array();
        $this->airlines = $this->searchController->getAllAirlines();

        foreach ($this->airlines as $airlineOb) {
            array_push($this->airlineCode, $airlineOb->getCode());
            array_push($this->airline, $airlineOb->getName());
        }
        $airline = $this->searchController->getAirlinesByName($_POST['airlineSearch']);
        if (!empty($airline)) {
            $airlineCode[] = $airline[0]->getCode();
            $airlinePictures = $airline[0]->getImage();
            $airlineName[] = $airline[0]->getName();
            


            $view = new AirlineView($this->airline, $this->airlineCode, 0, $airline);
            $view->setAirlinesOnThisPage($airlineName);
            $view->setAirlineCodesOnThisPage($airlineCode);
            $view->setAirlinePicsOnThisPage($airlinePictures);
            
            $view->display();
        }
    }

    public function setKlickedItem($param) {
        $this->clickedItem = $param;
    }

    public function float() {
//        $view = new AirlineDetailView($this->clickedItem);
//        $param = $_SERVER['REQUEST_URI'];
//        $view->setAirport($param);
//        $view->display();
    }

    protected function show() {
        
    }

}


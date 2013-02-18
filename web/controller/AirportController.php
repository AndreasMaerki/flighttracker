<?php

include_once ("controller/Controller.php");
include_once ("controller/SearchController.php");
include_once ("view/airportView/AirportView.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/controller/SearchController.php");
include_once ("model/Airport.php");

class AirportController extends Controller {

    private $searchController;
    private $clickedItem;
    private $airport;
    private $airportPictures;
    private $countries;
    private $countryStringArray;

    function __construct() {
        $this->searchController = new SearchController();
    }

    protected function index() {
        
    }

    protected function show() {
        echo " show not implemented";
    }

    protected function init() {
        $this->countryStringArray = array();
        $this->countries = $this->searchController->getAllCountrys();
        foreach ($this->countries as $countryOb) {
            array_push($this->countryStringArray, $countryOb->getName());
        }
        $view = new AirportView($this->countryStringArray, null, null, null, null, null);
        $view->display();
    }

    protected function create() {

        // Searchcontroller request
        $this->countryStringArray = array();
        $airports = $this->searchController->getAirportsFromACountry($_POST['airportSearch']);
        $this->countries = $this->searchController->getAllCountrys();
        $airportCodes = array();
        $airportCoutry = array();
        $airportPic = array();
        foreach ($this->countries as $countryOb) {
            array_push($this->countryStringArray, $countryOb->getName());
        }
        if (count($airports) > 0) {
            $airportStringArray = array();
            foreach ($airports as $airportOb) {
                array_push($airportStringArray, $airportOb->getName());
                array_push($airportCodes, $airportOb->getCode());
                array_push($airportCoutry, $airportOb->getCountry()->getName());
                array_push($airportPic, $airportOb->getImage());
            }
            for ($i = 0; $i < count($airportPic); $i++) {
            if (!$airportPic[$i]) {
                $airportPic[$i] = "images/airport/default2.jpg";
            }
        }
            $view = new AirportView($this->countryStringArray, 
                    $airportStringArray, 
                    $airportCodes,
                    $airportCoutry,
                    $airportPic, 
                    $airports);

            $view->display();
        }
    }

    protected function getCountry() {
        $country = $this->searchController->getAllCountrys();
        return $country;
    }

    public function float() {
        echo"float not implemented";
    }

}


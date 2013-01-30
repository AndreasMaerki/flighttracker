<?php

include_once"view/View.php";
include 'config/config.php';

class AircraftView extends View {

    private $acrCode;
    private $aircraftName;
    private $pages;
    private $aircraftsOnThisPage;
    private $aircraftCodesOnThisPage;

    function __construct($acrCode, $aircraftName, $pages) {
        $this->acrCode = $acrCode;
        $this->aircraftName = $aircraftName;
        $this->pages = $pages;
    }

    public function display() {

        $aircraftViewURI = URI_AIRCRAFTS;
        echo "<h2>Check out details on Aircraft types:</h2>\n";
        echo "<div id =\"selectionBarContainer\">";
        echo "<label for=\"countrySearch\">Select AircraftTyp</label>\n";
        echo "<select type=\"search\" action=\"{$aircraftViewURI}\" 
            method=\"POST\" class=\"airportSearchField\" name=\"countrySearch\" size=\"1\">\n";

        for ($i = 0; $i < count($this->acrCode); $i++) {
            echo "<option>" . "(" . utf8_encode($this->acrCode[$i]) .
            ") " . utf8_encode($this->aircraftName[$i])
            . "</option>\n";
        }
        echo "</select>";
        echo "</div>";

        //subpages
        echo "<div class= \"littleLinkBoxContainer\">\n";
        for ($i = 1; $i <= $this->pages; $i++) {
            echo "<div class= \"littleLinkBox\">\n
                        <a href=\"$aircraftViewURI/$i\">$i</a>\n
                  </div>\n";
        }
        echo "</div>\n";


//            display of the results from here
        for ($i = 0; $i < 20; $i++) {

            echo <<<AIRCRAFTS
		<div id="entries">
                    <a class="entry" id = "aircraftEntry" href="">
                        <div class="image">
                                <img src="../../images/Planes/PlanesSmall/s_airberlin_a330_1.jpg" alt="s_airberlin_a330_1" >
                        </div>

                        <div class="e-right">
                            <div class="title">
                                Type:
                            </div>
                            <div class="infoText">
                                Manufaturer:
                            </div>

                            <div class="fabricator">
                                Click for large image!
                            </div>
                        </div>
                        <div class="clear"></div>
                   
                    </a>
                </div>\n
AIRCRAFTS;
        }//end for
        echo '<div class="clear"></div>';
    
        foreach ($this->aircraftsOnThisPage as $key => $value) {
            echo "$value";
        }
        
    }//end display

    public function setAircraftsOnThisPage($airlinesOnThisPage) {
        $this->aircraftsOnThisPage = $airlinesOnThisPage;
    }

    public function setAircraftCodesOnThisPage($airlineCodesOnThisPage) {
        $this->aircraftCodesOnThisPage = $airlineCodesOnThisPage;
    }

}
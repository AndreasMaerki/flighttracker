<?php

include_once"{$_SERVER['DOCUMENT_ROOT']}/view/View.php";
include "{$_SERVER['DOCUMENT_ROOT']}/config/config.php";
/**
 * display all aircrafts in the db. With a searchfield the data can be filtered
 * clicking on a specific entry will show a detail-view if data is in db 
 * @author Andreas Maerki, Mathias Cuel, Philipe Rothen, Marc Hangartner
 */
class AircraftView extends View {

    private $acrCode;
    private $aircraftName;
    private $pages;
    private $aircraftsOnThisPage;
    private $aircraftCodesOnThisPage;
    private $acrPic;
    private $aircraftManufacturer;
    private $aircraft;

    function __construct($acrCode, $aircraftName, $pages, $aircraft) {
        $this->acrCode = $acrCode;
        $this->aircraftName = $aircraftName;
        $this->pages = $pages;
        $this->aircraft = $aircraft;
    }

    public function display() {

        $aircraftViewURI = URI_AIRCRAFTS;
        echo "<form action={$aircraftViewURI} method=\"POST\">\n";
        echo "<h2>Check out details on Aircraft types:</h2>\n";
        echo "<div id =\"selectionBarContainer\">\n";
        echo "<label for=\"countrySearch\">Select aircraft type: </label>\n";
        echo "<select type=\"search\" class=\"airportSearchField\" name=\"aircraftSearch\" size=\"1\">\n";

        for ($i = 0; $i < count($this->acrCode); $i++) {
            echo "<option>" . ($this->acrCode[$i])
            . "</option>\n";
        }

        echo "</select>\n";
        // Button      
        echo "<input class=\"button\" type=\"submit\" name=\"aircraftSearchButton\" value=\"find\">\n";
        echo "</form>\n";
        echo "</div>\n";
        
        if ($_POST['countrySearch'] != null) {
            echo $_POST['countrySearch'];
        } else {
            echo "please select";
        }

        //subpages
        echo "<div class= \"littleLinkBoxContainer\">\n";
        for ($i = 1; $i < $this->pages; $i++) {
            echo "<div class= \"littleLinkBox\">\n
                        <a href=\"$aircraftViewURI/$i\">$i</a>\n
                  </div>\n";
        }
        echo "</div>\n";

        $current_aircraft = null;

        // display of the results from here
        for ($i = 0; $i < count($this->aircraftCodesOnThisPage); $i++) {

            foreach ($this->aircraft as $element) {
                if ($element->getCode() == $this->aircraftCodesOnThisPage[$i]) {
                    $current_aircraft = $element;
                }
            }
            if (isset($current_aircraft)){
            $image = $current_aircraft->getImage();
            
            if ($image == "") {
                $image = "/images/aircraft/default.jpg";
            }
            $description = str_replace("'", "", $current_aircraft->getDescription());

            //script responsible for the popups when user clicks on a specific icon
            echo <<<AIRCRAFTS
            <script type="text/javascript">  
            function example_popup{$i}() {  

            var w = window.open('', '', 'width=500,height=600,resizeable,scrollbars');  

            w.document.write('<h2>{$current_aircraft->getCode()} - {$current_aircraft->getName()}</h2><br>'
                             + '<img src=\"{$image}\"><br><br><br>'
                             + '<b>Beschreibung:</b><br>{$description}<br><br>'
                             + '<b>Gewicht:</b> {$current_aircraft->getWeight()}<br>'
                             + '<b>Maximale Passagierzahl:</b> {$current_aircraft->getMaxpassengers()}<br>'
                             + '<b>Maximale Geschwindigkeit:</b> {$current_aircraft->getMaxspeed()}<br>'
                             + '<b>Maximale Distanz:</b> {$current_aircraft->getMaxtraveldist()}<br>'
                             + '<b>Businessclass:</b> {$current_aircraft->getHasbusinessclass()}<br>'
                             + '<b>Firstclass:</b> {$current_aircraft->getHasfirstclass()}<br><br><br>' 
                             + '<a href=\"javascript:window.close()\">Schliessen</a>');
            w.document.close();

            }  

            </script>
            
   
		<div id="entries">
                    <a class="entry" id="aircraftEntry" href="javascript:example_popup{$i}()">
                        <div class="image">
                                <img src="{$image}" 
                                alt="{$this->acrPic[$i]}" >
                        </div>
                        <div class="e-right">
                            <div class="title">
                                Type: {$this->aircraftCodesOnThisPage[$i]}
                            </div>
                            <div class="infoText">
                                Manufaturer:{$this->aircraftManufacturer[$i]}
                            </div>

                        </div>
                        <div class="clear"></div>
                   
                    </a>
                </div>\n
AIRCRAFTS;
            }//end if
        }//end for
        echo '<div class="clear"></div>';
    }

//end display

    public function setAircraftsOnThisPage($airlinesOnThisPage) {
        $this->aircraftsOnThisPage = $airlinesOnThisPage;
    }

    public function setAircraftCodesOnThisPage($airlineCodesOnThisPage) {
        $this->aircraftCodesOnThisPage = $airlineCodesOnThisPage;
    }

    public function setAircraftPicOnThisPage($acrPic) {
        $this->acrPic = $acrPic;
    }

    public function setAircraftManufacturer($aircraftManufacturer) {
        $this->aircraftManufacturer = $aircraftManufacturer;
    }

}

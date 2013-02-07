<?php

include_once"view/View.php";
include 'config/config.php';

class AircraftView extends View {

    private $acrCode;
    private $aircraftName;
    
    private $aircraft;
    private $amount;

    function __construct($acrCode, $aircraftName) {
        $this->acrCode = $acrCode;
        $this->aircraftName = $aircraftName;
        
        //$this->amount = $amount;
        //$this->aircraft = $aircraft;
    }

  

public function display(){
    
    $aircraftViewURI = URI_AIRCRAFTS;
    echo "<h2>Check out details on Aircraft types:</h2>";
    echo "<div id=\"aircraftSearchfieldContainer\">";
    echo "<form action={$aircraftViewURI} method=\"POST\">";
    echo "<label for=\"countrySearch\">Select AircraftTyp</label>";
    echo "<select type=\"search\" class=\"airportSearchField\" name=\"countrySearch\" size=\"1\">";

       for($i=0; $i < count($this->acrCode); $i++){
          echo "<option>" . "(" .utf8_encode($this->acrCode[$i]) . 
                ") " . utf8_encode($this->aircraftName[$i])
                  . "</option>";         
       }
               
       echo "</select>";
       // Button      
        echo "<input class=\"button\" type=\"submit\" name=\"aircraftSearchButton\" value=\"find\">";
       echo "</form>";
       echo "</div>";
       
       // Abfrage ob der Knopf schon gedrückt wurde
       if ($_POST['countrySearch'] != null ){
            
            echo $_POST['countrySearch'];
        }
        else{
            echo "wählen sie aus!";
        }

        for ($i = 0; $i < 20; $i++) {
            echo <<<AIRCRAFTS
		<div id="entries">
                    <a class="entry" href="">

                    <div class="inline">
                        <div class="image">
                                <img src="../../images/Planes/PlanesSmall/s_airberlin_a330_1.jpg" 
                                alt="s_airberlin_a330_1" >
                        </div>

                        <div class="e-right">
                            <div class="title">
                                Plane Type:
                            </div>

                            <div class="infoText">
                                Check the fuckin Plane out:
                            </div>

                            <div class="fabricator">
                                    Manufaturer:
                            </div>
                        </div>

                        <div class="rightImage">
                                <img src="../../images/AirlineLogos/AB_Airlines__formerly_
                                Air_Bristol_-logo-216CE398C3-seeklogo.com.gif" 
                                alt="AB_Airlines__formerly_Air_Bristol_-logo-216CE398C3-seeklogo.com" 
                                width="200" height="200">
                        </div>

                        <div class="clear"></div>
                    </div>
                    </a>
                </div>\n
AIRCRAFTS;
        }//end for
        echo '<div class="clear"></div>';
    }//end display
    }


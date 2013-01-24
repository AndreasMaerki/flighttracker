<?php

include_once"view/View.php";
include 'config/config.php';


class AircraftView extends View{
    
    private $country = array();
     
    private $aircraftViewURI = URI_AIRCRAFTS;
    
    
    function __construct($country2) {
        
        $this->country = $country2;      
        
    }


    

public function display(){

    

    echo "<h2>Check out details on Aircraft types:</h2>";
    
    echo "<label for=\"countrySearch\">Select Country</label>";
    echo "<select type=\"search\" action=\"{$aircraftViewURI}\" methode=\"POST\" class=\"airportSearchField\" name=\"countrySearch\" size=\"1\">";

       for($i=0; $i < count($this->country); $i++){
          echo "<option>" . utf8_encode($this->country[$i]) . "</option>";         
       }
        
       echo "</select><br><br>";

                for($i=0;$i<20;$i++){

                    echo <<<AIRCRAFTS
				<div id="entries">
    <a class="entry" href="/galerie/galerie-hotel/">

    <div class="inline">
        <div class="image">
	        <img src="../../images/Planes/PlanesSmall/s_airberlin_a330_1.jpg" alt="s_airberlin_a330_1" >
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
	        <img src="../../images/AirlineLogos/AB_Airlines__formerly_Air_Bristol_-logo-216CE398C3-seeklogo.com.gif" alt="AB_Airlines__formerly_Air_Bristol_-logo-216CE398C3-seeklogo.com" width="200" height="200">
        </div>

        <div class="clear"></div>
    </div>
    </a>
</div>


AIRCRAFTS;
		}

	}


}
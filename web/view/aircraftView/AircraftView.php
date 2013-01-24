<?php

include_once"view/View.php";


class AircraftView extends View{

public function display(){

    $country = Array();
    
    mysql_connect('localhost', 'root', 'hami') or die( mysql_error() );
    mysql_select_db('myFis');
   

    $req = "SELECT DISTINCT apo_country "
    ."FROM fis_airport";

    $query = mysql_query($req);
    
    while($row = mysql_fetch_array($query))
        {
        $country[] = $row[apo_country];
        
        }

    echo "<h2>Check out details on Aircraft types:</h2>";
    echo "<label for=\"countrySearch\">Select Country</label>";
    echo "<select type=\"search\" class=\"airportSearchField\" name=\"countrySearch\" size=\"1\">";

       for($i=0; $i < count($country); $i++){
          echo "<option>" . utf8_encode($country[$i]) . "</option>";         
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
<?php

include_once"view/View.php";


class AircraftView extends View{

	public function display(){


		echo "<h2>Check out details on Aircraft types:</h2>";
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
<?php

include_once "{$_SERVER['DOCUMENT_ROOT']}/view/view.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/config/config.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor
 */

/**
 * Description of AirportVeiw
 *
 * @author Andreas Maerki
 */
class AirportView extends View {

    private $airports;
    private $airportNotFound;
    private $countryList;
    private $amount;

    // Konstruktor
    function __construct($country, $amount, $airports) {
        $this->countryList = $country;
        $this->airports = $airports;
        $this->amount = $amount;
    }

    public function display() {
        $airportsUri = URI_AIRPORTS;
        echo "<h2>Check out details on Airports:</h2>";
        echo "<div id =\"selectionBarContainer\">";


        // Suchfeld 
        echo "<form action={$airportsUri} method=\"POST\">";
        echo "<label for=\"countrySearch\">Select Country</label>";
        echo "<select type=\"search\"  class=\"airportSearchField\" name=\"airportSearch\" size=\"1\">";
        for ($i = 0; $i < count($this->countryList); $i++) {
            echo "<option>" . utf8_encode($this->countryList[$i]) . "</option>";
        }
        echo "</select>";
        //Button 
        echo "<input class=\"button\" type=\"submit\" methode=\"POST\" name=\"airlineSearchbutton\" value=\"find\">\n";
        echo "</form>";
        echo "</div>\n";

        if (isset($this->airports)) {

            echo $_POST['airportSearch'];
            echo $this->countryList;
            echo $this->airports;
            echo $this->amount;
        }
        echo "<div id=\"entries\">";
        for ($i = 0; $i < $this->amount; $i++) {
            echo <<<AIRPORTS
                    <a class="entry" href="">

                    <div class="inline">
                        <div class="image">
                                <img src="../../images/Planes/PlanesSmall/s_airberlin_a330_1.jpg" 
                                alt="s_airberlin_a330_1" >
                        </div>
                        <div class="e-right">
                            <div class="title">
                                Airport: {$this->airports[$i]}
                            </div>
                            <div class="infoText">
                                Aiport Code: {$this->code[$i]}
                            </div>
                            <div class="fabricator">
                                    Country: {$this->country[$i]}
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
AIRPORTS;
        }//end for
        echo "</div>\n";



        if ($this->airports) {
            foreach ($this->airports as $value) {
                //paste your hmtl code here Phil!!
            }
        } else if ($this->airportNotFound) {
            echo "<div class = \"errorMessage\"> Sorry, Airport <b>" . $this->airportNotFound . "</b>not found!</div>\n";
        }
    }

//end method

    public function setAirports($airports) {
        $this->airports = $airports;
    }

    public function setErrorMessage($airportNotFound) {
        $this->airportNotFound = $airportNotFound;
    }

}


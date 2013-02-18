<?php

include_once "{$_SERVER['DOCUMENT_ROOT']}/view/view.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/config/config.php";
/**
 * Description of AirportVeiw
 * displayes airports in small klickable divs, and includes some informations 
 * about it
 *
 * @author Andreas Maerki, Mathias Cuel, Philipe Rothen, Marc Hangartner
 */
class AirportView extends View {

    private $airports;
    private $airportNotFound;
    private $countryList;
    private $amount;
    private $airportCodes;
    private $airportCountry;
    private $airportPic;
    private $airportObject;

    /**
     * 
     * @param type $country array()
     * @param type $airports array()
     * @param type $airpotCodes array() 
     * @param type $airportCountry array()
     * @param type $airportPic array()
     */
    function __construct($country, $airports, $airpotCodes, $airportCountry,$airportPic, $airportObject) {
        $this->countryList = $country;
        $this->airports = $airports;
        $this->airportCodes = $airpotCodes;
        $this->airportCountry = $airportCountry;
        $this->airportPic = $airportPic;
        $this->airportObject = $airportObject;
    }

    public function display() {
        $airportsUri = URI_AIRPORTS;
        echo "<h2>Check out details on Airports:</h2>";
        echo "<div id =\"selectionBarContainer\">";


        // searchform 
        echo "<form action={$airportsUri} method=\"POST\">";
        echo "<label for=\"countrySearch\">Select Country</label>";
        echo "<select type=\"search\"  class=\"airportSearchField\" name=\"airportSearch\" size=\"1\">";
        for ($i = 0; $i < count($this->countryList); $i++) {
            echo "<option>" . ($this->countryList[$i]) . "</option>";
        }
        echo "</select>";
        echo "<input class=\"button\" type=\"submit\" methode=\"POST\" name=\"airlineSearchbutton\" value=\"find\">\n";
        echo "</form>";
        echo "</div>\n";

        echo "<div id=\"entries\">";
        /**
         * iterates thru the entries and generates a image  
         */
        for ($i = 0; $i < count($this->airports); $i++) {
            
            foreach($this->airportObject as $element)
            {
                if ($element->getCode2() == $this->airportCodes[$i]) {
                    $current_airport = $element;
                }
            }
            $image = $current_airport->getImage();
            
            if ($image == "") {
                $image = "/images/airport/default2.jpg";
            }
            

            if ($image[0] != "/") {
                $image = "/".$image;
            }
            
            $description = str_replace("'","",$current_airport->getDescription());
            $description = preg_replace('#\r|\n#', '', $description);

            
            //script responsible for the popups when user clicks on a specific icon
            echo <<<AIRPORTS
      <script type="text/javascript">  
            function example_popup{$i}() {  

            var w = window.open('', '', 'width=500,height=600,resizeable,scrollbars');  

            w.document.write('<h2>{$current_airport->getCode2()} - {$current_airport->getName()}</h2><br>'
                             + '<img src=\"{$image}\"><br>'
                             + '<b>Beschreibung:</b><br>{$description}<br>'
                             + '<b>Land:</b> {$current_airport->getCountry()->getName()}<br>'
                             + '<b>Währung:</b> {$current_airport->getCountry()->getCurrency()->getName()}<br>'
                             + '<b>International:</b> {$current_airport->getInternational()}<br><br><br>'
                             + '<a href=\"javascript:window.close()\">Schliessen</a>');
            w.document.close();

            }  

      </script>
            
                    <a class="entry" href="javascript:example_popup{$i}()">
                        <div class="image">
                                <img src="/{$this->airportPic[$i]}" 
                                alt="{$this->airportPic[$i]}" >
                        </div>
                        <div class="e-right">
                            <div class="title">
                                Airport: {$this->airports[$i]}
                            </div>
                            <div class="infoText">
                                Aiport Code: {$this->airportCodes[$i]}
                            </div>
                            <div class="fabricator">
                                    Country: {$this->airportCountry[$i]}
                            </div>
                        </div>
                    </a>\n
AIRPORTS;
        }//end for
        echo "</div>\n";
        echo "<div class=\"clear\"></div>\n";


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


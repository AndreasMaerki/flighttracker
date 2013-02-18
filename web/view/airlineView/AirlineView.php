<?php

include_once "{$_SERVER['DOCUMENT_ROOT']}/view/View.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/config/config.php";

/**
 * Description of AirlineVeiw
 *
 * @author andy1111
 */
class AirlineView extends View {

    private $airline;
    private $airlineCode;
    private $pages;
    private $airportNotFound;
    private $currentPage = 1;
    private $airlinesOnThisPage;
    private $airlineCodesOnThisPage;
    private $airlinePicturesOnThisPage;
    private $airlineObject;

    // Konstruktor
    function __construct($airline, $airlineCode, $pages, $airlineObject) {
        $this->airline = $airline;
        $this->airlineCode = $airlineCode;
        $this->pages = $pages;
        $this->airlineObject = $airlineObject;
    }

    public function display() {
        $airlineUri = URI_AIRLINES;
        echo "<h2>Check out details on Airlines:</h2>";
        echo "<div id =\"selectionBarContainer\">";
        echo "<form action={$airlineUri} method=\"POST\">";
        echo "<label for=\"countrySearch\">Select Airline</label>";
        echo "<select type=\"search\" class=\"airportSearchField\" name=\"airlineSearch\" size=\"1\">";
        for ($i = 0; $i < count($this->airline); $i++) {
            echo "<option>". utf8_encode($this->airline[$i]). "</option>";
        }// end for

        echo "</select>\n";
        echo "<div class=\"searchField\">\n";
        echo "<input class=\"button\" type=\"submit\" name=\"Search\" value=\"find\">\n";
        echo "</div>\n";
        echo "</div>";
        echo "</form>";

        //subpages
        echo "<div class= \"littleLinkBoxContainer\">\n";
        for ($i = 1; $i <= $this->pages; $i++) {
            echo "<div class= \"littleLinkBox\">\n
                        <a href=\"$airlineUri/$i\">$i</a>\n
                  </div>\n";
        }
        echo "</div>\n";
        echo "<div id=\"entries\">";
        
        for ($i=0;$i<count($this->airlinesOnThisPage);$i++){
 
           
            foreach($this->airlineObject as $element)
            {
                if ($element->getName() == $this->airlinesOnThisPage[$i]) {
                    $current_airline = $element;
                }
            }
            $image = $current_airline->getImage();
            
            if ($image == "") {
                $image = "/images/airline/default2.jpg";
            }
            

            if ($image[0] != "/") {
                $image = "/".$image;
            }
            
            $description = str_replace("'","",$current_airline->getDescription());
            $description = preg_replace('#\r|\n#', '', $description);
            $city = str_replace("'","",$current_airline->getCity());
            $adress = str_replace("'","",$current_airline->getAdress());
            $phone = str_replace("'","",$current_airline->getPhone());
            $email = str_replace("'","",$current_airline->getEmail());

            
            
                $currentAirline = utf8_encode($this->airline[$test]);
                $uri = URI_AIRLINE_DETAILS;
               
                //script responsible for the popups when user clicks on a specific icon
                echo <<<AIRLINES
                
        <script type="text/javascript">  
            function example_popup{$i}() {  

            var w = window.open('', '', 'width=500,height=600,resizeable,scrollbars');  

            w.document.write('<h2>{$current_airline->getCode2()} - {$current_airline->getName()}</h2><br>'
                             + '<img src=\"{$image}\"><br>'
                             + '<b>Beschreibung:</b><br>{$description}<br>'
                             + '<b>Adresse:</b> {$adress}<br>'
                             + '<b>PLZ:</b> {$current_airline->getPostcode()}<br>'
                             + '<b>Ort:</b> {$city}<br>'
                             + '<b>Tel.:</b> {$phone}<br>'
                             + '<b>E-Mail:</b> {$email}<br><br><br>'
                             + '<a href=\"javascript:window.close()\">Schliessen</a>');
            w.document.close();

            }  

            </script>

                    <a class="entry" id ="airlineEntry" href="javascript:example_popup{$i}()">
                        <div class="image">
                              <img id= "{$this->airlineCodesOnThisPage[$i]}" src="{$image}" alt="{$this->airlinesOnThisPage[$i]}" >
                                  <div class="clear"></div>
                                 <p> {$this->airlinesOnThisPage[$i]}</p>
                        </div>
                    </a>
AIRLINES;
        }//end for
        echo "</div>\n";

        
        echo '<div class="clear"></div>';
    }

//end method

    public function setAirports($airports) {
        $this->airports = $airports;
    }

    public function setErrorMessage($airportNotFound) {
        $this->airportNotFound = $airportNotFound;
    }

    public function setAirlinesOnThisPage($airlinesOnThisPage) {
        $this->airlinesOnThisPage = $airlinesOnThisPage;
    }

    public function setAirlinePicsOnThisPage($picsOnThisPage) {
        $this->airlinePicturesOnThisPage = $picsOnThisPage;
    }
    public function setAirlineCodesOnThisPage($airlineCodesOnThisPage) {
        $this->airlineCodesOnThisPage = $airlineCodesOnThisPage;
    }
    public function setRequesteddetailView($requesteddetailView){
        $this->requesteddetailView = $requesteddetailView;
        
    }

    public function getCurrentPage() {
        return $this->currentPage;
    }

}


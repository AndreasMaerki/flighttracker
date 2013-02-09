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

    // Konstruktor
    function __construct($airline, $airlineCode, $pages) {
        $this->airline = $airline;
        $this->airlineCode = $airlineCode;
        $this->pages = $pages;
    }

    public function display() {
        $airlineUri = URI_AIRLINES;
        echo "<h2>Check out details on Airports:</h2>";
        echo "<div id =\"selectionBarContainer\">";
        echo "<label for=\"countrySearch\">Select Airline</label>";
        echo "<select type=\"search\" action=\"{$airlineUri}\" method=\"POST\" class=\"airportSearchField\" name=\"airlineSearch\" size=\"1\">";
        for ($i = 0; $i < count($this->airline); $i++) {
            echo "<option>" . "(" . utf8_encode($this->airline[$i]) .
            ") " . utf8_encode($this->airlineCode[$i])
            . "</option>";
        }// end for

        echo "</select>\n";
        echo "<div class=\"searchField\">\n";
        echo "<input class=\"button\" type=\"submit\" name=\"Search\" value=\"find\">\n";
        echo "</div>\n";
        echo "</div>";

        //subpages
        echo "<div class= \"littleLinkBoxContainer\">\n";
        for ($i = 1; $i <= $this->pages; $i++) {
            echo "<div class= \"littleLinkBox\">\n
                        <a href=\"$airlineUri/$i\">$i</a>\n
                  </div>\n";
        }
        echo "</div>\n";
        //end subpages
        // nur zu testzwecken
        $dir = 'images/AirlineLogos';
        $pictures = scandir($dir);
        $test = 0;
        
        echo "<div id=\"entries\">";
        foreach ($pictures as $key => $imagePath) {
            $test++;
            if ($key > 2) {
                // ende test
                //dies wieder einfuegen
//        if ($this->airline) {
                //display of the results from here
                //bis hier
                $currentAirline = utf8_encode($this->airline[$test]);
                $uri = URI_AIRLINE_DETAILS;
                echo <<<AIRLINES
                    <a class="entry" href = "" >
                        <div class="image">
                              <img id= "$currentAirline" src="/$dir/$imagePath" alt="$imagePath" >
                        </div>
                    </a>
AIRLINES;
            }//end if
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


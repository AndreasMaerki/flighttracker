<?php

include_once 'view/view.php';
include_once 'config/config.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor
 */

/**
 * Description of AirportVeiw
 *
 * @author andy1111
 */
class AirportView extends View {

    private $airports;
    private $airportNotFound;
    private $country;
    
    // Konstruktor
     function __construct($country) {  
        $this->country = $country;            
     }
    
    
    public function display() {
        $airportsUri = URI_AIRPORTS; 
         echo "<h2>Check out details on Airports:</h2>";
        
        // Suchfeld 
        echo "<form action={$airportsUri} method=\"POST\">";
        echo "<label for=\"countrySearch\">Select Country</label>";
        echo "<select type=\"search\"  class=\"airportSearchField\" name=\"airportSearch\" size=\"1\">";
        for($i=0; $i < count($this->country); $i++){
          echo "<option>" . utf8_encode($this->country[$i]) . "</option>";         
        }
        echo "</select>";
        //Button 
        echo "<input class=\"button\" type=\"submit\" methode=\"POST\" name=\"airlineSearchbutton\" value=\"find\">\n";
        echo "</form>";

        if ($_POST['airportSearch'] != null ){
            
            echo $_POST['airportSearch'];
        }
        else{
            echo "wählen sie aus!";
        }
        
        
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


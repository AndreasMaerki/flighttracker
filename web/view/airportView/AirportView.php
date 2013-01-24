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
        
        echo "<label for=\"countrySearch\">Select Country</label>";
        echo "<select type=\"search\" action=\"{$airportsUri}\" methode=\"POST\" class=\"airportSearchField\" name=\"airportSearch\" size=\"1\">";
        for($i=0; $i < count($this->country); $i++){
          echo "<option>" . utf8_encode($this->country[$i]) . "</option>";         
        }
        
       echo "</select><br><br>";
       
       // Altes Button
        echo"<div class=\"searchField\">\n";
        
        echo "<input class=\"button\" type=\"submit\" name=\"Search\" value=\"find\">\n";
        echo "</form>\n</div>\n";


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


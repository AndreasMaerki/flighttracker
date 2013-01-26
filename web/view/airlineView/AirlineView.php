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
class AirlineView extends View {

    private $airline;
    private $airlineCode;
    
    private $airportNotFound;
    
    // Konstruktor
     function __construct($airline, $airlineCode) {  
         $this->airline = $airline; 
         $this->airlineCode = $airlineCode;            
     }
    
    
    public function display() {
        $airlineUri = URI_AIRLINES;   
         echo "<h2>Check out details on Airports:</h2>";
        
         echo "<form action={$airlineUri} method=\"POST\">";
        echo "<label for=\"countrySearch\">Select Airline</label>";
        echo "<select type=\"search\" class=\"airportSearchField\" name=\"airlineSearch\" size=\"1\">";
        for($i=0; $i < count($this->airline); $i++){
          echo "<option>" . "(" .utf8_encode($this->airline[$i]) . 
                ") " . utf8_encode($this->airlineCode[$i])
                  . "</option>";         
        }   
       echo "</select>";    
       // Button      
        echo "<input class=\"button\" type=\"submit\" name=\"airlineSearchButton\" value=\"find\">\n";
        echo "</form>";
        
        if ($_POST['airlineSearch'] != null ){
            
            echo $_POST['airlineSearch'];
        }
        else{
            echo "wählen sie aus!";
        }

        if ($this->airline) {
            foreach ($this->airline as $value) {
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


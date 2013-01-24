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
class AirportVeiw extends View {

    private $airports;
    private $airportNotFound;

    public function display() {
        $airportsUri = URI_AIRPORTS;
        echo '<div class =\"infoMessage\">Please enter a Airport`s name or international code into the searchfield.</div>';
        echo"<div class=\"searchField\">\n";
        echo "<form action=\"{$airportsUri}\" method=\"POST\">Airport: <input type=\"search\" class=\"searchField\" name=\"airport\">\n";
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


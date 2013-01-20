<?php

/**
 * Model des Flugstatus
 *
 * @author Marc Hangartner
 */

class FlightStatus extends MainModel {
    
    
    /**
     * Membervariabeln deklaration
     * 
     * bisher nur diejenigen der Superklasse
     */  
   
    /**
     * Konstruktor
     * 
     * @param type $id
     * @param type $name
     * @param type $description
     * @param type $image 
     */
    function __construct($id, $name, $description, $image) {
        parent::__construct($id, $name, $description, $image);
    } 
    
}

?>

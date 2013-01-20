<?php

/**
 * Model der Flugzeugtypen
 *
 * @author Marc Hangartner
 */

// Includes
include_once 'model/AircraftManufacturer.php';

class Aircraft extends MainModel {

    /**
     * Membervariabeln deklaration 
     */
   
    private $aircraft;                  // Aircraft referenz
    private $aircraftManufacturer;      // Aircraftmanufacturer referenz
   
    private $code;                      // Aircraftcode
    private $description;               // Aircraftbeschreibung
    private $weight;                    // Aircraft Gewicht
    private $maxpassengers;             // Max. Anzahl Passagiere
    private $maxspeed;                  // Max. Geschwindigkeit
    private $maxtraveldist;             // Max. Reisedistanz
    private $maxflightheight;           // Max. Flughöhe
    private $hasfirstclass;             // hat erste Klasse wenn "true"
    private $hasbusniessclass;          // hat busniess Klasse wenn "true"

    
    
    /**    
     *
     * Konstruktor
     * 
     * @param type $id
     * @param type $name
     * @param type $description
     * @param type $image
     * @param type $aircraft
     * @param type $aircraftManufacturer
     * @param type $code
     * @param type $description
     * @param type $weight
     * @param type $maxpassengers
     * @param type $maxspeed
     * @param type $maxtraveldist
     * @param type $maxflightheight
     * @param type $hasfirstclass
     * @param type $hasbusniessclass 
     */
    function __construct($id, $name, $description, $image, $aircraft, $aircraftManufacturer, $code, 
            $description, $weight, $maxpassengers, $maxspeed, $maxtraveldist, 
            $maxflightheight, $hasfirstclass, $hasbusniessclass) {
        
        parent::__construct($id, $name, $description, $image);
        
        $this->aircraft = $aircraft;
        $this->aircraftManufacturer = $aircraftManufacturer;
        $this->code = $code;
        $this->description = $description;
        $this->weight = $weight;
        $this->maxpassengers = $maxpassengers;
        $this->maxspeed = $maxspeed;
        $this->maxtraveldist = $maxtraveldist;
        $this->maxflightheight = $maxflightheight;
        $this->hasfirstclass = $hasfirstclass;
        $this->hasbusniessclass = $hasbusniessclass;
    }

    
    /**
     *
     * @return type 
     */
    public function getAircraft() {
        return $this->aircraft;
    }

    /**
     *
     * @param type $aircraft 
     */
    public function setAircraft($aircraft) {
        $this->aircraft = $aircraft;
    }

    /**
     *
     * @return type 
     */
    public function getAircraftManufacturer() {
        return $this->aircraftManufacturer;
    }

    /**
     *
     * @param type $aircraftManufacturer 
     */
    public function setAircraftManufacturer($aircraftManufacturer) {
        $this->aircraftManufacturer = $aircraftManufacturer;
    }

    /**
     *
     * @return type 
     */
    public function getCode() {
        return $this->code;
    }

    /**
     *
     * @param type $code 
     */
    public function setCode($code) {
        $this->code = $code;
    }

    /**
     *
     * @return type 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     *
     * @param type $description 
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     *
     * @return type 
     */
    public function getWeight() {
        return $this->weight;
    }

    /**
     *
     * @param type $weight 
     */
    public function setWeight($weight) {
        $this->weight = $weight;
    }

    /**
     *
     * @return type 
     */
    public function getMaxpassengers() {
        return $this->maxpassengers;
    }

    /**
     *
     * @param type $maxpassengers 
     */
    public function setMaxpassengers($maxpassengers) {
        $this->maxpassengers = $maxpassengers;
    }

    /**
     *
     * @return type 
     */
    public function getMaxspeed() {
        return $this->maxspeed;
    }

    /**
     *
     * @param type $maxspeed 
     */
    public function setMaxspeed($maxspeed) {
        $this->maxspeed = $maxspeed;
    }

    /**
     *
     * @return type 
     */
    public function getMaxtraveldist() {
        return $this->maxtraveldist;
    }

    /**
     *
     * @param type $maxtraveldist 
     */
    public function setMaxtraveldist($maxtraveldist) {
        $this->maxtraveldist = $maxtraveldist;
    }

    /**
     *
     * @return type 
     */
    public function getMaxflightheight() {
        return $this->maxflightheight;
    }

    /**
     *
     * @param type $maxflightheight 
     */
    public function setMaxflightheight($maxflightheight) {
        $this->maxflightheight = $maxflightheight;
    }

    /**
     *
     * @return type 
     */
    public function getHasfirstclass() {
        return $this->hasfirstclass;
    }

    /**
     *
     * @param type $hasfirstclass 
     */
    public function setHasfirstclass($hasfirstclass) {
        $this->hasfirstclass = $hasfirstclass;
    }

    /**
     *
     * @return type 
     */
    public function getHasbusniessclass() {
        return $this->hasbusniessclass;
    }

    /**
     *
     * @param type $hasbusniessclass 
     */
    public function setHasbusniessclass($hasbusniessclass) {
        $this->hasbusniessclass = $hasbusniessclass;
    }

}

?>

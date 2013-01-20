<?php

/**
 * Model der Flügzeug Codes
 *
 * @author Marc Hangartner
 */


class AircraftCode extends MainModel{

    /**
     * Membervariabeln deklaration
     */
    private $code;      // Aircraftcode
    private $type;      // Aircraftcode typ
    private $wake;      // 
    
   
    /**
     * Konstruktor
     * 
     * @param type $id
     * @param type $name
     * @param type $description
     * @param type $image
     * @param type $code
     * @param type $type
     * @param type $wake 
     */
    function __construct($id, $name, $description, $image, $code, $type, $wake) {
        
        parent::__construct($id, $name, $description, $image);
        
        $this->code = $code;
        $this->type = $type;
        $this->wake = $wake;
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
    public function getType() {
        return $this->type;
    }

    /**
     *
     * @param type $type 
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     *
     * @return type 
     */
    public function getWake() {
        return $this->wake;
    }

    /**
     *
     * @param type $wake 
     */
    public function setWake($wake) {
        $this->wake = $wake;
    }


    

}

?>

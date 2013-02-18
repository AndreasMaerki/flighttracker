<?php

/**
 * Model der Ankünfte
 *
 * @author Marc Hangartner
 */

// Includes
include_once"{$_SERVER['DOCUMENT_ROOT']}/model/Airport.php";

class Arrivals extends MainModel {

    /**
     * Membervariabeln deklaration
     */   
    private $airport;           // Airport Referenz   
    private $code;              // Ankunfts code

    /**
     * Konstruktor
     * 
     * @param type $id
     * @param type $name
     * @param type $description
     * @param type $image
     * @param type $airport
     * @param type $code 
     */
    function __construct($id, $name, $description, $image, $airport, $code) {
        
        parent::__construct($id, $name, $description, $image);
        
        $this->airport = $airport;
        $this->code = $code;
    }

    
    
    /**
     *
     * @return type 
     */
    public function getAirport() {
        return $this->airport;
    }

    /**
     *
     * @param type $airport 
     */
    public function setAirport($airport) {
        $this->airport = $airport;
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

}

?>

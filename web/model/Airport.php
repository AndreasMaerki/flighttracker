<?php

/**
 * Model der Flughäfen
 *
 * @author Marc Hangartner
 */

// Includes
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Country.php";

class Airport extends MainModel{

    /**
     * Membervariabeln deklaration
     */
    private $code;               // Flughafen Code
    private $country;            // Country Referenz   
    private $code2;              // Code2
    private $international;      // Internationale Flüge wenn "true"

    
    /**
     * Konstruktor
     *
     * @param type $code
     * @param type $country
     * @param type $code2
     * @param type $international 
     */
    function __construct($id, $name, $description, $image, 
            $code, $country, $code2, $international) {
        
        parent::__construct($id, $name, $description, $image);
        
        $this->code = $code;
        $this->country = $country;
        $this->code2 = $code2;
        $this->international = $international;
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
    public function getCountry() {
        return $this->country;
    }

    /**
     *
     * @param type $country 
     */
    public function setCountry($country) {
        $this->country = $country;
    }

    /**
     *
     * @return type 
     */
    public function getCode2() {
        return $this->code2;
    }

    /**
     *
     * @param type $code2 
     */
    public function setCode2($code2) {
        $this->code2 = $code2;
    }

    /**
     *
     * @return type 
     */
    public function getInternational() {
        return $this->international;
    }

    /**
     *
     * @param type $international 
     */
    public function setInternational($international) {
        $this->international = $international;
    }
}
?>
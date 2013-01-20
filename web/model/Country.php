<?php

/**
 * Model der Länder
 *
 * @author Marc Hangartner
 */
// Includes
include_once 'model/Currency.php';

class Country extends MainModel {

    /**
     * Membervariabeln deklaration
     */
    private $code;              // Ländercode   
    private $currency;          // Währungs referenz

    /**
     * Konstruktor
     * 
     * @param type $id
     * @param type $name
     * @param type $description
     * @param type $image
     * @param type $code
     * @param type $currency 
     */
    function __construct($id, $name, $description, $image, $code, $currency) {
        
        parent::__construct($id, $name, $description, $image);
        
        $this->code = $code;
        $this->currency = $currency;
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
    public function getCurrency() {
        return $this->currency;
    }

    /**
     *
     * @param type $currency 
     */
    public function setCurrency($currency) {
        $this->currency = $currency;
    }

}

?>

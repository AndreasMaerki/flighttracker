<?php

/**
 * Model der Währungen
 *
 * @author Marc Hangartner
 */

include_once "{$_SERVER['DOCUMENT_ROOT']}/model/MainModel.php";
class Currency extends MainModel{
  
    /**
     * Membervariabeln deklaration
     */
    private $code;              // Währungscode 
    private $number;            // Währungsnummer

    
   /**
    * Konstruktor
    * 
    * @param type $id
    * @param type $name
    * @param type $description
    * @param type $image
    * @param type $code
    * @param type $number 
    */
    function __construct($id, $name, $description, $image, $code, $number) {
        
        parent::__construct($id, $name, $description, $image);
        
        $this->code = $code;
        $this->number = $number;
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
    public function getNumber() {
        return $this->number;
    }

    /**
     *
     * @param type $number 
     */
    public function setNumber($number) {
        $this->number = $number;
    }
    
    
}

?>

<?php

/**
 * Model der Flugzeughersteller
 *
 * @author Marc Hangartner
 */

// Includes
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Country.php";

class AircraftManufacturer extends MainModel{

    /**
     *  Membervariabeln deklaration
     */
    
    private $country;           // Country referenz  
    private $street;            // Strasse
    private $postcode;          // Postleitzahl
    private $city;              // Stadt
    private $phone;             // Telefon
    private $www;               // Internet Domain
    private $email;             // email adresse

    
    
    /**
     * Konstruktor
     * 
     * @param type $id
     * @param type $name
     * @param type $description
     * @param type $image
     * @param type $country
     * @param type $street
     * @param type $postcode
     * @param type $city
     * @param type $phone
     * @param type $www
     * @param type $email 
     */
    function __construct($id, $name, $description, $image, $country, 
            $street, $postcode, $city, $phone, $www, $email) {
       
        parent::__construct($id, $name, $description, $image);
        
        $this->country = $country;
        $this->street = $street;
        $this->postcode = $postcode;
        $this->city = $city;
        $this->phone = $phone;
        $this->www = $www;
        $this->email = $email;
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
    public function getStreet() {
        return $this->street;
    }

    /**
     *
     * @param type $street 
     */
    public function setStreet($street) {
        $this->street = $street;
    }

    /**
     *
     * @return type 
     */
    public function getPostcode() {
        return $this->postcode;
    }

    /**
     *
     * @param type $postcode 
     */
    public function setPostcode($postcode) {
        $this->postcode = $postcode;
    }

    /**
     *
     * @return type 
     */
    public function getCity() {
        return $this->city;
    }

    /**
     *
     * @param type $city 
     */
    public function setCity($city) {
        $this->city = $city;
    }

    /**
     *
     * @return type 
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     *
     * @param type $phone 
     */
    public function setPhone($phone) {
        $this->phone = $phone;
    }

    /**
     *
     * @return type 
     */
    public function getWww() {
        return $this->www;
    }

    /**
     *
     * @param type $www 
     */
    public function setWww($www) {
        $this->www = $www;
    }

    /**
     *
     * @return type 
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     *
     * @param type $email 
     */
    public function setEmail($email) {
        $this->email = $email;
    }


    
}

?>

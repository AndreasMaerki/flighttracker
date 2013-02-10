<?php

/**
 * Model der Fluggesellschaften
 *
 * @author Marc Hangartner
 */

// Includes
include_once 'model/Country.php';

class Airline extends MainModel {

    /**
     * Membervariabeln deklaration
     */
    private $code;              // Fluggesellschaften code   
    private $country;           // Country Referenz       
    private $code2;             // Code 2
    private $callsign;          // 
    private $adress;            // Adresse
    private $postcode;          // Postleitzahl
    private $city;              // Stadt
    private $phone;             // Telefon
    private $www;               // Internet URL
    private $email;             // email adresse

    /**
     * Konstruktor
     * 
     * @param type $id
     * @param type $name
     * @param type $description
     * @param type $image
     * @param type $code
     * @param type $country
     * @param type $code2
     * @param type $callsign
     * @param type $adress
     * @param type $postcode
     * @param type $city
     * @param type $phone
     * @param type $www
     * @param type $email 
     */
    function __construct($id, $name, $description, $image, $code, 
            $country, $code2, $callsign, $adress, $postcode, $city, $phone, $www, $email) {

        parent::__construct($id, $name, $description, $image);
        
        $this->code = $code;
        $this->country = $country;
        $this->code2 = $code2;
        $this->callsign = $callsign;
        $this->adress = $adress;
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
    public function getCallsign() {
        return $this->callsign;
    }

    /**
     *
     * @param type $callsign 
     */
    public function setCallsign($callsign) {
        $this->callsign = $callsign;
    }

    /**
     *
     * @return type 
     */
    public function getAdress() {
        return $this->adress;
    }

    /**
     *
     * @param type $adress 
     */
    public function setAdress($adress) {
        $this->adress = $adress;
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

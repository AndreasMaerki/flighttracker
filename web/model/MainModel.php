<?php

/**
 * Description of MainModel
 *
 * @author Marc Hangartner
 */
 
 include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Aircraft.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/AircraftCode.php";
/* include_once "model/AircraftManufacter.php'; */ //funzt nicht
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Airline.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Arrivals.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Country.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Currency.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Flight.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/FlightStatus.php";

class MainModel {
    
    /**
     * Membervariabeln
     */
    
    private $id;
    private $name;
    private $description;
    private $image;
    
    /**
     * Main Konstruktor
     * 
     * @param type $id
     * @param type $name
     * @param type $description
     * @param type $image 
     */
    function __construct($id, $name, $description, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
    }

    
    // getter and setter
    
    /**
     *
     * @return type 
     */
    public function getId() {
        return $this->id;
    }

    /**
     *
     * @param type $id 
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     *
     * @return type 
     */
    public function getName() {
        return $this->name;
    }

    /**
     *
     * @param type $name 
     */
    public function setName($name) {
        $this->name = $name;
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
    public function getImage() {
        return $this->image;
    }

    /**
     *
     * @param type $image 
     */
    public function setImage($image) {
        $this->image = $image;
    }


    
}






?>

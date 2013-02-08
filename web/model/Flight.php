<?php
/**
 * Model der Flüge
 *
 * @author Marc Hangartner
 */

// Includes
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Airport.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Airline.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Aircraft.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/FlightStatus.php";


class Flight extends MainModel {

    /**
     * Membervariabeln deklaration
     */
    private $number;            // Flight Number
    
    private $airline;           // Airline referenz
    private $airport_from;      // Abfug Airport referenz
    private $airport_to;        // Ziel Airport referenz
    private $aircraft;          // Aircraft referenz
    private $flightstatus;      // Flugstatus referenz

    private $arrival_sced;      // 
    private $arrival_calc;      // 
    private $depart_sced;
    private $depart_calc;
    private $timestamp;         // 
    private $longitude;         // Momentaner Länngengrad
    private $latitude;          // Momentaner Breitengrad
    private $groundspeed;       // 
    private $heading;           //

    
       
    /**
     *
     * Konstruktor
     * 
     * @param type $id
     * @param type $name
     * @param type $description
     * @param type $image
     * @param type $number
     * @param type $airline
     * @param type $airport_from
     * @param type $airport_to
     * @param type $aircraft
     * @param type $flightstatus
     * @param type $arrival_sced
     * @param type $arrival_calc
     * @param type $depart_sced
     * @param type $depart_calc
     * @param type $timestamp
     * @param type $longitude
     * @param type $latitude
     * @param type $groundspeed
     * @param type $heading 
     */
    function __construct($id, $name, $description, $image, $number, $airline, $airport_from, $airport_to, 
                         $aircraft, $flightstatus, $arrival_sced, $arrival_calc,
			 $depart_sced, $depart_calc, $timestamp, $longitude,
                         $latitude, $groundspeed, $heading) {
          

        parent::__construct($id, $name, $description, $image);
        
	$this->number = $number;
	$this->airline = $airline;
	$this->airport_from = $airport_from;
	$this->airport_to = $airport_to;
	$this->aircraft = $aircraft;
	$this->flightstatus = $flightstatus;
	$this->arrival_sced = $arrival_sced;
	$this->arrival_calc = $arrival_calc;
	$this->depart_sced = $depart_sced;
	$this->depart_calc = $depart_calc;
	$this->timestamp = $timestamp;
	$this->longitude = $longitude;
	$this->latitude = $latitude;
	$this->groundspeed = $groundspeed;
	$this->heading = $heading;
   
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

    /**
     *
     * @return type 
     */
    public function getAirline() {
        return $this->airline;
    }

    /**
     *
     * @param type $airline 
     */
    public function setAirline($airline) {
        $this->airline = $airline;
    }

    /**
     *
     * @return type 
     */
    public function getAirport_from() {
        return $this->airport_from;
    }

    /**
     *
     * @param type $airport_from 
     */
    public function setAirport_from($airport_from) {
        $this->airport_from = $airport_from;
    }

    /**
     *
     * @return type 
     */
    public function getAirport_to() {
        return $this->airport_to;
    }

    /**
     *
     * @param type $airport_to 
     */
    public function setAirport_to($airport_to) {
        $this->airport_to = $airport_to;
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
    public function getFlightstatus() {
        return $this->flightstatus;
    }

    /**
     *
     * @param type $flightstatus 
     */
    public function setFlightstatus($flightstatus) {
        $this->flightstatus = $flightstatus;
    }

    /**
     *
     * @return type 
     */
     public function getDepart_sced() {
        return $this->depart_sced;
    }

    /**
     *
     * @param type $depart_sced 
     */
    public function setDepart_sced($depart_sced) {
        $this->depart_sced = $depart_sced;
    }

    /**
     *
     * @return type 
     */
    public function getDepart_calc() {
        return $this->depart_calc;
    }

    /**
     *
     * @param type $depart_calc 
     */
    public function setDepart_calc($depart_calc) {
        $this->depart_calc = $depart_calc;
    }
    
    /**
     *
     * @return type 
     */
    public function getArrival_sced() {
        return $this->arrival_sced;
    }

    /**
     *
     * @param type $arrival_sced 
     */
    public function setArrival_sced($arrival_sced) {
        $this->arrival_sced = $arrival_sced;
    }

    /**
     *
     * @return type 
     */
    public function getArrival_calc() {
        return $this->arrival_calc;
    }

    /**
     *
     * @param type $arrival_calc 
     */
    public function setArrival_calc($arrival_calc) {
        $this->arrival_calc = $arrival_calc;
    }

    /**
     *
     * @return type 
     */
    public function getTimestamp() {
        return $this->timestamp;
    }

    /**
     *
     * @param type $timestamp 
     */
    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }

    /**
     *
     * @return type 
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     *
     * @param type $longitude 
     */
    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    /**
     *
     * @return type 
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     *
     * @param type $latitude 
     */
    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    /**
     *
     * @return type 
     */
    public function getGroundspeed() {
        return $this->groundspeed;
    }

    /**
     *
     * @param type $groundspeed 
     */
    public function setGroundspeed($groundspeed) {
        $this->groundspeed = $groundspeed;
    }

    /**
     *
     * @return type 
     */
    public function getHeading() {
        return $this->heading;
    }

    /**
     *
     * @param type $heading 
     */
    public function setHeading($heading) {
        $this->heading = $heading;
    }



}

?>

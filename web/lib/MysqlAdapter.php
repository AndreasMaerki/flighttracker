<?php

include_once ('lib/FlightXMLAdapter.php');

final class MysqlAdapter {

    private $host;
    private $user;
    private $password;
    private $db;
    private $con;
    private $flightXML;

    function __construct($host, $user, $password, $db) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;

        $this->open();

        $this->flightXML = new FlightXMLAdapter(FXML_HOST, FXML_USER, FXML_PASSWORD);
    }

    public function __destruct() {
        $this->close();
    }

    private function open() {
        $this->con = new mysqli($this->host, $this->user, $this->password, $this->db);
        if ($this->con->connect_error) {
            echo 'DB Error: ' . $this->con->connect_error;
            $this->con = null;
        } else {
            $this->con->set_charset('utf8');
        }
    }

    private function close() {
        if ($this->con != null) {
            $this->con->close();
            $this->con = null;
        }
    }

    private function getDiffDateTime() {
        $checkTimestamp = time() - FXML_MAXAGE;
        $checkDateTime = date("Y-m-d H:i:s", $checkTimestamp);

        return $checkDateTime;
    }

    private function createFlightFromDb($row) {
        $flight_model = new Flight($row['fli_number'], $row['fli_f_ali_id'], $row['fli_f_apo_id_from'], $row['fli_f_apo_id_to'], $row['fli_f_acr_id'], $row['fli_f_fst_id'], $row['fli_arrival_sced'], $row['fli_arrival_calc'], $row['fli_depart_sced'], $row['fli_depart_calc'], $row['fli_timestamp'], $row['fli_longitude'], $row['fli_latitude'], $row['fli_coordinates_log'], $row['fli_groundspeed'], $row['fli_heading']);

        return $flight_model;
    }

    private function createAirlineFromDb($row) {
        $airline_model = new Airline($row['ali_id'], $row['ali_name'], $row['ali_description'], $row['ali_image'], $row['ali_code'], $row['ali_f_ctr_id'], $row['ali_code2'], $row['ali_callsign'], $row['ali_adress'], $row['ali_postcode'], $row['ali_city'], $row['ali_phone'], $row['ali_www'], $row['ali_email']);

        return $airline_model;
    }

    private function createAirportFromDb($row) {
        $airport_model = new Airport($row['apo_id'], $row['apo_name'], $row['apo_description'], $row['apo_image'], $row['apo_code'], $row['apo_f_ctr_id'], $row['apo_code2'], $row['apo_international']);

        return $airport_model;
    }

    private function createAircraftFromDb($row) {
        $aircraft_model = new Aircraft($row['acr_id'], $row['acr_name'], $row['acr_description'], $row['acr_image'], $row['acr_f_ama_id'], $row['acr_code'], $row['acr_description'], $row['acr_weight'], $row['acr_maxpassengers'], $row['acr_maxspeed'], $row['acr_maxtraveldist'], $row['acr_maxflightheight'], $row['acr_hasfirstclass'], $row['acr_hasbusinessclass']);

        return $aircraft_model;
    }

    private function createCurrencyFromDb($row) {
        $currency = new Currency($row['cur_id'], $row['cur_name'], $row['cur_description'], $row['cur_country'], $row['cur_code'], $row['cur_number']);

        return $currency;
    }

    public function getFlight($flightnumber) {

        $flightnumber = trim($flightnumber);
        $flightnumber = str_replace(" ", "", $flightnumber);

        $res = $this->con->query("SELECT * FROM fis_flight WHERE fli_number='$flightnumber' AND fli_timestamp >= '" . $this->getDiffDateTime() . "'");

        if ($res->num_rows >= 1) {
            $row = $res->fetch_assoc();
            $flight = $this->createFlightFromDb($row);
            $res->free();
        } else {
            $res = $this->con->query("DELETE FROM fis_flight WHERE fli_number = '$flightnumber'");

            $flight = $this->flightXML->getFlight($flightnumber);
            $amount = count($flight);


            if ($amount >= 1) {
                $airline_code = preg_replace("/[0-9]/", '', $flightnumber);
                $current_time = date("Y-m-d H:i:s", time());
                $airport_from = (String) $flight->getAirport_from();
                $airport_to = (String) $flight->getAirport_to();
                $aircraft = (String) $flight->getAircraft();
                $flight_status = (String) $flight->getFlightstatus();
                $arrival_sced = (String) $flight->getArrival_sced();
                $arrival_calc = (String) $flight->getArrival_calc();
                $depart_sced = (String) $flight->getDepart_sced();
                $depart_calc = (String) $flight->getDepart_calc();
                $longitude = (String) $flight->getLongitude();
                $latitude = (String) $flight->getLatitude();
                $coordinates_log = (String) $flight->getCoordinates_log();
                $groundspeed = (String) $flight->getGroundspeed();
                $heading = (String) $flight->getHeading();

                // ID Abfrage: Airline
                $res = $this->con->query("SELECT ali_id FROM fis_airline WHERE ali_code LIKE '$airline_code' OR ali_code2 LIKE '$airline_code'");
                if ($res->num_rows >= 1) {
                    $row = $res->fetch_assoc();
                    $airline_id = $row['ali_id'];
                } else {
                    $airline_id = 0;
                }
                $flight->setAirline($airline_id);
                $res->free();

                // ID Abfrage: Airport From
                $res = $this->con->query("SELECT apo_id FROM fis_airport WHERE apo_code2 LIKE '$airport_from'");
                if ($res->num_rows >= 1) {
                    $row = $res->fetch_assoc();
                    $airport_from_id = $row['apo_id'];
                } else {
                    $airport_from_id = 0;
                }
                $flight->setAirport_from($airport_from_id);
                $res->free();

                // ID Abfrage: Airport To

                $res = $this->con->query("SELECT apo_id FROM fis_airport WHERE apo_code2 LIKE '$airport_to'");
                if ($res->num_rows >= 1) {
                    $row = $res->fetch_assoc();
                    $airport_to_id = $row['apo_id'];
                } else {
                    $airport_to_id = 0;
                }
                $flight->setAirport_to($airport_to_id);
                $res->free();

                // ID Abfrage: Aircraft
                $res = $this->con->query("SELECT acr_id FROM fis_aircraft WHERE acr_code LIKE '$aircraft'");
                if ($res->num_rows >= 1) {
                    $row = $res->fetch_assoc();
                    $aircraft_id = $row['acr_id'];
                } else {
                    $aircraft_id = 0;
                }
                $flight->setAircraft($aircraft_id);
                $res->free();

                $res = $this->con->query("INSERT INTO fis_flight 
                                      (fli_number,
                                      fli_f_ali_id,
                                      fli_f_apo_id_from,
                                      fli_f_apo_id_to,
                                      fli_f_acr_id,
                                      fli_f_fst_id,
                                      fli_arrival_sced,
                                      fli_arrival_calc,
                                      fli_depart_sced,
                                      fli_depart_calc,
                                      fli_timestamp,
                                      fli_longitude,
                                      fli_latitude,
                                      fli_coordinates_log,
                                      fli_groundspeed,
                                      fli_heading)
                                      VALUES
                                      ('$flightnumber',
                                      $airline_id,
                                      $airport_from_id,
                                      $airport_to_id,
                                      $aircraft_id,
                                      '$flight_status',
                                      '$arrival_sced',
                                      '$arrival_calc',
                                      '$depart_calc',
                                      '$depart_sced',
                                      '$current_time',
                                      '$longitude',
                                      '$latitude',
                                      '$coordinates_log',
                                      '$groundspeed',
                                      '$heading')
                                      ");

                echo $this->con->error;
            } else {
                return null;
            }
        }

        // Update Model Data
        $airline = (int) $flight->getAirline();
        $airport_from = (int) $flight->getAirport_from();
        $airport_to = (int) $flight->getAirport_to();
        $aircraft = (int) $flight->getAircraft();

        // ID Abfrage: Airline
        $res = $this->con->query("SELECT * FROM fis_airline WHERE ali_id = $airline");
        $row = $res->fetch_assoc();
        $flight->setAirline($this->createAirlineFromDb($row));
        $res->free();

        // ID Abfrage: Airport From
        $res = $this->con->query("SELECT * FROM fis_airport WHERE apo_id = $airport_from");
        $row = $res->fetch_assoc();
        $flight->setAirport_from($this->createAirportFromDb($row));
        $res->free();

        // ID Abfrage: Airport To
        $res = $this->con->query("SELECT * FROM fis_airport WHERE apo_id = $airport_to");
        $row = $res->fetch_assoc();
        $flight->setAirport_to($this->createAirportFromDb($row));
        $res->free();

        // ID Abfrage: Aircraft
        $res = $this->con->query("SELECT * FROM fis_aircraft WHERE acr_id = $aircraft");
        $row = $res->fetch_assoc();
        $flight->setAircraft($this->createAircraftFromDb($row));
        $res->free();

        return $flight;
    }

    public function getAirportDepartures($airport, $howMany, $offset) {

        $airport = trim($airport);

        // ID Abfrage Airport
        $res = $this->con->query("SELECT apo_id FROM fis_airport WHERE apo_code2 LIKE '$airport'");

        if ($res->num_rows >= 1) {
            // Flughafen gefunden

            $row = $res->fetch_assoc();
            $airport_id = $row['apo_id'];
            $res->free();

            $list = array();
            $airportDepartures = array();

            $res = $this->con->query("SELECT * FROM fis_flight WHERE fli_f_apo_id_from = $airport_id AND fli_f_fst_id ='S' AND fli_timestamp >= '" . $this->getDiffDateTime() . "' AND fli_offset='" . $offset . "' LIMIT " . $howMany);

            if ($res->num_rows >= $howMany) {
                echo "DB Abfrage";

                while ($row = $res->fetch_assoc()) {
                    $flight = $this->createFlightFromDb($row);
                    $list[] = $flight;
                }
                $res->free();
            } //end if
            else {
                $res = $this->con->query("DELETE FROM fis_flight WHERE fli_f_apo_id_from = '$airport_id' AND fli_f_fst_id ='S'");
                $list = $this->flightXML->getAirportDepartures($airport, $howMany, $offset);
                $amount = count($list);

                if ($amount >= 1) {

                    foreach ($list as $flight) {
                        $flightnumber = (String) $flight->getNumber();
                        $airline_code = preg_replace("/[0-9]/", '', $flightnumber);
                        $current_time = date("Y-m-d H:i:s", time());
                        $airport_from = (String) $flight->getAirport_from();
                        $airport_to = (String) $flight->getAirport_to();
                        $aircraft = (String) $flight->getAircraft();
                        $flight_status = (String) $flight->getFlightstatus();
                        $arrival_sced = (String) $flight->getArrival_sced();
                        $depart_sced = (String) $flight->getDepart_sced();

                        // ID Abfrage: Airline
                        $res = $this->con->query("SELECT ali_id FROM fis_airline WHERE ali_code LIKE '$airline_code' OR ali_code2 LIKE '$airline_code'");
                        if ($res->num_rows >= 1) {
                            $row = $res->fetch_assoc();
                            $airline_id = $row['ali_id'];
                        } else {
                            $airline_id = 0;
                        }
                        $flight->setAirline($airline_id);
                        $res->free();

                        // ID Abfrage: Airport From
                        $res = $this->con->query("SELECT apo_id FROM fis_airport WHERE apo_code2 LIKE '$airport_from'");
                        if ($res->num_rows >= 1) {
                            $row = $res->fetch_assoc();
                            $airport_from_id = $row['apo_id'];
                        } else {
                            $airport_from_id = 0;
                        }
                        $flight->setAirport_from($airport_from_id);
                        $res->free();

                        // ID Abfrage: Airport To
                        $res = $this->con->query("SELECT apo_id FROM fis_airport WHERE apo_code2 LIKE '$airport_to'");
                        if ($res->num_rows >= 1) {
                            $row = $res->fetch_assoc();
                            $airport_to_id = $row['apo_id'];
                        } else {
                            $airport_to_id = 0;
                        }
                        $flight->setAirport_to($airport_to_id);
                        $res->free();

                        // ID Abfrage: Aircraft
                        $res = $this->con->query("SELECT acr_id FROM fis_aircraft WHERE acr_code LIKE '$aircraft'");
                        if ($res->num_rows >= 1) {
                            $row = $res->fetch_assoc();
                            $aircraft_id = $row['acr_id'];
                        } else {
                            $aircraft_id = 0;
                        }
                        $flight->setAircraft($aircraft_id);
                        $res->free();

                        $res = $this->con->query("INSERT INTO fis_flight 
                                                (fli_number,
                                                fli_f_ali_id,
                                                fli_f_apo_id_from,
                                                fli_f_apo_id_to,
                                                fli_f_acr_id,
                                                fli_f_fst_id,
                                                fli_arrival_sced,
                                                fli_depart_sced,
                                                fli_timestamp,
                                                fli_offset)
                                                VALUES
                                                ('$flightnumber',
                                                $airline_id,
                                                $airport_from_id,
                                                $airport_to_id,
                                                $aircraft_id,
                                                '$flight_status',
                                                '$arrival_sced',
                                                '$depart_sced',
                                                '$current_time',
                                                $offset)
                                                ");
                    }//end foreach
                }//end if
                else {
                    return null;
                }//end else
            }//end else     

            foreach ($list as $flight) {

                // Update Model Data
                $airline = (int) $flight->getAirline();
                $airport_from = (int) $flight->getAirport_from();
                $airport_to = (int) $flight->getAirport_to();
                $aircraft = (int) $flight->getAircraft();

                // ID Abfrage: Airline
                $res = $this->con->query("SELECT * FROM fis_airline WHERE ali_id = $airline");
                $row = $res->fetch_assoc();
                $flight->setAirline($this->createAirlineFromDb($row));
                $res->free();

                // ID Abfrage: Airport From
                $res = $this->con->query("SELECT * FROM fis_airport WHERE apo_id = $airport_from");
                $row = $res->fetch_assoc();
                $flight->setAirport_from($this->createAirportFromDb($row));
                $res->free();

                // ID Abfrage: Airport To
                $res = $this->con->query("SELECT * FROM fis_airport WHERE apo_id = $airport_to");
                $row = $res->fetch_assoc();
                $flight->setAirport_to($this->createAirportFromDb($row));
                $res->free();

                // ID Abfrage: Aircraft
                $res = $this->con->query("SELECT * FROM fis_aircraft WHERE acr_id = $aircraft");
                $row = $res->fetch_assoc();
                $flight->setAircraft($this->createAircraftFromDb($row));
                $res->free();

                $airportDepartures[] = $flight;
            }
        } else {
            return null;
        }

        return $airportDepartures;
    }

//end function

    public function getAirportArrivals($airport, $howMany, $offset) {

        $airport = trim($airport);

        // ID Abfrage Airport
        $res = $this->con->query("SELECT apo_id FROM fis_airport WHERE apo_code2 LIKE '$airport'");

        if ($res->num_rows >= 1) {
            // Flughafen gefunden

            $row = $res->fetch_assoc();
            $airport_id = $row['apo_id'];
            $res->free();

            $list = array();
            $airportArrivals = array();

            $res = $this->con->query("SELECT * FROM fis_flight WHERE fli_f_apo_id_to = $airport_id AND ( fli_f_fst_id ='A' OR fli_f_fst_id ='L' ) AND fli_timestamp >= '" . $this->getDiffDateTime() . "' AND fli_offset='" . $offset . "' LIMIT " . $howMany);

            if ($res->num_rows >= $howMany) {
                echo "DB Abfrage";

                while ($row = $res->fetch_assoc()) {
                    $flight = $this->createFlightFromDb($row);
                    $list[] = $flight;
                }
                $res->free();
            } //end if
            else {
                $res = $this->con->query("DELETE FROM fis_flight WHERE fli_f_apo_id_to = '$airport_id' AND ( fli_f_fst_id ='A' OR fli_f_fst_id ='L' )");
                $list = $this->flightXML->getAirportArrivals($airport, $howMany, $offset);
                $amount = count($list);

                if ($amount >= 1) {

                    foreach ($list as $flight) {
                        $flightnumber = (String) $flight->getNumber();
                        $airline_code = preg_replace("/[0-9]/", '', $flightnumber);
                        $current_time = date("Y-m-d H:i:s", time());
                        $airport_from = (String) $flight->getAirport_from();
                        $airport_to = (String) $flight->getAirport_to();
                        $aircraft = (String) $flight->getAircraft();
                        $flight_status = (String) $flight->getFlightstatus();
                        $arrival_sced = (String) $flight->getArrival_sced();
                        $depart_sced = (String) $flight->getDepart_sced();

                        // ID Abfrage: Airline
                        $res = $this->con->query("SELECT ali_id FROM fis_airline WHERE ali_code LIKE '$airline_code' OR ali_code2 LIKE '$airline_code'");
                        if ($res->num_rows >= 1) {
                            $row = $res->fetch_assoc();
                            $airline_id = $row['ali_id'];
                        } else {
                            $airline_id = 0;
                        }
                        $flight->setAirline($airline_id);
                        $res->free();

                        // ID Abfrage: Airport From
                        $res = $this->con->query("SELECT apo_id FROM fis_airport WHERE apo_code2 LIKE '$airport_from'");
                        if ($res->num_rows >= 1) {
                            $row = $res->fetch_assoc();
                            $airport_from_id = $row['apo_id'];
                        } else {
                            $airport_from_id = 0;
                        }
                        $flight->setAirport_from($airport_from_id);
                        $res->free();

                        // ID Abfrage: Airport To
                        $res = $this->con->query("SELECT apo_id FROM fis_airport WHERE apo_code2 LIKE '$airport_to'");
                        if ($res->num_rows >= 1) {
                            $row = $res->fetch_assoc();
                            $airport_to_id = $row['apo_id'];
                        } else {
                            $airport_to_id = 0;
                        }
                        $flight->setAirport_to($airport_to_id);
                        $res->free();

                        // ID Abfrage: Aircraft
                        $res = $this->con->query("SELECT acr_id FROM fis_aircraft WHERE acr_code LIKE '$aircraft'");
                        if ($res->num_rows >= 1) {
                            $row = $res->fetch_assoc();
                            $aircraft_id = $row['acr_id'];
                        } else {
                            $aircraft_id = 0;
                        }
                        $flight->setAircraft($aircraft_id);
                        $res->free();

                        $res = $this->con->query("INSERT INTO fis_flight 
                                                (fli_number,
                                                fli_f_ali_id,
                                                fli_f_apo_id_from,
                                                fli_f_apo_id_to,
                                                fli_f_acr_id,
                                                fli_f_fst_id,
                                                fli_arrival_sced,
                                                fli_depart_sced,
                                                fli_timestamp,
                                                fli_offset)
                                                VALUES
                                                ('$flightnumber',
                                                $airline_id,
                                                $airport_from_id,
                                                $airport_to_id,
                                                $aircraft_id,
                                                '$flight_status',
                                                '$arrival_sced',
                                                '$depart_sced',
                                                '$current_time',
                                                $offset)
                                                ");
                    }//end foreach
                }//end if
                else {
                    return null;
                }//end else
            }//end else     

            foreach ($list as $flight) {

                // Update Model Data
                $airline = (int) $flight->getAirline();
                $airport_from = (int) $flight->getAirport_from();
                $airport_to = (int) $flight->getAirport_to();
                $aircraft = (int) $flight->getAircraft();

                // ID Abfrage: Airline
                $res = $this->con->query("SELECT * FROM fis_airline WHERE ali_id = $airline");
                $row = $res->fetch_assoc();
                $flight->setAirline($this->createAirlineFromDb($row));
                $res->free();

                // ID Abfrage: Airport From
                $res = $this->con->query("SELECT * FROM fis_airport WHERE apo_id = $airport_from");
                $row = $res->fetch_assoc();
                $flight->setAirport_from($this->createAirportFromDb($row));
                $res->free();

                // ID Abfrage: Airport To
                $res = $this->con->query("SELECT * FROM fis_airport WHERE apo_id = $airport_to");
                $row = $res->fetch_assoc();
                $flight->setAirport_to($this->createAirportFromDb($row));
                $res->free();

                // ID Abfrage: Aircraft
                $res = $this->con->query("SELECT * FROM fis_aircraft WHERE acr_id = $aircraft");
                $row = $res->fetch_assoc();
                $flight->setAircraft($this->createAircraftFromDb($row));
                $res->free();

                $airportArrivals[] = $flight;
            }
        } else {
            return null;
        }

        return $airportArrivals;
    }

//end function

    public function getAircraft() { // Aircraft abfrage ohne Attribute
        $aircraft = array();
        $res = $this->con->query("SELECT * FROM fis_aircraft");
        while ($row = $res->fetch_assoc()) {
            $aircraft[] = $this->createAircraftHelp($row);
            //$aircraft[] = $list; 
        }

        $res->free();
        return $aircraft;
    }

    public function getAircraftById($aircraft_id) {

        //Abfrage: ID-Aircraft
        $res1 = $this->con->query("SELECT * FROM fis_aircraft WHERE acr_id = '$aircraft_id'");
        $row1 = $res1->fetch_assoc();

        if ($res1->num_rows >= 1) {

            $aircraft_manuf_id = $row1['acr_f_ama_id'];

            //Abfrage: Aircraft Manufacturer
            $res2 = $this->con->query("SELECT * FROM fis_aircraft_manufacturer WHERE ama_id = '$aircraft_manuf_id'");
            $row2 = $res2->fetch_assoc();
            $country_id = $row2['ama_f_ctr_id'];

            //Abfrage: Country
            $res3 = $this->con->query("SELECT * FROM fis_country WHERE ctr_id = '$country_id'");
            $row3 = $res3->fetch_assoc();
            $currency_id = $row3['ctr_f_cur_id'];

            //Abfrage: Currency
            $res = $this->con->query("SELECT * FROM fis_currency WHERE cur_id = '$currency_id'");
            $row = $res->fetch_assoc();

            $currency = $this->createCurrencyFromDb($row);

            $country = new Country($row3['ctr_id'], $row3['ctr_name'], $row3['ctr_description'], $row3['ctr_image'], $row3['ctr_code'], $currency);

            $manuf = new AircraftManufacturer($row2['ama_id'], $row2['ama_name'], $row2['ama_description'], $row2['ama_image'], $country,
                            $row2['ama_street'], $row2['ama_postcode'], $row2['ama_city'], $row2['ama_phone'], $row2['ama_www'],
                            $row2['ama_email']);


            $aircraft = new Aircraft($row1['acr_id'], $row1['acr_series'], $row1['acr_description'], $row1['acr_image'], $row1 [''], $manuf, $row1['acr_code'],
                            $row1['acr_weight'], $row1['acr_maxpassengers'], $row1['acr_maxspeed'], $row1['acr_maxtraveldist'],
                            $row1['acr_maxflightheight'], $row1['acr_hasfirstclass'], $row1['acr_hasbusniessclass']);
        }//end if 
        else {
            return NULL;
        }
        return $aircraft;
    }

//end function

    public function getAircraftByName($aircraft_name) {//Abfrage Aircraft: Attribut Name
        $aircraft = array();
        $res1 = $this->con->query("SELECT * FROM fis_aircraft WHERE acr_series LIKE '%$aircraft_name%'");

        if ($res1->num_rows >= 1) {

            while ($row1 = $res1->fetch_assoc()) {

                $aircraft_manuf_id = $row1['acr_f_ama_id'];

                //Abfrage: DB Aircraft Manufacturer
                $res2 = $this->con->query("SELECT * FROM fis_aircraft_manufacturer WHERE ama_id = '$aircraft_manuf_id'");
                $row2 = $res2->fetch_assoc();
                $country_id = $row2['ama_f_ctr_id'];

                //Abfrage: DB Country für ID
                $res3 = $this->con->query("SELECT * FROM fis_country WHERE ctr_id = '$country_id'");
                $row3 = $res3->fetch_assoc();
                $currency_id = $row3['ctr_f_cur_id'];

                //Abfrage: DB Currency für ID
                $res = $this->con->query("SELECT * FROM fis_currency WHERE cur_id = '$currency_id'");
                $row = $res->fetch_assoc();

                $currency = $this->createCurrencyFromDb($row);

                $country = new Country($row3['ctr_id'], $row3['ctr_name'], $row3['ctr_description'], $row3['ctr_image'], $row3['ctr_code'], $currency);

                $manuf = new AircraftManufacturer($row2['ama_id'], $row2['ama_name'], $row2['ama_description'], $row2['ama_image'], $country,
                                $row2['ama_street'], $row2['ama_postcode'], $row2['ama_city'], $row2['ama_phone'], $row2['ama_www'],
                                $row2['ama_email']);

                $aircraft[] = new Aircraft($row1['acr_id'], $row1['acr_series'], $row1['acr_description'], $row1['acr_image'], $row1 [''], $manuf, $row1['acr_code'],
                                $row1['acr_weight'], $row1['acr_maxpassengers'], $row1['acr_maxspeed'], $row1['acr_maxtraveldist'],
                                $row1['acr_maxflightheight'], $row1['acr_hasfirstclass'], $row1['acr_hasbusniessclass']);
            }//end while
        }//end if
        else {
            return null;
        }
        return $aircraft;
    }

//end function 

    public function getAircraftByManufacturer($aircraft_manufacturer) {
        $aircraft = array();

        $res = $this->con->query("SELECT ama_id FROM fis_aircraft_manufacturer WHERE ama_name LIKE '%$aircraft_manufacturer%'");

        if ($res->num_rows >= 1) {

            $row = $res->fetch_assoc();
            $ama_id = $row['ama_id'];
            $res->free();

            $res1 = $this->con->query("SELECT * FROM fis_aircraft WHERE acr_f_ama_id = '$ama_id'");

            if ($res1->num_rows >= 1) {
                while ($row1 = $res1->fetch_assoc()) {

                    $aircraft_manuf_id = $row1['acr_f_ama_id'];

                    //Abfrage: Aircraft Manufacturer
                    $res2 = $this->con->query("SELECT * FROM fis_aircraft_manufacturer WHERE ama_id = '$aircraft_manuf_id'");
                    $row2 = $res2->fetch_assoc();
                    $country_id = $row2['ama_f_ctr_id'];

                    //Abfrage: Country
                    $res3 = $this->con->query("SELECT * FROM fis_country WHERE ctr_id = '$country_id'");
                    $row3 = $res3->fetch_assoc();
                    $currency_id = $row3['ctr_f_cur_id'];

                    //Abfrage: Currency
                    $res = $this->con->query("SELECT * FROM fis_currency WHERE cur_id = '$currency_id'");
                    $row = $res->fetch_assoc();


                    $currency = $this->createCurrencyFromDb($row);

                    $country = new Country($row3['ctr_id'], $row3['ctr_name'], $row3['ctr_description'], $row3['ctr_image'], $row3['ctr_code'], $currency);

                    $manuf = new AircraftManufacturer($row2['ama_id'], $row2['ama_name'], $row2['ama_description'], $row2['ama_image'], $country,
                                    $row2['ama_street'], $row2['ama_postcode'], $row2['ama_city'], $row2['ama_phone'], $row2['ama_www'],
                                    $row2['ama_email']);

                    $aircraft[] = new Aircraft($row1['acr_id'], $row1['acr_series'], $row1['acr_description'], $row1['acr_image'], $row1 [''], $manuf, $row1['acr_code'],
                                    $row1['acr_weight'], $row1['acr_maxpassengers'], $row1['acr_maxspeed'], $row1['acr_maxtraveldist'],
                                    $row1['acr_maxflightheight'], $row1['acr_hasfirstclass'], $row1['acr_hasbusniessclass']);
                }//end while
                $res->free();
            }//end if
            else {
                return null;
            }
        } else {
            return null;
        }
        return $aircraft;
    }

//end function

    public function getAircraftByCode($aircraft_code) { //Abfrage : kein Attribute
        $aircraft = array();

        $res1 = $this->con->query("SELECT * FROM fis_aircraft WHERE acr_code LIKE '%$aircraft_code%'");

        if ($res1->num_rows >= 1) {
            echo $res1->num_rows;
            while ($row1 = $res1->fetch_assoc()) {

                $aircraft_manuf_id = $row1['acr_f_ama_id'];

                //Abfrage: Aircraft Manufacturer
                $res2 = $this->con->query("SELECT * FROM fis_aircraft_manufacturer WHERE ama_id = '$aircraft_manuf_id'");
                $row2 = $res2->fetch_assoc();
                $country_id = $row2['ama_f_ctr_id'];

                //Abfrage: Country
                $res3 = $this->con->query("SELECT * FROM fis_country WHERE ctr_id = '$country_id'");
                $row3 = $res3->fetch_assoc();
                $currency_id = $row3['ctr_f_cur_id'];

                //Abfrage: Currency
                $res = $this->con->query("SELECT * FROM fis_currency WHERE cur_id = '$currency_id'");
                $row = $res->fetch_assoc();

                $currency = $this->createCurrencyFromDb($row);

                $country = new Country($row3['ctr_id'], $row3['ctr_name'], $row3['ctr_description'], $row3['ctr_image'], $row3['ctr_code'], $currency);

                $manuf = new AircraftManufacturer($row2['ama_id'], $row2['ama_name'], $row2['ama_description'], $row2['ama_image'], $country,
                                $row2['ama_street'], $row2['ama_postcode'], $row2['ama_city'], $row2['ama_phone'], $row2['ama_www'],
                                $row2['ama_email']);

                $aircraft[] = new Aircraft($row1['acr_id'], $row1['acr_series'], $row1['acr_description'], $row1['acr_image'], $row1 [''], $manuf, $row1['acr_code'],
                                $row1['acr_weight'], $row1['acr_maxpassengers'], $row1['acr_maxspeed'], $row1['acr_maxtraveldist'],
                                $row1['acr_maxflightheight'], $row1['acr_hasfirstclass'], $row1['acr_hasbusniessclass']);
            }//end while
            $res1->free();
        }//end if
        else {
            return null;
        }
        return $aircraft;
    }

//end function

    public function getAirports() { //Abfrage Airports: kein Attribute
        $airport = array();

        $res1 = $this->con->query("SELECT * FROM fis_airport");

        if ($res1->num_rows >= 1) {
            while ($row1 = $res1->fetch_assoc()) {
                $airport_country_id = $row1['apo_f_ctr_id'];

                //Abfrage auf Country für Counntry-ID
                $res = $this->con->query("SELECT * FROM fis_country WHERE ctr_id LIKE '$airport_country_id'");
                $row2 = $res->fetch_assoc();
                $currency_country = $row2['ctr_f_cur_id'];

                //Abfrage auf Cuurency für Währung-ID
                $res = $this->con->query("SELECT * FROM fis_currency WHERE cur_id = '$currency_country'");
                $row = $res->fetch_assoc();

                $currency = $this->createCurrencyFromDb($row);

                $country = new Country($row2['ctr_id'], $row2['ctr_name'], $row2['ctr_description'], $row2['ctr_image'], $row2['ctr_code'], $currency);

                $airport[] = new Airport($row1['apo_id'], $row1['apo_name'], $row1[''], $row1['apo_image'], $row1['apo_code2'], $country,
                                $row1['apo_code2'], $row1['apo_international']);
            }//end while
            $res->free();
        }//end if
        else {
            return null;
        }
        return $airport;
    }

//end function

    public function getAirportByName($airport_name) {//Abfrage Airport: Attribut Name
        $airport = array();

        $res1 = $this->con->query("SELECT * FROM fis_airport WHERE apo_name LIKE '%$airport_name%'");

        if ($res1->num_rows >= 1) {
            while ($row1 = $res1->fetch_assoc()) {
                $airport_country_id = $row1['apo_f_ctr_id'];

                //Abfrage auf Country für Counntry-ID
                $res2 = $this->con->query("SELECT * FROM fis_country WHERE ctr_id = '$airport_country_id'");
                $row2 = $res2->fetch_assoc();
                $currency_country = $row2['ctr_f_cur_id'];

                //Abfrage auf Cuurency für Währung-ID
                $res = $this->con->query("SELECT * FROM fis_currency WHERE cur_id = '$curr_country'");
                $row = $res->fetch_assoc();

                $currency = $this->createCurrencyFromDb($row);

                $country = new Country($row2['ctr_id'], $row2['ctr_name'], $row2['ctr_description'], $row2['ctr_image'], $row2['ctr_code'], $currency);


                $airport[] = new Airport($row1['apo_id'], $row1['apo_name'], $row1[''], $row1['apo_image'], $row1['apo_code2'], $country,
                                $row1['apo_code2'], $row1['apo_international']);
            }//end while
            $res->free();
        }//end if
        else {
            return null;
        }
        return $airport;
    }

//end function

    public function getAirportByID($airport_id) {//Abfrage Airport: Attribut ID
        $res1 = $this->con->query("SELECT * FROM fis_airport WHERE apo_id = '$airport_id'");

        if ($res1->num_rows >= 1) {

            $row1 = $res1->fetch_assoc();

            $airport_country_id = $row1['apo_f_ctr_id'];
            //Abfrage auf Country für Counntry ID
            $res = $this->con->query("SELECT * FROM fis_country WHERE ctr_id LIKE '$airport_country_id'");
            $row2 = $res->fetch_assoc();
            $currency_country = $row2['ctr_f_cur_id'];

            //Abfrage auf Cuurency für Währung-ID
            $res = $this->con->query("SELECT * FROM fis_currency WHERE cur_id = '$currency_country'");
            $row = $res->fetch_assoc();

            $currency = $this->createCurrencyFromDb($row);

            $country = new Country($row2['ctr_id'], $row2['ctr_name'], $row2['ctr_description'], $row2['ctr_image'], $row2['ctr_code'], $currency);

            $airport[] = new Airport($row1['apo_id'], $row1['apo_name'], $row1[''], $row1['apo_image'], $row1['apo_code2'], $country,
                            $row1['apo_code2'], $row1['apo_international']);
        }//end if
        else {
            return null;
        }
        return $airport;
    }

//end function

    public function getAirportByCountry($airport_country) {//Abfrage Airport:Attribut Country
        $airport = array();
        $res = $this->con->query("SELECT ctr_id FROM fis_country WHERE ctr_name LIKE '%$airport_country%' OR ctr_code LIKE '%$airport_country%'");

        if ($res->num_rows >= 1) {

            $row = $res->fetch_assoc();
            $country_id = $row['ctr_id'];
            $res->free();


            $res1 = $this->con->query("SELECT * FROM fis_airport WHERE apo_f_ctr_id = $country_id");

            if ($res1->num_rows >= 1) {

                while ($row1 = $res1->fetch_assoc()) {

                    $airport_country_id = $row1['apo_f_ctr_id'];

                    //Abfrage auf Country für Counntry ID
                    $res2 = $this->con->query("SELECT * FROM fis_country WHERE ctr_id = '$airport_country_id'");
                    $row2 = $res2->fetch_assoc();
                    $currency_country = $row2['ctr_f_cur_id'];

                    //Abfrage auf Cuurency für Währung-ID
                    $res = $this->con->query("SELECT * FROM fis_currency WHERE cur_id = '$currency_country'");
                    $row = $res->fetch_assoc();

                    $currency = $this->createCurrencyFromDb($row);

                    $country = new Country($row2['ctr_id'], $row2['ctr_name'], $row2['ctr_description'], $row2['ctr_image'], $row2['ctr_code'], $currency);

                    $airport[] = new Airport($row1['apo_id'], $row1['apo_name'], $row1[''], $row1['apo_image'], $row1['apo_code2'], $country,
                                    $row1['apo_code2'], $row1['apo_international']);
                }//end while
                $res1->free();
            }//end if
            else {
                return null;
            }
        } else {
            return null;
        }
        return $airport;
    }

//end function

    public function getAirline() { //Abfragen Airline: ohne Attribute
        $airline = array();

        $res1 = $this->con->query("SELECT * FROM fis_airline");

        if ($res1->num_rows >= 1) {

            while ($row1 = $res1->fetch_assoc()) {

                $airline_country_air = $row1 ['ali_f_ctr_id'];

                //Abfrage auf DB Country für Country-ID
                $res2 = $this->con->query("SELECT * FROM fis_country WHERE ctr_id LIKE '$airline_country_air'");
                $row2 = $res2->fetch_assoc();
                $currency_country = $row2['ctr_f_cur_id'];

                //Abfrage auf DB Currency für Währung-ID
                $res = $this->con->query("SELECT * FROM fis_currency WHERE cur_id = '$currency_country'");
                $row = $res->fetch_assoc();

                $currency = $this->createCurrencyFromDb($row);

                $country = new Country($row2['ctr_id'], $row2['ctr_name'], $row2['ctr_description'], $row2['ctr_image'], $row2['ctr_code'], $currency);

                $airline[] = new Airline($row1['ali_id'], $row1['ali_name'], $row1['ali_description'], $row1['ali_image'], $row1['ali_code'], $country,
                                $row1['ali_code2'], $row1['ali_callsign'], $row1['ali_adress'], $row1['ali_postcode'], $row1['ali_city'], $row1['ali_phone'],
                                $row1['ali_www'], $row1['ali_email']);
            }//end while
            $res->free();
        }//end if
        else {
            return null;
        }
        return $airline;
    }

//end function  

    public function getAirlineByName($airline_name) { //Abfragen Airline: Attribut Name
        $airline = array();

        $res1 = $this->con->query("SELECT * FROM fis_airline WHERE ali_name LIKE '%$airline_name%'");

        if ($res1->num_rows >= 1) {

            while ($row1 = $res1->fetch_assoc()) {

                $airline_country_air = $row1 ['ali_f_ctr_id'];

                //Abfrage auf DB Country für Country-ID
                $res2 = $this->con->query("SELECT * FROM fis_country WHERE ctr_id = '$airline_country_air'");
                $row2 = $res2->fetch_assoc();
                $currency_country = $row2['ctr_f_cur_id'];

                //Abfrage auf DB Currency für Währung-ID
                $res = $this->con->query("SELECT * FROM fis_currency WHERE cur_id = '$currency_country'");
                $row = $res->fetch_assoc();

                $currency = $this->createCurrencyFromDb($row);

                $country = new Country($row2['ctr_id'], $row2['ctr_name'], $row2['ctr_description'], $row2['ctr_image'], $row2['ctr_code'], $currency);

                $airline[] = new Airline($row1['ali_id'], $row1['ali_name'], $row1['ali_description'], $row1['ali_image'], $row1['ali_code'], $country,
                                $row1['ali_code2'], $row1['ali_callsign'], $row1['ali_adress'], $row1['ali_postcode'], $row1['ali_city'], $row1['ali_phone'],
                                $row1['ali_www'], $row1['ali_email']);
            }//end while
            $res->free();
        }//end if
        else {
            return null;
        }
        return$airline;
    }

//end function

    public function getAirlineByCode2($airline_code2) { //Abfragen Airline: Mit Attribut Code2/ Kürzel
        $airline = array();
        //Abfrage auf DB Airline
        $res1 = $this->con->query("SELECT * FROM fis_airline WHERE ali_code2 LIKE '$airline_code2'");

        if ($res1->num_rows >= 1) {

            while ($row1 = $res1->fetch_assoc()) {

                $airline_country = $row1 ['ali_f_ctr_id'];

                //Abfrage auf DB Country für Country-ID
                $res2 = $this->con->query("SELECT * FROM fis_country WHERE ctr_id = '$airline_country'");
                $row2 = $res2->fetch_assoc();
                $currency_country = $row2['ctr_f_cur_id'];

                //Abfrage auf DB Currency für Währung.ID
                $res = $this->con->query("SELECT * FROM fis_currency WHERE cur_id = '$currency_country'");
                $row = $res->fetch_assoc();

                $currency = $this->createCurrencyFromDb($row);

                $country = new Country($row2['ctr_id'], $row2['ctr_name'], $row2['ctr_description'], $row2['ctr_image'], $row2['ctr_code'], $currency);

                $airline[] = new Airline($row1['ali_id'], $row1['ali_name'], $row1['ali_description'], $row1['ali_image'], $row1['ali_code'], $country,
                                $row1['ali_code2'], $row1['ali_callsign'], $row1['ali_adress'], $row1['ali_postcode'], $row1['ali_city'], $row1['ali_phone'],
                                $row1['ali_www'], $row1['ali_email']);
            }//end while
            $res->free();
        }//end if
        else {
            return null;
        }
        return $airline;
    }

//end function

    public function getAirlineByCountry($airline_country) { //Abfragen Airline: Mit Attribut Country
        $airline = array();
        //Abfrage auf DB Airline

        $res = $this->con->query("SELECT ctr_id FROM fis_country WHERE ctr_name LIKE '%$airline_country%' OR ctr_code LIKE '%$airline_country%'");

        if ($res->num_rows >= 1) {

            $row = $res->fetch_assoc();
            $country_id = $row['ctr_id'];
            $res->free();


            $res1 = $this->con->query("SELECT * FROM fis_airline WHERE ali_f_ctr_id = $country_id");

            if ($res1->num_rows >= 1) {

                while ($row1 = $res1->fetch_assoc()) {

                    $airline_country_air = $row1 ['ali_f_ctr_id'];

                    //Abfrage auf DB Country für Country-ID
                    $res2 = $this->con->query("SELECT * FROM fis_country WHERE ctr_id = '$airline_country_air'");
                    $row2 = $res2->fetch_assoc();
                    $currency_country = $row2['ctr_f_cur_id'];

                    //Abfrage auf DB Currency für Währung-ID
                    $res = $this->con->query("SELECT * FROM fis_currency WHERE cur_id = '$currency_country'");
                    $row = $res->fetch_assoc();

                    $currency = $this->createCurrencyFromDb($row);

                    $country = new Country($row2['ctr_id'], $row2['ctr_name'], $row2['ctr_description'], $row2['ctr_image'], $row2['ctr_code'], $currency);

                    $airline[] = new Airline($row1['ali_id'], $row1['ali_name'], $row1['ali_description'], $row1['ali_image'], $row1['ali_code'], $country,
                                    $row1['ali_code2'], $row1['ali_callsign'], $row1['ali_adress'], $row1['ali_postcode'], $row1['ali_city'],
                                    $row1['ali_phone'], $row1['ali_www'], $row1['ali_email']);
                }//end while
                $res1->free();
            }//end if
            else {
                return null;
            }
        } else {
            return null;
        }

        return $airline;
    }

//end function

    public function getArrivals() {
        $list = array();
        $res = $this->con->query("SELECT * FROM fis_airport_arrivals");
        while ($row = $res->fetch_assoc()) {
            $arrivals = new Arrivals($row['aar_id'], $row['aar_f_apo_id'], $row['aar_code'], $row['aar_image'], $row['aar_description']);
            $list = $arrivals;
        }
    }

    public function getFlightStatus() {
        $list = array();
        $res = $this->con->query("SELECT * FROM fis_flight_status");
        while ($row = $res->fetch_assoc()) {
            $status = new FlightStatus($row['fst_id'], $row['fst_name'], $row['fst_description']);
            $list = $status;
        }
    }

    public function getAircraftCode() {
        $list = array();
        $res = $this->con->query("SELECT * FROM fis_aircraft");
        while ($row = $res->fetch_assoc()) {
            $aircraftcode = new AircraftCode($row['aco_id'], $row['aco_code'], $row['aco_type'], $row['aco_wake']);
            $list = $aircraftcode;
        }
    }

    public function getCurrency() {
        $list = array();
        $res = $this->con->query("SELECT * FROM fis_currency");
        while ($row = $res->fetch_assoc()) {
            $currency = new Currency($row['cur_id'], $row['cur_code'], $row['cur_name'], $row['cur_number'], $row['cur_description'], $row['cur_country']);
            $list = $currency;
        }
    }

}

?>

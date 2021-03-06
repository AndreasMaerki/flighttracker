# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases v6.2.1                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          myFIS.dez                                       #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database creation script                        #
# Created on:            2012-12-29 17:10                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Tables                                                                 #
# ---------------------------------------------------------------------- #

# ---------------------------------------------------------------------- #
# Add table "fis_airport"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE `fis_airport` (
    `apo_id` INTEGER(32) NOT NULL AUTO_INCREMENT,
    `apo_code` CHAR(6) NOT NULL,
    `apo_f_ctr_id` INTEGER(32) NOT NULL,
    `apo_code2` CHAR(6),
    `apo_name` VARCHAR(60),
    `apo_description` TEXT,
    `apo_image` VARCHAR(120),
    `apo_international` BOOL,
    CONSTRAINT `PK_fis_airport` PRIMARY KEY (`apo_id`, `apo_code`)
);

# ---------------------------------------------------------------------- #
# Add table "fis_country"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE `fis_country` (
    `ctr_id` INTEGER(32) NOT NULL AUTO_INCREMENT,
    `ctr_code` CHAR(6) NOT NULL,
    `ctr_f_cur_id` INTEGER(32) NOT NULL,
    `ctr_name` VARCHAR(60),
    `ctr_description` TEXT,
    `ctr_image` VARCHAR(120),
    CONSTRAINT `PK_fis_country` PRIMARY KEY (`ctr_id`, `ctr_code`)
);

# ---------------------------------------------------------------------- #
# Add table "fis_aircraft"                                               #
# ---------------------------------------------------------------------- #

CREATE TABLE `fis_aircraft` (
    `acr_id` INTEGER(32) NOT NULL AUTO_INCREMENT,
    `acr_f_aco_id` INTEGER(32) NOT NULL,
    `acr_f_ama_id` INTEGER(32) NOT NULL,
    `acr_code` VARCHAR(12),
    `acr_name` VARCHAR(40),
    `acr_description` TEXT,
    `acr_weight` INTEGER(32),
    `acr_maxpassengers` INTEGER(32),
    `acr_maxspeed` INTEGER(32),
    `acr_maxtraveldist` INTEGER(32),
    `acr_maxflightheight` VARCHAR(40),
    `acr_hasfirstclass` BOOL,
    `acr_hasbusniessclass` BOOL,
    `acr_image` VARCHAR(120),
    CONSTRAINT `PK_fis_aircraft` PRIMARY KEY (`acr_id`, `acr_f_aco_id`)
);

# ---------------------------------------------------------------------- #
# Add table "fis_aircraft_manufacturer"                                  #
# ---------------------------------------------------------------------- #

CREATE TABLE `fis_aircraft_manufacturer` (
    `ama_id` INTEGER(32) NOT NULL AUTO_INCREMENT,
    `ama_f_ctr_id` INTEGER(32) NOT NULL,
    `ama_name` VARCHAR(60),
    `ama_street` VARCHAR(80),
    `ama_postcode` INTEGER(12),
    `ama_city` VARCHAR(60),
    `ama_phone` VARCHAR(60),
    `ama_www` VARCHAR(120),
    `ama_email` VARCHAR(120),
    `ama_description` TEXT,
    `ama_image` VARCHAR(120),
    CONSTRAINT `PK_fis_aircraft_manufacturer` PRIMARY KEY (`ama_id`)
);

# ---------------------------------------------------------------------- #
# Add table "fis_flight"                                                 #
# ---------------------------------------------------------------------- #

CREATE TABLE `fis_flight` (
    `fli_id` INTEGER(32) NOT NULL AUTO_INCREMENT,
    `fli_number` INTEGER(16) NOT NULL,
    `fli_f_ali_id` INTEGER(32) NOT NULL,
    `fli_f_apo_id_from` INTEGER(32) NOT NULL,
    `fli_f_apo_id_to` INTEGER(32) NOT NULL,
    `fli_f_acr_id` INTEGER(32) NOT NULL,
    `fli_f_fst_id` INTEGER(32) NOT NULL,
    `fli_arrival_sced` TIMESTAMP,
    `fli_arrival_calc` TIMESTAMP,
    `fli_depart_sced` TIMESTAMP,
    `fli_depart_calc` TIMESTAMP,
    `fli_timestamp` TIMESTAMP,
    `fli_longitude` FLOAT,
    `fli_latitude` FLOAT,
    `fli_groundspeed` INTEGER(32),
    `fli_heading` INTEGER(32),
    CONSTRAINT `PK_fis_flight` PRIMARY KEY (`fli_id`, `fli_number`)
);

# ---------------------------------------------------------------------- #
# Add table "fis_airline"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE `fis_airline` (
    `ali_id` INTEGER(32) NOT NULL AUTO_INCREMENT,
    `ali_code` CHAR(6) NOT NULL,
    `ali_f_ctr_id` INTEGER(32) NOT NULL,
    `ali_code2` CHAR(6),
    `ali_name` VARCHAR(60),
    `ali_callsign` VARCHAR(40),
    `ali_adress` VARCHAR(80),
    `ali_postcode` INTEGER(12),
    `ali_city` VARCHAR(80),
    `ali_phone` VARCHAR(60),
    `ali_www` VARCHAR(120),
    `ali_email` VARCHAR(120),
    `ali_image` VARCHAR(40),
    `ali_description` TEXT,
    CONSTRAINT `PK_fis_airline` PRIMARY KEY (`ali_id`, `ali_code`)
);

# ---------------------------------------------------------------------- #
# Add table "fis_airport_arrivals"                                       #
# ---------------------------------------------------------------------- #

CREATE TABLE `fis_airport_arrivals` (
    `aar_id` INTEGER(32) NOT NULL AUTO_INCREMENT,
    `aar_f_apo_id` INTEGER(32) NOT NULL,
    `aar_code` CHAR(12),
    `aar_image` VARCHAR(120),
    `aar_description` TEXT,
    CONSTRAINT `PK_fis_airport_arrivals` PRIMARY KEY (`aar_id`)
);

# ---------------------------------------------------------------------- #
# Add table "fis_flight_status"                                          #
# ---------------------------------------------------------------------- #

CREATE TABLE `fis_flight_status` (
    `fst_id` INTEGER(32) NOT NULL AUTO_INCREMENT,
    `fst_name` VARCHAR(60),
    `fst_description` VARCHAR(40),
    CONSTRAINT `PK_fis_flight_status` PRIMARY KEY (`fst_id`)
);

# ---------------------------------------------------------------------- #
# Add table "fis_currency"                                               #
# ---------------------------------------------------------------------- #

CREATE TABLE `fis_currency` (
    `cur_id` INTEGER(32) NOT NULL AUTO_INCREMENT,
    `cur_code` CHAR(6) NOT NULL,
    `cur_name` VARCHAR(60),
    `cur_number` INTEGER(32),
    `cur_description` VARCHAR(120),
    CONSTRAINT `PK_fis_currency` PRIMARY KEY (`cur_id`, `cur_code`)
);

# ---------------------------------------------------------------------- #
# Add table "fis_aircraft_code"                                          #
# ---------------------------------------------------------------------- #

CREATE TABLE `fis_aircraft_code` (
    `aco_id` INTEGER(32) NOT NULL AUTO_INCREMENT,
    `aco_code` CHAR(40) NOT NULL,
    `aco_type` VARCHAR(120),
    `aco_wake` CHAR(4),
    CONSTRAINT `PK_fis_aircraft_code` PRIMARY KEY (`aco_id`, `aco_code`)
);

# ---------------------------------------------------------------------- #
# Foreign key constraints                                                #
# ---------------------------------------------------------------------- #

ALTER TABLE `fis_airport` ADD CONSTRAINT `fis_country_fis_airport` 
    FOREIGN KEY (`apo_f_ctr_id`) REFERENCES `fis_country` (`ctr_id`);

ALTER TABLE `fis_country` ADD CONSTRAINT `fis_currency_fis_country` 
    FOREIGN KEY (`ctr_f_cur_id`) REFERENCES `fis_currency` (`cur_id`);

ALTER TABLE `fis_aircraft` ADD CONSTRAINT `fis_aircraft_manufacturer_fis_aircraft` 
    FOREIGN KEY (`acr_f_ama_id`) REFERENCES `fis_aircraft_manufacturer` (`ama_id`);

ALTER TABLE `fis_aircraft` ADD CONSTRAINT `fis_aircraft_code_fis_aircraft` 
    FOREIGN KEY (`acr_f_aco_id`) REFERENCES `fis_aircraft_code` (`aco_id`);

ALTER TABLE `fis_aircraft_manufacturer` ADD CONSTRAINT `fis_country_fis_aircraft_manufacturer` 
    FOREIGN KEY (`ama_f_ctr_id`) REFERENCES `fis_country` (`ctr_id`);

ALTER TABLE `fis_flight` ADD CONSTRAINT `fis_airport_fis_flight_from` 
    FOREIGN KEY (`fli_f_apo_id_from`) REFERENCES `fis_airport` (`apo_id`);

ALTER TABLE `fis_flight` ADD CONSTRAINT `fis_airport_fis_flight_to` 
    FOREIGN KEY (`fli_f_apo_id_to`) REFERENCES `fis_airport` (`apo_id`);

ALTER TABLE `fis_flight` ADD CONSTRAINT `fis_aircraft_fis_flight` 
    FOREIGN KEY (`fli_f_acr_id`) REFERENCES `fis_aircraft` (`acr_id`);

ALTER TABLE `fis_flight` ADD CONSTRAINT `fis_flight_status_fis_flight` 
    FOREIGN KEY (`fli_f_fst_id`) REFERENCES `fis_flight_status` (`fst_id`);

ALTER TABLE `fis_flight` ADD CONSTRAINT `fis_airline_fis_flight` 
    FOREIGN KEY (`fli_f_ali_id`) REFERENCES `fis_airline` (`ali_id`);

ALTER TABLE `fis_airline` ADD CONSTRAINT `fis_country_fis_airline` 
    FOREIGN KEY (`ali_f_ctr_id`) REFERENCES `fis_country` (`ctr_id`);

ALTER TABLE `fis_airport_arrivals` ADD CONSTRAINT `fis_airport_fis_airport_arrivals` 
    FOREIGN KEY (`aar_f_apo_id`) REFERENCES `fis_airport` (`apo_id`);

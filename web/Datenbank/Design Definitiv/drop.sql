# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases v6.2.1                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          myFIS.dez                                       #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database drop script                            #
# Created on:            2012-12-29 17:10                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Drop foreign key constraints                                           #
# ---------------------------------------------------------------------- #

ALTER TABLE `fis_airport` DROP FOREIGN KEY `fis_country_fis_airport`;

ALTER TABLE `fis_country` DROP FOREIGN KEY `fis_currency_fis_country`;

ALTER TABLE `fis_aircraft` DROP FOREIGN KEY `fis_aircraft_manufacturer_fis_aircraft`;

ALTER TABLE `fis_aircraft` DROP FOREIGN KEY `fis_aircraft_code_fis_aircraft`;

ALTER TABLE `fis_aircraft_manufacturer` DROP FOREIGN KEY `fis_country_fis_aircraft_manufacturer`;

ALTER TABLE `fis_flight` DROP FOREIGN KEY `fis_airport_fis_flight_from`;

ALTER TABLE `fis_flight` DROP FOREIGN KEY `fis_airport_fis_flight_to`;

ALTER TABLE `fis_flight` DROP FOREIGN KEY `fis_aircraft_fis_flight`;

ALTER TABLE `fis_flight` DROP FOREIGN KEY `fis_flight_status_fis_flight`;

ALTER TABLE `fis_flight` DROP FOREIGN KEY `fis_airline_fis_flight`;

ALTER TABLE `fis_airline` DROP FOREIGN KEY `fis_country_fis_airline`;

ALTER TABLE `fis_airport_arrivals` DROP FOREIGN KEY `fis_airport_fis_airport_arrivals`;

# ---------------------------------------------------------------------- #
# Drop table "fis_airport_arrivals"                                      #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `fis_airport_arrivals` MODIFY `aar_id` INTEGER(32) NOT NULL;

# Drop constraints #

ALTER TABLE `fis_airport_arrivals` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `fis_airport_arrivals`;

# ---------------------------------------------------------------------- #
# Drop table "fis_flight"                                                #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `fis_flight` MODIFY `fli_id` INTEGER(32) NOT NULL;

# Drop constraints #

ALTER TABLE `fis_flight` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `fis_flight`;

# ---------------------------------------------------------------------- #
# Drop table "fis_aircraft"                                              #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `fis_aircraft` MODIFY `acr_id` INTEGER(32) NOT NULL;

# Drop constraints #

ALTER TABLE `fis_aircraft` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `fis_aircraft`;

# ---------------------------------------------------------------------- #
# Drop table "fis_airport"                                               #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `fis_airport` MODIFY `apo_id` INTEGER(32) NOT NULL;

# Drop constraints #

ALTER TABLE `fis_airport` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `fis_airport`;

# ---------------------------------------------------------------------- #
# Drop table "fis_airline"                                               #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `fis_airline` MODIFY `ali_id` INTEGER(32) NOT NULL;

# Drop constraints #

ALTER TABLE `fis_airline` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `fis_airline`;

# ---------------------------------------------------------------------- #
# Drop table "fis_aircraft_manufacturer"                                 #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `fis_aircraft_manufacturer` MODIFY `ama_id` INTEGER(32) NOT NULL;

# Drop constraints #

ALTER TABLE `fis_aircraft_manufacturer` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `fis_aircraft_manufacturer`;

# ---------------------------------------------------------------------- #
# Drop table "fis_country"                                               #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `fis_country` MODIFY `ctr_id` INTEGER(32) NOT NULL;

# Drop constraints #

ALTER TABLE `fis_country` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `fis_country`;

# ---------------------------------------------------------------------- #
# Drop table "fis_aircraft_code"                                         #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `fis_aircraft_code` MODIFY `aco_id` INTEGER(32) NOT NULL;

# Drop constraints #

ALTER TABLE `fis_aircraft_code` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `fis_aircraft_code`;

# ---------------------------------------------------------------------- #
# Drop table "fis_currency"                                              #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `fis_currency` MODIFY `cur_id` INTEGER(32) NOT NULL;

# Drop constraints #

ALTER TABLE `fis_currency` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `fis_currency`;

# ---------------------------------------------------------------------- #
# Drop table "fis_flight_status"                                         #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `fis_flight_status` MODIFY `fst_id` INTEGER(32) NOT NULL;

# Drop constraints #

ALTER TABLE `fis_flight_status` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `fis_flight_status`;

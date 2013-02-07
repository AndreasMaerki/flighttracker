
<?php

include_once 'lib/FlightXMLAdapter.php';

class SearchController {
      

    public function searchArrivingFlightsfromHomeView($aircraftField, $airportFieldTo,
             $airportFieldFrom, $departDateField, $arrivalDateField, $filter){
      
        // Airport such string nur code2 behalten
        $airportFieldToNew = $this->getAirportCodeFromPOST($airportFieldTo);
        $airportFieldFromNew = $this->getAirportCodeFromPOST($airportFieldFrom);
        
        //Kontroll ausgabe
        //echo "<br>Aircarft ID: " . " {$aircraftField}<br>" . "AirportTo: " . "{$airportFieldToNew} <br>" . "Airport From:" . "{$airportFieldFromNew} <br>" . "departDate: " . " 
        //{$departDateField}<br> " . "arrivalDate:" . "{$arrivalDateField}<br> " . "Filter: " . " {$filter}<br>";
        
        
        // Flight Number Feld ist ausgefüllt
        if ($aircraftField != ''){// Uebergabe von post im SearchController
            $this->flightXML = new FlightXMLAdapter(FXML_HOST, FXML_USER, FXML_PASSWORD); //constants from the config file
            $flights = $this->flightXML->getFlightsFromANumber($aircraftField);
            //echo "<br>ist im FlightID anzeige <br>";
            return $flights;
         }
        
        // Ankunft und Ablug wurde Ausgefüllt, zeigt beides an
        if ($airportFieldToNew != '' && $airportFieldFromNew != ''){// Uebergabe von post im SearchController
            $this->flightXML = new FlightXMLAdapter(FXML_HOST, FXML_USER, FXML_PASSWORD); //constants from the config file
            $flights = $this->flightXML->getFlightsFromAirport($airportFieldToNew, $filter);
            ///echo "<br>ist im airport Ankunfts und ablug anzeige <br>";
            return $flights;
         } 
         
        // ankunfts Airport feld ist ausgefüllt
        if ($airportFieldToNew != ''){// Uebergabe von post im SearchController
            $this->flightXML = new FlightXMLAdapter(FXML_HOST, FXML_USER, FXML_PASSWORD); //constants from the config file
            $flights = $this->flightXML->getFlightsFromAirport($airportFieldToNew, $filter);
            //echo "<br>airport Ankunfts anzeige";
            return $flights;
         }
         
         // Abflug ist ausgefüllt
         if ($airportFieldFromNew != ''){// Uebergabe von post im SearchController
            $this->flightXML = new FlightXMLAdapter(FXML_HOST, FXML_USER, FXML_PASSWORD); //constants from the config file
            $flights = $this->flightXML->getFlightsFromAirport($airportFieldFromNew, $filter);
            //echo "<br>airport Abflug anzeige";
            return $flights;
         }
          
        
         
         
         
         
    }
    
    // Schneidet alles ausser code2 ab bei airport suche
    public function getAirportCodeFromPOST($searchStreing){    
        $airportCode = explode(' ',$searchStreing, 2);  
        // Entfernt noch die Klammern
        $airportCodeNew = substr($airportCode[0], 1 , strlen($airportCode[0])-2); 
        return $airportCodeNew;
    }
    
    
}
?>

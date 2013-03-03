<?php

/**
 * abstract class for all controllers
 *
 * @author Andreas Maerki, Mathias Cuel, Philipe Rothen, Marc Hangartner
 */
abstract class Controller {

    /**
     * init creates a new empty instance of the resource
     */
    abstract protected function init();

    /**
     * use create to display returned data from the db
     */
    abstract protected function create();

    /** 
     * route is controlling all the routing on page 
     * except for the subrouting on some more komplex pages with subviews 
     */

    public function route() {

        switch ($_SERVER['REQUEST_METHOD']) {// returns  'GET', 'HEAD', 'POST' or 'PUT'.
            case 'GET':

                // Flight Details
                if (preg_match("/\bFlightDetailView\b/i", $_SERVER['REQUEST_URI'])) {
                    $this->showFlightdetails();

                    break;
                } else if (preg_match("/\bAirplaneDetails\b/i", $_SERVER['REQUEST_URI'])) {
                    $this->showFloat();
                } elseif (preg_match("/\bAirportDetails\b/i", $_SERVER['REQUEST_URI'])) {
                    $this->showFloat();
                } elseif (preg_match("/\btrack\b/i", $_SERVER['REQUEST_URI'])) {
                    if (isset($_GET['flightnumber'])) {
                       $this->create(); 
                       break;
                    }
                    else
                    {
                       $this->init(); 
                    }
                } else {

                    $this->init();
                    break;
                }

            case 'POST':// store the submitted user data in case of post
                $this->create();

                break;
            default:
                
        }
    }

    /**	
     * tries to correct url typos and replaces invalid chars with valid ones if possible
     * 
     */

    public static function encodeUrl($url) {
        $specialChars = array(
            "ä" => "ae",
            "ö" => "oe",
            "ü" => "ue",
            "é|ê|è" => "e",
            "á|â|à" => "a",
            "ç" => "c"
        );
        foreach ($specialChars as $find => $replace) {
            $url = preg_replace("/($find)/i", $replace, $url);
        }
        // Replace whitespace chars
        $url = preg_replace('/\s/', '-', $url);
        // Remove all remaining disallowed chars
        $url = preg_replace('/[^a-zA-Z0-9_\-\.]/', '', $url);
        // Replace multiple '-' chars with a single '-'
        $url = preg_replace('/(\-)+/', '-', $url);
        return $url;
    }
    /**
     * use this function if the content of a page should be displayed on multiple (sub)pages
     * just append a index number to the url, it will be extracted and used to calculate the
     * startpoint of the returned array. no index = 0
     *  
     * @param type $desiredEntriesPerPage array size of the returned array
     * @param type $databaseItemArray the array that needs to be trimmed
     * @return array trimmed to the requested size beginnig at the current offset determined
     * via the appended subpage number in the url
     */

    protected function subPageContentFilter($desiredEntriesPerPage, $databaseItemArray) {
        $currentPageIndex = array();
        $itemsToDisplay = array();
        if (preg_match("/\d+\b/", $_SERVER['REQUEST_URI'], $currentPageIndex)) {//get the number
            $lowestArrayValueOfRequestedPage = $currentPageIndex[0] * $desiredEntriesPerPage - $desiredEntriesPerPage - 1;
        } else {
            $lowestArrayValueOfRequestedPage = 0;
        }
        for ($i = $lowestArrayValueOfRequestedPage; $i < ($lowestArrayValueOfRequestedPage + $desiredEntriesPerPage); $i++) {
            if ($i < count($databaseItemArray)) {//avoid null pointer on last page
                array_push($itemsToDisplay, $databaseItemArray[$i]);
            }
        }
        return $itemsToDisplay;
    }
    

}

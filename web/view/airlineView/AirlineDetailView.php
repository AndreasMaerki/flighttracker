<?php

/**
 * Description of AirlineDetailView
 * Shows details of a selected resource in a seperate window.
 * @author Andreas Maerki, Mathias Cuel, Philipe Rothen, Marc Hangartner
 */
class AirlineDetailView extends View {
    
    
    
    private $airport;
    function __construct($airport) { 
            $this->airport = $airport;
	}


        public function display() {
        echo "<h1>Details on Airline</h1>";
        echo<<<DETAILS
    <div id="FlightDetailsContainer">
        <h2>Details for flight Number <i>Lx7214</i> from <i>Zurich</i> to <i>London</i>.</h2>
        <img id="FlightDetailAirplanePic" src="../../images/aircraft/pc-6-turbo.jpg" alt="pc-6-turbo" width="238" height="181">

        <div class="flightInfoTableDiv" style="width: 400px">
            <table id="flightInfoTable" style="width: 400px">
                <tbody>
                    <tr>
                        <td class="label">Operator</td>
                        <td>AirTran Airways</td>
                    </tr>
                    <tr>
                        <td class="label">Model</td>
                        <td>Boeing 737-7BD</td>
                    </tr>
                    <tr>
                        <td class="label">Con No.</td>
                        <td>33943</td>
                    </tr>
                    <tr>
                        <td class="label">Line No.</td>
                        <td>2552</td>
                    </tr>
                    <tr>
                        <td class="label">Registered On</td>
                        <td>05-05-08</td>
                        <td>$this->airport</td>
                        <td>$this->airport</td>
                        <td>$this->airport</td>
                        <td>$this->airport</td>
                            <td id = "hans"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>\n
DETAILS;
        echo '<div id="close-overlay"></div>';
    }// end display

    public function setAirport($param) {
        //$this->airport = $param;
    }
}


?>

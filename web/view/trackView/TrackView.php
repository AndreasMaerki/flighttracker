<?php
/**
 * Description of TrackView
 * shows a plane on its current position and the path it has been following
 * using the functionalities of the google js api
 *
 * @author Andreas Maerki, Mathias Cuel, Philipe Rothen, Marc Hangartner
 */

include_once "{$_SERVER['DOCUMENT_ROOT']}/view/view.php";



class TrackView extends View {

    private $java_coordinate;
    private $java_info_box;
    private $java_coordinates_string;
 
 
    function __construct($java_coordinate, $java_info_box, $java_coordinates_string) {
        $this->java_coordinate = $java_coordinate;
        $this->java_info_box = $java_info_box;
        $this->java_coordinates_string = $java_coordinates_string;
    }


    public function display_form() {

        $trackerURI = URI_TRACK;
        
        echo "<div id=\"selectionBarContainer\">
        <form name=\"FlighTracker\" action={$trackerURI} method=\"POST\">
        <label for=\"aircraftField:\">Flight Nr.:</label>
        <input type=\"search\" id=\"aircraftNrField\" name=\"flightnumber\">
        

        
        <input class =\"button\"  id=\"submitButton33\" type=\"submit\" name=\"search\"  value=\"find\">
        </form></div>";
     
    }
    
    public function display() {
        
    ?>


    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">
            function initialize() {


            var myLatLng = new google.maps.LatLng(<?php echo $this->java_coordinate; ?>);

            var mapOptions = {
              zoom: 3,
              center: myLatLng,
              mapTypeId: google.maps.MapTypeId.TERRAIN
            };

            var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);


        var contentString = '<?php echo $this->java_info_box; ?>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

                <?php echo $this->java_coordinates_string; ?>  

            var flightPath = new google.maps.Polyline({
              path: flightPlanCoordinates,
              strokeColor: '#FF0000',
              strokeOpacity: 1.0,
              strokeWeight: 2
            });

            var image = 'images/icons/plane.png';
            var beachMarker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: image
            });




            flightPath.setMap(map);

                    google.maps.event.addListener(beachMarker, 'click', function() {
          infowindow.open(map,beachMarker);
        });

            infowindow.open(map,beachMarker);
         }

    </script>

    <div id="map_canvas" style="width:980px; height:500px"></div>

    <?php

    }
	
}

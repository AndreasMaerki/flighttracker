<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/view.php";



class TrackView extends View {

	private $longitude;
	private $laditude;


	public function display() {
		echo <<<PLANEFINDER
		<h2>Geographic position of Flight <i>S4129</i>:</h2>
			<iframe width="980" height="536" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://planefinder.net/flight/AV14" seamless ></iframe>
			<p>Credits to planefinder.net for this magnificent display.</p>
PLANEFINDER;
	}
	
}

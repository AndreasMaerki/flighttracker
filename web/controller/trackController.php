<?php
include_once 'controller/Controller.php';
include_once 'view/trackView/TrackView.php';




/**
* Andreas Maerki
*/
class TrackController extends Controller {
	
	
	public function init(){
		$trackView = new TrackView();
		$trackView->display();
	}
	
	protected function index(){
		echo "TrackController index not implemented jet";
	}
	
	
	protected function show(){
		echo"TrackController show not implemented jet";

	}

	protected function create(){
	echo"TrackController create not implemented jet";
	}
	
	

}

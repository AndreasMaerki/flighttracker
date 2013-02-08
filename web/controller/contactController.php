<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/controller/Controller.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Aircraft.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/contactView/ContactView.php";

class ContactController extends Controller{
	
    
    
        protected function init(){
            
           
             $view = new ContactView();
             $view->display(); 
         }
	
	
	protected function index(){
		echo "SearchController index not implemented jet";
	}
	
	
	protected function show(){
		echo"SearchController show not implemented jet";

	}

	protected function create(){

	}
        
        public function float() {
        echo"float not implemented";
    }
	
}

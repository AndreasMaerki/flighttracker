<?php
include_once 'controller/Controller.php';
include_once 'model/Aircraft.php';
include_once 'view/contactView/ContactView.php';

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
	
}

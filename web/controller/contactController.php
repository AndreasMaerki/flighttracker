<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/controller/Controller.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/contactView/ContactView.php";

class ContactController extends Controller{

    
        protected function init(){
             $view = new ContactView();
             $view->display(); 
         }

	protected function create(){
            echo "not implemented doo to timely reasons";
	}	
}

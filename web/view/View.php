<?php

/**
 * abstract class for all views 
 *
 * @author Andreas Maerki
 */
abstract class View {

    protected $vars = array();
    protected $requesteddetailView;
    
    

    public function assign($key, $value) {
        $this->vars[$key] = $value;
    }
    
    
    abstract function display();
}


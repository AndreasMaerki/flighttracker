<?php

/**
 * abstract class for all views 
 * Default Class for all views. All views must inherit from this abstract class!
 * @author Andreas Maerki, Mathias Cuel, Philipe Rothen, Marc Hangartner
 */
abstract class View {
   
    /**
     * the display function will be calld by default whenever a new view gets instanciated
     */
    abstract function display();
}


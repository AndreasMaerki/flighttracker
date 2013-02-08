<?php

include_once "{$_SERVER['DOCUMENT_ROOT']}/config/config.php";//sonst wird das rootverzeichnis nicht gefunden
//include_once "{$_SERVER['DOCUMENT_ROOT']}/controller/FloatController.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/controller/AirlineController.php";

$controller = new AirlineController();
$controller->float();

?>
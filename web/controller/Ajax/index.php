<?php

include_once "{$_SERVER['DOCUMENT_ROOT']}/config/config.php"; //sonst wird das rootverzeichnis nicht gefunden
//include_once "{$_SERVER['DOCUMENT_ROOT']}/controller/FloatController.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/controller/AirlineController.php";

    $clickedItem = $_POST['name'];

$controller = new AirlineController();
$controller->setKlickedItem($clickedItem);
$controller->float();
?>
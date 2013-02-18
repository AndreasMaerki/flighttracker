
<?php
/**
 * Liefert alle Airport Infos die es zur suche braucht um autocomplete zu vervollständigen
 *  
 */
include_once "{$_SERVER['DOCUMENT_ROOT']}/config/config.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Aircraft.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Airline.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Airport.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Arrivals.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Country.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Flight.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/FlightStatus.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/MysqlAdapter.php";    

$results = array();
$phrase = $_REQUEST['term'];
if (!empty($phrase)){
$mysqlAdapter = new MysqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$airport = $mysqlAdapter->getAirportByIdentifier($phrase);
    foreach ($airport as $value) {
        $results[] = array('label' => "(" . $value->getCode2() .") ". 
            $value->getName() .", ". $value->getCountry()->getName());  
    } 
echo (json_encode($results));
}
?>

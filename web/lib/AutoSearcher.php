<?php

$dblink = mysql_connect('localhost', 'root', '') or die( mysql_error() );
mysql_select_db('myFis');
$results = Array();

$req = "SELECT apo_code2, apo_name, apo_city, apo_country "
	."FROM fis_airport "
	."WHERE apo_code2 LIKE '%".utf8_decode($_REQUEST['term'])."%'"
        ."OR apo_name LIKE '%".utf8_decode($_REQUEST['term'])."%'"
        ."OR apo_city LIKE '%".utf8_decode($_REQUEST['term'])."%' "; 

$query = mysql_query($req);

while($row = mysql_fetch_array($query))
{
	$results[] = array('label' => $row['apo_code2'] ." ". $row['apo_name'] ." ". $row['apo_city']);
}


echo utf8_encode(json_encode($results));

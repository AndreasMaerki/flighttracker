<?php

$dblink = mysql_connect('localhost', 'root', '') or die( mysql_error() );
mysql_select_db('myFis');
$results = Array();

$req = "SELECT apo_code2, apo_name, apo_city, apo_country "
	."FROM fis_airport "
	."WHERE apo_code2 LIKE '%".utf8_decode($_REQUEST['term'])."%'"
        ."OR apo_name LIKE '%". utf8_decode($_REQUEST['term'])."%'"
        ."OR apo_city LIKE '%".utf8_decode($_REQUEST['term'])."%' "
        ."OR apo_country LIKE '%".utf8_decode($_REQUEST['term'])."%'"; 

$query = mysql_query($req);

while($row = mysql_fetch_array($query))
{
	$results[] = array('label' => "(" . utf8_encode($row['apo_code2']) .") ". 
            utf8_encode($row['apo_name']) .", ". utf8_encode($row['apo_city']).", [". 
            utf8_encode($row['apo_country'])."]");     
}
echo (json_encode($results));

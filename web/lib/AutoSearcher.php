<?php

$dblink = mysql_connect('localhost', 'root', 'hami') or die( mysql_error() );
mysql_select_db('myFis');
$results = Array();

$req = "SELECT apo_city "
	."FROM fis_airport "
	."WHERE apo_city LIKE '".$_REQUEST['term']."%' "; 

$query = mysql_query($req);

while($row = mysql_fetch_array($query))
{
	$results[] = array('label' => $row['apo_city']);
}

echo json_encode($results);

<?php

require_once 'source/class.db.php';

$db = new db();

$start = ($_REQUEST["start"] == null)? 0 : $_REQUEST["start"];
$limit = ($_REQUEST["limit"] == null)? 200 : $_REQUEST["limit"];	

// Gather all pending requests
$query = "SELECT campaign_id, case when CURDATE() < startDate then 'erwartet' when CURDATE()>endDate then 'beendet' else 'aktiv' end AS state,name,startDate, endDate FROM campaign" ;

$query .= " ORDER BY ".$_REQUEST["sort"]." ".$_REQUEST["dir"];
$query .= " LIMIT ".$start.",".$limit;

$result = $db->query($query); 

// Here we do the count
$query_c = "SELECT * FROM campaign" ;

//get total
$count_result = $db->query($query_c);
$total = mysql_num_rows($count_result);

if (mysql_num_rows($result) > 0){
	while($obj = mysql_fetch_object($result))
		{
		$arr[] = $obj;
	    }

	// Now create the json array to be sent to our datastore

	$myData = array('rows' => $arr, 'totalCount' => $total);
	echo json_encode($myData);
	return;
	exit();

}

else { // If no requests found, we return nothing

	$myData = array('"rows"' => '','"totalCount' => '0');
	echo json_encode($myData);
	return;
	exit();

}

?>


<?php
include('dbconfig.php');

//connection String
$con = mysql_connect($hostname, $username, $password) or die('Could not connect: ' . mysql_error());
//select database
mysql_select_db($database, $con);
//Select The database
$bool = mysql_select_db($database, $con);
if ($bool === False){
	print "can't find $database";
}

$start = ($_REQUEST["start"] == null)? 0 : $_REQUEST["start"];
$limit = ($_REQUEST["limit"] == null)? 200 : $_REQUEST["limit"];	

// Gather all pending requests
$query = "SELECT case when CURDATE() < startDate then 'erwartet' when CURDATE()>endDate then 'beendet' else 'aktiv' end AS state,name,startDate, endDate FROM campaign" ;

$query .= " ORDER BY name ASC ";
$query .= " LIMIT ".$start.",".$limit;

$result = mysql_query($query, $con); 

// Here we do the count
$query_c = "SELECT * FROM campaign" ;

//get total
$count_result = mysql_query($query_c, $con);
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


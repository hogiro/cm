<?php

require_once 'source/class.db.php';

$db = new db();


// Gather all pending requests
$query = "SELECT user_id, CONCAT(fname,' ',name) as username FROM user ORDER BY fname ASC";


$result = $db->query($query); 

// Here we do the count
$query_c = "SELECT * FROM user" ;

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


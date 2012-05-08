<?php

require_once($_SERVER[DOCUMENT_ROOT].'/source/class.db.php');

$db = new db();

$sql=$_REQUEST['sql'];

 	$json ='';


if($result=$db->query($sql)) {
	while($obj = mysql_fetch_object($result))
		{
		$arr[] = $obj;
	    }

	// Now create the json array to be sent to our datastore

	$myData = array('rows' => $arr, 'totalCount' => $total, 'respond'=>'Erfolgreich');
	echo json_encode($myData);
	return;
	exit();	
	
} else {
	$json .='{"respond":"Fehler"}';
}

	echo $json;

?>
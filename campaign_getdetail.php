<?php
header('content-type: text/html; charset=UTF-8');


require_once 'source/class.db.php';
require_once 'source/class.writefile.php';

if ($_REQUEST['id']){
	$id = $_REQUEST['id'];
}


$wf = new writefile();
$db = new db();

	 $sql = "SELECT campaign_id,name, startDate, endDate, customer, websites, volumes, rebook, avk, avw, user FROM campaign WHERE campaign_id=$id";
	 
	// $wf->write($sql);
	 $result = $db->query($sql);

	if(mysql_num_rows($result)>0){
		$obj = mysql_fetch_object($result);
		echo '{success: true, data: '.json_encode($obj).'}';
		
	} else {
		echo '{success: false}';
	}
	
?>
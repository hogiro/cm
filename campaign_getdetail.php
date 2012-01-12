<?php


require_once 'source/class.db.php';
require_once 'source/class.writefile.php';

$wf = new writefile();
	 $wf->write('TEST');
$db = new db();

	 $sql = "SELECT name FROM campaign WHERE id=1";
	 
	 $wf->write($sql);
	 $result = $db->query($sql);

	if(mysql_num_rows($result)>0){
		$obj = mysql_fetch_object($result);
		echo '{success: true, data: '.json_encode($obj).'}';
		
	} else {
		echo '{success: false}';
	}
	
?>
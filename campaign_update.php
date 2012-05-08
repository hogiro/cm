<?php
//header('content-type: text/html; charset=UTF-8');


require_once 'source/class.db.php';
require_once 'source/class.writefile.php';

$db = new db();

$wf = new writefile();


if ($_POST) {

	//if ($_REQUEST['action'] == 'submit') {
		
	//  foreach($_POST as $key => $value){
	//  	$wf->write("$key: $value");
	//  }
//	}

$campaign_id= $_POST['campaign_id'];
$name		= $_POST['name'];
$startDate 	= date("Y-m-d", strtotime($_POST['startDate']));
$endDate 	= date("Y-m-d", strtotime($_POST['endDate']));
$customer	= $_POST['customer'];
$websites	= $_POST['websites'];
$volumes	= $_POST['volumes'];
$rebook		= $_POST['rebook'];
$avk		= $_POST['avk'];
$avw		= $_POST['avw'];
$user		= $_POST['user'];

//$startDate =$_POST['startDate'];
//$endDate=$_POST['endDate'];

//$wf->write ('Start Date: '.$startDate.' End Date: '.$endDate);

	/*	
		if ($key == 'id') {
			$id = mysql_real_escape_string($value);
		}else if ($key != '' && $value != ''){
			$keys .= $key.' ,'.mysql_real_escape_string($value).'\',';
		}
		
	*/	
//	  }
	 $sql = "UPDATE campaign SET name='$name', startDate='$startDate', endDate='$endDate', customer='$customer', websites='$websites', volumes='$volumes', rebook='$rebook', avk='$avk', avw='$avw', user='$user' WHERE campaign_id=$campaign_id";
//	 mysql_query('set character set utf8;');
	 $db->query($sql);
/*
	if (trim($sql) != '') {
		$result = $db->query($sql);
		if (!$result) {		
			Echo "{errors:[{id:'name',msg:'".mysql_real_escape_string(mysql_error())."'}]}";
		}else{
			Echo "{errors:[]}";
		}
	}else{
		Echo "{errors:[{id:'name',msg:'nothing done.'}]}";
	}

*/
}
?>
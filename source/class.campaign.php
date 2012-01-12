<?php

require ("class.db.php");

 class campaign {
 	
 	
private $campaign_name;

 
 
	public function add_campaign($campaign_name){
 		
 		$this->campaign_name = $campaign_name;
 		
 		$sql = "INSERT INTO campaign (name) VALUES ('$campaign_name')";
 		
 		$db = new db();
 		$db->query($sql);
 		
	}
	
	
	public function show_campaigns() {
		
		$sql = "SELECT * FROM campaign";
		
		$db = new db();
		$result = $db-> query($sql);
		
		return $result;
		
	}
 
 }
 
?>

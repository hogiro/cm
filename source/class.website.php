<?php

require ("class.db.php");

 class website {
 	
 	
private $website_name;

 
 
	public function add_website($website_name){
 		
 		$this->website_name = $website_name;
 		
 		$sql = "INSERT INTO website (name) VALUES ('$website_name')";
 		
 		$db = new db();
 		$db->query($sql);
 		
	}
	
	
	public function show_campaigns() {
		
		$sql = "SELECT * FROM website";
		
		$db = new db();
		$result = $db-> query($sql);
		
		return $result;
		
	}
 
 }
 
?>

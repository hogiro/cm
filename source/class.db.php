<?php

/**
 * @author hogiro
 * @copyright 2010
 */
 
class db {
	
	private $localHost = 'cm';
	private $localHostWeb = 'dpc';
	
	private $dbHost_local     = 'localhost';
    private $dbUser_local    = 'root';
    private $dbPass_local    = '';
    private $database_local  = 'cmdb';

    private $dbHost_server     = 'localhost';
    private $dbUser_server    = 'dbfederati.90';
    private $dbPass_server     = 'cdobqU7cO2';
    private $database_server   = 'dbfederati90';


    public $link;
    private $result;
    public $sql;
    public $table;


    function __construct($database=""){
                
				if ($_SERVER['HTTP_HOST']==$this->localHost || $_SERVER['HTTP_HOST']==$this->localHostWeb ){
					if (!empty($database)){ $this->database_local = $database; }
                	$this->link = mysql_connect($this->dbHost_local,$this->dbUser_local,$this->dbPass_local);
                	mysql_select_db($this->database_local,$this->link);
				} else {
					if (!empty($database)){ $this->database_server = $database; }
					$this->link = mysql_connect($this->dbHost_server,$this->dbUser_server,$this->dbPass_server);
                	mysql_select_db($this->database_server,$this->link);
				}
                return $this->link;  // returns false if connection could not be made.
        }

        function query($sql){
                if (!empty($sql)){
                        $this->sql = $sql;
                        $this->result = mysql_query($sql);
                        return $this->result;
                } else {
                        return false;
                }
        }
 
        function fetch($result=""){
                if (empty($result)){ $result = $this->result; }
                return mysql_fetch_array($result);
        }
        
        function fetch_assoc($result=""){
                if (empty($result)){ $result = $this->result; }
                return mysql_fetch_assoc($result);
        }
        
        function add ($vars=array()) {
            if (!empty($vars)){
                
                $sql="INSERT INTO ".$this->table." (";
                foreach(array_keys($vars) as $var){
                    if (!($var==end(array_keys($vars)))){
                        $sql=$sql.$var.',';
                    } else {
                        $sql=$sql.$var;                           
                    }  
                }
                
                $sql=$sql.") VALUES (";
                foreach($vars as $value){
                    if (!($value==end($vars))){
                        $sql=$sql."'".$value."',";
                    } else {
                        $sql=$sql."'".$value."'";                           
                    }  
                }
                $sql=$sql.")";
                mysql_query($sql);
            }
        }
		
 
 
        function __destruct(){
                mysql_close($this->link);
        }
		
        
        /* 
        **  Function to Update the Database 
         */
       function update($id, $vars){
            if ((!empty($id)) and(!empty($vars))){
                $sql="UPDATE ".$this->table." SET ";
                 
                foreach(array_keys($vars) as $var){
                    if (!($var==end(array_keys($vars)))){
                        $sql=$sql.$var."='".$vars[$var]."', ";
                    } else {
                        $sql=$sql.$var."='".$vars[$var]."'";                           
                    }  
                }
                $sql=$sql." WHERE ".key($id)."=".$id[key($id)];
                mysql_query($sql);
            }
            
        }
        
        function setTable($table){
            $this->table=$table;
            
        }
        
        function table_exists ($table) { 
	       $tables = mysql_list_tables ($this->database); 
	       while (list ($temp) = mysql_fetch_array ($tables)) {
		      if ($temp == $table) {
			     return TRUE;
		      }
	       }
	       return FALSE;
        }




}


?>
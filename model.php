<?php


require_once('functions.php');


if(!connect_db()) {
      error('Couldn\'t connect to DB');
}


class model {
	
	function foo(){
		//your sql
		return 'DB data';	
	}
	
	function insert_foo($data){		
		$result = mysql_query("INSERT INTO foo (data) VALUES ( '$data')"); 
		if(!$result) return null;
		return mysql_insert_id();	
	}
	
	
	// Add your model functions here
	

		
}
?>
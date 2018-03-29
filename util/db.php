<?php

class db {

	var $conn;

	public function connect (){
		$this->conn = new \mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASENAME);
		return $this->conn;
	}
}

?>
<?php
/**
* ConexionBD.php
* Autor: Tatiana A. Aramburo Morales
* Marzo 2017
*/
require_once "config.php";

class ConexionBD{
	protected $mysqli;
	
	public function __construct()
	{
		$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		if($this->mysqli->connect_errno){
			echo"Fallo al Conectar a MySQL: ". $this->mysqli->connect_error;
			exit();
		}


		 /* change character set to utf8 */
	    if (!$this->mysqli->set_charset("utf8")) {
	        printf("Error loading character set utf8: %s\n", $this->mysqli->error);
	    } else {
	       // printf("Current character set: %s\n", $this->mysqli->character_set_name());
	    }
    

	}
		
}
?>
<?php
/**
* Registros.php
*/
require_once "ConexionBD.php";
//require_once "Usuario.php";

class ControladorBD extends ConexionBD
{
	private $fila;
	
	public function __construct()
	{
		# code...
		parent::__construct();
		//$this->mysqli = $mysqli;
	}
		
	// Funcion llamada para registrar un usaurio en BD			
	public function registrarBD($sql)
	{
		$result = $this->mysqli->query($sql);

		if($result)
		{
			$fila = $this->mysqli->affected_rows;
			if($fila == 1){
				return true;
			}else return false;
		}else{ echo("Ocurrió un error al realizar el registro. Error en:".$this->mysqli->error.".\n");}

		$this->mysqli->close(); // cerrar la conexion con BD
	}

	function consultarUltimoIdInsertado(){
		$ultimoIdInsertado = $this->mysqli->insert_id;
		return $ultimoIdInsertado;
	}

	public function consultarBD($sql){
		$result = $this->mysqli->query($sql);	

		if($result)
		{
			$fila = $this->mysqli->affected_rows;

			if($fila == 1)
			{
				return true;
			}
		}else echo("Ocurrió un error al consultar la Base de Datos, intentelo de nuevo".$this->mysqli->error);


		$this->mysqli->close();	
	}

	public function consultarUnDatoBD($sql){
		$result = $this->mysqli->query($sql);	

		if($result)
		{
			$fila = $this->mysqli->affected_rows;

			if($fila == 1)
			{
				return $fila;
			}
		}else echo("Ocurrió un error al consultar un Datos de la Base de Datos, intentelo de nuevo".$this->mysqli->error);


		$this->mysqli->close();		
	}

	public function obtenerDatosBD($sql)
	{
		$result = $this->mysqli->query($sql);	

		if($result){
			$filas = $this->mysqli->affected_rows;
			if($filas >= 1)
			{
				$datos = array();
				while( $fila=$result->fetch_assoc() ){
					$datos[] = $fila;
				}
				return $datos;
			}
		}else echo("Ocurrio un error al consultar datos en la BD, intentelo de nuevo".$this->mysqli->error);

		$this->mysqli->close();	
	}

}
?>

<?php
Require_once "ControladorBD.php";

class Inmueble{
	
	public $idInmueble, $idCiudad_ciudad, $tipo_inmueble, $barrio, $precio, $estadoInmueble, $noHabitaciones, $noBanios, $pisos, $noParqueadero, $estrato, $descripcion, $idFotos;
	
	public function __construct()
	{	//parent::__construct();
		if(isset($_POST["funcion"]))
		{
			//
		}
	}

	public function registrarInmueble($idCiudad_ciudad, $tipo_inmueble, $barrio, $precio, $estadoInmueble, $noHabitaciones, $noBanios, $pisos, $noParqueadero, $estrato, $descripcion, $idFotos)
	{
		$this->idCiudad_ciudad = $idCiudad_ciudad;
		$this->tipo_inmueble = $tipo_inmueble;
		$this->barrio = $barrio;
		$this->precio = $precio;
		$this->estadoInmueble = $estadoInmueble; 
		$this->noHabitaciones = $noHabitaciones;
		$this->noBanios = $noBanios; 
		$this->pisos = $pisos; 
		$this->$noParqueadero = $noParqueadero; 
		$this->estrato = $estrato; 
		$this->descripcion = $descripcion; 
		$this->$idFotos = $idFotos;
		
		$sql = "INSERT INTO Inmueble (idInmueble, idCiudad_ciudad, tipo_inmueble, barrio, precio, estadoInmueble, noHabitaciones, noBanios, pisos, noParqueadero, estrato, descripcion, idFotos_fotos) VALUES (NULL, '$idCiudad_ciudad', '$tipo_inmueble', '$barrio', '$precio', '$estadoInmueble', '$noHabitaciones', '$noBanios', '$pisos', '$noParqueadero', '$estrato', '$descripcion', '$idFotos');";

			$controlBD = new ControladorBD();
			$registrarInmueble = $controlBD->registrarBD($sql);

			if( $registrarInmueble == true)
			{
				$ultimoId = $controlBD->consultarUltimoIdInsertado();
				return $ultimoId;

			}else{
				$mensaje = " Hubo un erro al intentar registrar el inmueble en la BD \n";
				echo($mensaje);
			}
	}
}
$Inmueble = new Inmueble();
?>
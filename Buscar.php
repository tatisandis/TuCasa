<?php
//require(ConexionBD.php);

$link = mysqli_connect('localhost', 'root', 'root', 'tucasa');
$consultaBusqueda = $_POST['valorBusqueda'];

$mensaje = "";

if($link->connect_errno){
	echo"Lo sentimos, este sitio web esta experimentando problemas";
	echo"Error: fallo conectarse a MySQL:";
	echo"Errno:".$link->connect_errno."\n";
	echo"Error:".$link->connect_error."\n";
	exit;
}

$sql = "SELECT * FROM Inmueble WHERE barrio like '%$consultaBusqueda%'";

if(!$resultado = $link->query($sql)){
	echo"Lo sentimos, este sitio web esta experimentando problemas";
	echo"Error: La ejecución de la consulta fallo debido a:";
	echo"Query: ".$sql."\m";
	echo"Errno:".$link->connect_errno."\n";
	echo"Error:".$link->connect_error."\n";
	exit;
}else if($resultado->num_rows === 0){
	echo "Lo sentimos. No se pudo encontrar una coincidencia para '$consultaBusqueda.' Inténtelo de nuevo.";
    exit;
}else{
		echo "$resultado->num_rows Resultados para $consultaBusqueda.";
		//print_r($resultado);
		while($inmueble = $resultado->fetch_assoc())
		{
				$idInmueble = $inmueble['idInmueble'];
				$idCiudadInmueble = $inmueble['idCiudad_ciudad'];
				$barrio = $inmueble['barrio'];
				$precio = $inmueble['precio'];
				$estadoInmueble = $inmueble['estadoInmueble'];
				$noHabitaciones = $inmueble['noHabitaciones'];
				$noBaños = $inmueble['noBanios'];
				$pisos = $inmueble['pisos'];
				$noParqueadero = $inmueble['noParqueadero'];
				$estrato = $inmueble['estrato'];
				$descripcion = $inmueble['descripcion'];
				$idFotos = $inmueble['idFotos'];

				$mensaje .= '
				<p>
				<strong>idInmueble:</strong> ' . $idInmueble . '<br>
				<strong>idCiudadInmueble:</strong> ' . $idCiudadInmueble . '<br>
				<strong>barrio:</strong> ' . $barrio . '<br>
				<strong>precio:</strong> ' . $precio . '<br>
				<strong>estadoInmueble:</strong> ' . $estadoInmueble . '<br>
				<strong>noHab</strong> ' . $noHabitaciones . '<br>
				<strong>no baños</strong> ' . $noBaños . '<br>
				<strong>pisos</strong> ' . $pisos . '<br>
				<strong>noParqueadero:</strong> ' . $noParqueadero . '<br>
				<strong>estrato:</strong> ' . $estrato . '<br>
				<strong>descripcion:</strong> ' . $descripcion . '<br>
				<strong>idFotos:</strong> ' . $idFotos . '<br>
				</p>';
		}
		echo$mensaje;
		$resultado->free();
}$link->close();


//$mensaje = "";

/*if(isset($consultaBusqueda)) {
	$consulta = mysqli_query($link, "SELECT * FROM Inmueble WHERE barrio like '%$consultaBusqueda%'");

	$filas = mysqli_num_rows($consulta);

	if($filas === 0){
		$mensaje = "<p>No hay ningun barrio con ese nombre</p>";
	}else{
		echo 'Resultados para '.$consultaBusqueda.'.';

		while($Resultados = mysqli_fetch_array($consulta)){
			$idInmueble = $Resultados['idInmueble'];
			$idCiudadInmueble = $Resultados['idCiudad_ciudad'];
			$barrio = $Resultados['barrio'];
			$precio = $Resultados['precio'];
			$estadoInmueble = $Resultados['estadoInmueble'];
			$noHabitaciones = $Resultados['noHabitaciones'];
			$noBanios = $Resultados['noBaños'];
			$pisos = $Resultados['pisos'];
			$noParqueadero = $Resultados['noParqueadero'];
			$estrato = $Resultados['estrato'];
			$descripcion = $Resultados['descripcion'];
			$idFotos = $Resultados['idFotos'];


			$mensaje .= '
			<p>
			<strong>idInmueble:</strong> ' . $idInmueble . '<br>
			<strong>idCiudadInmueble:</strong> ' . $idCiudadInmueble . '<br>
			<strong>barrio:</strong> ' . $barrio . '<br>
			<strong>precio:</strong> ' . $precio . '<br>
			<strong>estadoInmueble:</strong> ' . $estadoInmueble . '<br>
			<strong>noHab</strong> ' . $noHabitaciones . '<br>
			<strong>no baños</strong> ' . $noBanios . '<br>
			<strong>pisos</strong> ' . $pisos . '<br>
			<strong>noParqueadero:</strong> ' . $noParqueadero . '<br>
			<strong>estrato:</strong> ' . $estrato . '<br>
			<strong>descripcion:</strong> ' . $descripcion . '<br>
			<strong>idFotos:</strong> ' . $idFotos . '<br>
			</p>';
		}
		echo $mensaje;
	}
	echo $mensaje;
}else
echo"Nada".$mensaje;*/

?>
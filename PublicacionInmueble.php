<?php
/*
 * PublicacionInmueble.php
 *
 */

require_once("ControladorBD.php");

class PublicacionInmueble{
	private $idUsuario, $noPublicaciones;
	private $controlBD, $publicaciones, $pagina;
	public $tipoPublicacion, $tipo_inmueble, $ciudad, $barrio, $direccion, $precio, $area, $estrato, $habitaciones, $banios, $pisos, $parqueadero, $estadoInmueble, $descripcion;
	public $mensaje, $nuevoNombre;

	function __construct()
	{
		if(isset($_GET["funcion"]))
		{
			if($_GET["funcion"] == 'obtenerDatosPubInmueblePorUsuario'){
				$this->obtenerDatosPubInmueblePorUsuario();
			}
		}else if(isset($_POST["funcion"])){
			if($_POST["funcion"] == 'registrarPublicacion'){
				$this->registrarPublicacion();
			}
		}
	}

	public function registrarPublicacion()
	{

		session_start();
		$idUsuario = $_SESSION["idUsuario"];

		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			$tipoPublicacion = $_POST["tipoPublicacion"];
			$tipoInmueble = $_POST["tipoInmueble"];
			$idCiudad = $_POST["ciudad"];
			$barrio = $_POST["barrio"];
			$direccion = $_POST["direccion"];
			$precio = $_POST["precio"];
			$area = $_POST["area"];
			$estrato = $_POST["estrato"];
			$estadoInmueble = $_POST["estadoInmueble"];
			$habitaciones = $_POST["habitaciones"];
			$banios = $_POST["banios"];
			$pisos = $_POST["pisos"];
			$parqueadero = $_POST["parqueadero"];
			$descripcion = $_POST["descripcion"];

		    for($i = 0; $i < sizeOf($_FILES["foto"]["name"]); $i++)
		    {   //comprobamos si existe un directorio para subir el archivo si no es así, lo creamos
			    /*if(!is_dir("uploads/")) 	mkdir("uploads/", 0777);*/
			        
				$nuevoNombre = $idUsuario."_". uniqid(); //Prefijar el id único

			    //comprobamos si el archivo ha subido
			    if ($_FILES["foto"]["name"][$i] && move_uploaded_file($_FILES['foto']['tmp_name'][$i],"uploads/".$nuevoNombre)){

			    	$_FILES["foto"]["name"][$i] = $nuevoNombre;
			       //$mensaje.="el fichero $i es válido y se subió con exito ".$nuevoNombre;//devolvemos el nombre del archivo para pintar la imagen
				}
			}

			require_once("Fotos.php");
			$fotos = new Fotos();

			$array = $fotos->normalizarArregloFotos($_FILES);

			
			$ultimoIdInsertadoFotos  = $fotos->registrarFotos($array);

			require_once("Inmueble.php");
			$inmueble = new Inmueble();
			$registrarInmueble = $inmueble->registrarInmueble($idCiudad, $tipoInmueble, $barrio, $precio, $estadoInmueble, $habitaciones, $banios, $pisos, $parqueadero, $estrato, $descripcion, $ultimoIdInsertadoFotos);

			$idInmueble = $registrarInmueble;

			$fecha = date('Y-m-j');
			$fechaVencimiento = strtotime ( '+90 day' , strtotime ( $fecha ) ) ;
			$fechaVencimiento = date ( 'Y-m-j' , $fechaVencimiento );
 		
			$sql = "INSERT INTO PublicacionInmueble (idPublicacionInmueble, idInmueble_inmueble, idUsuario_usuario, tipoPublicacion, likesPublicacion, estadoPublicacion, fechaPublicacion, fechaVencimiento, publicacionVerificada) VALUES (NULL, '$idInmueble', '$idUsuario', '$tipoPublicacion', '0', '0', CURRENT_DATE(), '$fechaVencimiento', '0');";

			$controlBD = new ControladorBD();
			$registrarPublicacion = $controlBD->registrarBD($sql);

			if($registrarPublicacion == true)
			{
				$ultimoId = $controlBD->consultarUltimoIdInsertado();
				$mensaje = "Ya se registró la publicacion del inmueble con Id: $ultimoId.  En unas horas se revisará y una vez aprobada, su inmueble sera visto por todos. ";
				echo($mensaje);

			}else{ echo("Ocurrió un error al publicar el inmueble"); }	
			
		}else{ throw new Exception("Error Processing Request", 1);}
	}

	public function consultarNoPublicacionInmuebleUsuario()
	{
		
		$idUsuario = $_SESSION["idUsuario"];

		$sql = "SELECT count(idInmueble_inmueble) as total FROM PublicacionInmueble WHERE idUsuario_usuario=$idUsuario and estadoPublicacion='1';";

		$controlBD = new ControladorBD();
		$publicaciones = $controlBD->obtenerDatosBD($sql); //retorna un array

		$totalPublicaciones = sizeOf($publicaciones);

		if( $totalPublicaciones >= 1)
		{
			return $publicaciones;
		}else{
			return 0;
		}	
	}

	/*--------------------------------------------------------------*/

	public function obtenerDatosPubInmueblePorUsuario()
	{
		if(!isset($_SESSION["idUsuario"]))
		{
			session_start();	
		}
		
		$idUsuario = $_SESSION["idUsuario"];

		//Limito la busqueda
		$noPaginas=4;

		//examino la página a mostrar y el inicio del registro a mostrar
		if(isset($_GET['pagina']))
		{
			$pagina = $_GET["pagina"];
			$inicio = ($pagina - 1) * $noPaginas;
		}else{
			$inicio = 0;
		   $pagina = 1;
		}

		$controlBD = new ControladorBD();

		//$noPublicaciones = consultarNoPublicacionInmuebleUsuario();

		$noPublicaciones = $controlBD->obtenerDatosBD("SELECT count(idInmueble_inmueble) as total FROM PublicacionInmueble WHERE idUsuario_usuario=$idUsuario and estadoPublicacion='1';");

		$totalRegistros = $noPublicaciones[0]['total'];
			
		$total_paginas = ceil($totalRegistros / $noPaginas);
		

		$sql = "SELECT idPublicacionInmueble, idInmueble_inmueble, tipoPublicacion, likesPublicacion, fechaPublicacion, idCiudad_ciudad, tipo_inmueble, precio, descripcion, idFotos_fotos, srcFotos, nombreCiudad FROM PublicacionInmueble INNER JOIN Inmueble ON (idInmueble  = idInmueble_inmueble AND estadoPublicacion = 1 AND idUsuario_usuario = $idUsuario) LEFT JOIN Fotos ON  Fotos.idfotos = Inmueble.idFotos_fotos LEFT JOIN Ciudad ON Ciudad.idCiudad = Inmueble.idCiudad_ciudad limit $inicio, $noPaginas;"; 


		$publicaciones = $controlBD->obtenerDatosBD($sql); //retorna un array
		$totalPublicaciones = sizeof($publicaciones);


		if($totalPublicaciones == 0)
			{		
				echo"<div id='card-alert' class='card light-blue lighten-5'>
						<div class='card-content light-blue-text' >
							<p>
								<i class='material-icons'>notifications</i> Aun no tienes publicaciones.
							</p>
						</div>
					</div>";	
			}else{

				echo"<div id='card-alert' class='card green lighten-5'>
						<div class='card-content green-text center' >
							<p>
							Tienes $totalRegistros publicaciones activas.
							</p>
						</div>
					</div>";
								
				echo"<div class='row' >";

				for( $i= 0; $i < $totalPublicaciones; $i++)
				{
					//$datosFotos = ;
					$fotos = json_decode($publicaciones[$i]['srcFotos'], true);
																	
					$noFoto = $fotos[0]["no"];
					$srcFoto = $fotos[0]["src"];
					//$descripcionFoto = $fotos[0]["descripcion"];
					
					if($i > 2 && $i % 3 == 0)
					{
						echo"</div>";
						echo"<div class='row' >";
					}

					//<li><a href='' class='btn-floating waves-effect waves-light red accent-2'><i class='material-icons'>favorite</i></a></li>

						echo"<div class='col s12 m4 l4'>
								<div class='card'>
									<div class='card-image waves-effect waves-block waves-light'>
									
										<img src='uploads/".$srcFoto."'>
									</div>
									<ul class='card-action-buttons'>
										<li><a href='' class='btn-floating waves-effect waves-light green accent-4'><i class='material-icons'>share</i></a></li>
										
										<li><a href='' class='btn-floating waves-effect waves-light light-blue'><i class='material-icons'>info</i></a></li>
									</ul>
									<div class='card-content'>
										<p class='row'>
											<span class='left'>".$publicaciones[$i]['idPublicacionInmueble']."</span>
											<span class='right'>".$publicaciones[$i]['fechaPublicacion']."</span>
										</p>
										<h4 class='card-title grey-text text-darken-4'>".$publicaciones[$i]['tipo_inmueble']."
										</h4>
									</div>
								</div>";
						echo"</div>";
				}//fin for

				echo"</div>";

				if ($total_paginas > 1) 
				{
					echo"<ul class='pagination center'>";
				    
					if (($pagina-1) > 0){
				   		echo"<li class=''><a onclick='obtenerDatosPubInmueblePorUsuario(".($pagina-1).")'><i class='material-icons'>chevron_left</i></a></li>";
				   	}else echo"<li class='disabled'><a href='#'><i class='material-icons'>chevron_left</i></a></li>";


				    for( $j=1; $j<= $total_paginas; $j++)
				    {
				        	if ($pagina == $j)
				            	echo"<li class='active'><a onclick='obtenerDatosPubInmueblePorUsuario(".$pagina.")'>".$pagina."</a></li>";
				         	else
				           		echo"<li class='waves-effect'><a onclick='obtenerDatosPubInmueblePorUsuario(".$j.")'>".$j."</a></li>";
				    }
				      
				    if (($pagina +1) <= $total_paginas){
				       	echo"<li class='waves-effect'><a onclick='obtenerDatosPubInmueblePorUsuario(".($pagina+1).")'><i class='material-icons'>chevron_right</i></i></a></li>";
				     } else echo"<li class='disabled'><a ><i class='material-icons'>chevron_right</i></i></a></li>";

				    echo"</ul>";
				}  
			}
	}

}//fin clase

$PublicacionInmueble = new PublicacionInmueble();
?>
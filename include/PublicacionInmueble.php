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
		//constructor
		if(isset($_GET["funcion"]))
		{
			if($_GET["funcion"] == 'obtenerDatosPubInmueblePorUsuario'){
				$this->obtenerDatosPubInmueblePorUsuario();
			}else if($_GET["funcion"] == 'consultarPublicaciones'){
				$this->consultarPublicaciones();
			}else if($_GET["funcion"] == 'administrarPublicaciones'){
				$this->administrarPublicaciones();
			}
		}else if(isset($_POST["funcion"])){
			if($_POST["funcion"] == 'registrarPublicacion'){
				$this->registrarPublicacion();
			}
		}

	}

	/*
	 *  Función que registra una publicación.
	 */

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

			if( !isset($tipoPublicacion) || !isset($tipoInmueble) || $idCiudad == "" || $barrio == "" || $direccion == "" || $precio == "" || $area == "" || $estrato == "" || !isset($estadoInmueble) || $descripcion == ""){
				echo("Por favor complete algunos campos.");
			}else{

			    for($i = 0; $i < sizeOf($_FILES["foto"]["name"]); $i++)
			    {   //comprobamos si existe un directorio para subir el archivo si no es así, lo creamos
				    /*if(!is_dir("uploads/")) 	mkdir("uploads/", 0777);*/
				        
					$nuevoNombre = $idUsuario."_". uniqid(); //Prefijar el id único

				    //comprobamos si el archivo ha subido
				    if ($_FILES["foto"]["name"][$i] && move_uploaded_file($_FILES['foto']['tmp_name'][$i],"../uploads/".$nuevoNombre)){

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
				$registrarInmueble = $inmueble->registrarInmueble($idCiudad, $tipoInmueble, $barrio, $direccion, $precio, $estadoInmueble, $habitaciones, $banios, $pisos, $parqueadero, $estrato, $descripcion, $ultimoIdInsertadoFotos);

				$idInmueble = $registrarInmueble;

				$fecha = date('Y-m-j');
				$fechaVencimiento = strtotime ( '+90 day' , strtotime ( $fecha ) ) ;
				$fechaVencimiento = date ( 'Y-m-j' , $fechaVencimiento );
	 		
				$sql = "INSERT INTO PublicacionInmueble (idPublicacionInmueble, idInmueble_inmueble, idUsuario_usuario, tipoPublicacion, likesPublicacion, estadoPublicacion, fechaVencimiento) VALUES (NULL, '$idInmueble', '$idUsuario', '$tipoPublicacion', '0', '0', '$fechaVencimiento');";

				$controlBD = new ControladorBD();
				$registrarPublicacion = $controlBD->registrarBD($sql);

				if($registrarPublicacion == true)
				{
					$ultimoId = $controlBD->consultarUltimoIdInsertado();
					$mensaje = "Ya se registró la publicacion del inmueble con Id: $ultimoId.  En unas horas se revisará y una vez aprobada, su inmueble sera visto por todos. ";
					echo($mensaje);

				}else{ echo("Ocurrió un error al publicar el inmueble."); }	
			}	
		}else{ throw new Exception("Error Processing Request", 1);}
	}

	/*
	 * Funcion que realiza la busqueda de publicaciones de inmuebles de la pag principal
	 *
	 */

	public function buscarPubInmueble()
	{

		$tipoPublicacion = $_GET["tipo_oferta"];
		$tipo_inmueble = $_GET["tipo_inmueble"];
		$ubicacion = $_GET["ubicacion"];

		$controlBD = new ControladorBD();

		$inicio = 0;
		$noPaginas = 25;

		//$noPublicaciones = consultarNoPublicacionInmuebleUsuario();

		$sql = "SELECT idPublicacionInmueble, idInmueble_inmueble, tipoPublicacion, likesPublicacion, DATE_FORMAT(fechaPublicacion, '%d-%M-%Y') as fechaPub, idCiudad_ciudad, tipo_inmueble, noHabitaciones, noBanios, pisos, noParqueadero, precio, descripcion, idFotos_fotos, srcFotos, nombreCiudad 
				FROM PublicacionInmueble 
					INNER JOIN Inmueble 
   						ON (idInmueble  = idInmueble_inmueble AND tipo_inmueble = '$tipo_inmueble') 
					LEFT JOIN Fotos 
   						ON  Fotos.idfotos = Inmueble.idFotos_fotos 
					LEFT JOIN Ciudad 
   						ON (Ciudad.idCiudad = Inmueble.idCiudad_ciudad AND Ciudad.nombreCiudad = '$ubicacion')
    				WHERE tipoPublicacion = '$tipoPublicacion' limit $inicio, $noPaginas;"; 


		$publicaciones = $controlBD->obtenerDatosBD($sql); //retorna un array
		
		//$totalPublicaciones = sizeof($publicaciones);


		//print_r($publicaciones);
		return $publicaciones;


	}

	/*
	 *  Funcion que cuenta las publicaciones de un usuario
	 */
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

	/*
	 * Funcion que obtiene los inmuebles de un Usuario
	 */
	public function obtenerDatosPubInmueblePorUsuario()
	{
		if(!isset($_SESSION["idUsuario"]))
		{
			session_start();	
		}
		
		$idUsuario = $_SESSION["idUsuario"];

		//Limito la busqueda
		$noPaginas=6;

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
		

		$sql = "SELECT idPublicacionInmueble, idInmueble_inmueble, tipoPublicacion, likesPublicacion, DATE_FORMAT(fechaPublicacion, '%d-%M-%Y') as fechaPub, idCiudad_ciudad, tipo_inmueble, precio, descripcion, idFotos_fotos, srcFotos, nombreCiudad FROM PublicacionInmueble INNER JOIN Inmueble ON (idInmueble  = idInmueble_inmueble AND estadoPublicacion = 1 AND idUsuario_usuario = $idUsuario) LEFT JOIN Fotos ON  Fotos.idfotos = Inmueble.idFotos_fotos LEFT JOIN Ciudad ON Ciudad.idCiudad = Inmueble.idCiudad_ciudad ORDER BY PublicacionInmueble.fechaPublicacion DESC limit $inicio, $noPaginas;"; 


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
				
				if($i > 2 && $i % 3 == 0)
				{
					echo"</div>";
					echo"<div class='row' >";
				}
					echo"<div class='col s12 m4 l4 '>
							<div class='card'>
								<div class='card-image waves-effect waves-block waves-light'>
									<img src='../uploads/".$srcFoto."'>
								</div>
								<ul class='card-action-buttons'>
									<li><a href='' class='btn-floating waves-effect waves-light green accent-4'><i class='material-icons'>share</i></a></li>
									<li><a href='' class='btn-floating waves-effect waves-light light-blue'><i class='material-icons'>info</i></a></li>
								</ul>
								<div class='card-content'>
									<p class='row'>
										<span class='left'>".$publicaciones[$i]['idPublicacionInmueble']."</span>
										<span class='right'>".$publicaciones[$i]['fechaPub']."</span>
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


	/*
	 *  Funcion de Administrador: que muestra las publicaciones pendiente de aprobación.
	 */
	public function mostrarPublicacionesPorAprobar()
	{

		$controlBD = new ControladorBD();

		$sql = "SELECT * FROM PublicacionInmueble WHERE estadoPublicacion='0' ORDER by fechaPublicacion;";

		$publicacionesPorAprobar = $controlBD->obtenerDatosBD($sql);

		$totalPublicaciones = sizeof($publicacionesPorAprobar);
			
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
			echo"<table class='striped'>
				<thead>
					<tr>
						<th>Id. Pub.</th>
						<th>Tipo Pub.</th>
						<th>Fecha Pub</th>
						
					</tr>
				</thead>
				<tbody>";
		
			for( $i= 0; $i < $totalPublicaciones; $i++)
			{
				echo"<tr>
			            <td>".$publicacionesPorAprobar[$i]['idPublicacionInmueble']."</td>
			            <td>".$publicacionesPorAprobar[$i]['tipoPublicacion']."</td>
			            <td>".$publicacionesPorAprobar[$i]['fechaPublicacion']."</td>
			         </tr>";
			}
			echo"</tbody></table>";

	//		print_r($publicacionesPorAprobar);
		}
	}//fin function

	/*
	 *  Funcion Administrador: que cuenta todas las publicaciones Activas o Vigentes
	 */
	public function mostrarCuantasPublicacionesActivas()
	{
		$controlBD = new ControladorBD();

		$hoy = Date("Y-m-d H:m:s"); 
		

		$sql = "SELECT COUNT(idPublicacionInmueble) AS no FROM `PublicacionInmueble` WHERE `fechaVencimiento`>'".$hoy."' AND estadoPublicacion=1;";

		$resultadoBD = $controlBD->obtenerDatosBD($sql);

		echo($resultadoBD[0]['no']);	
	}

	/*
	 *  Funcion de Administrador: que muestra todas las publicaciones en una tabla y permite administrar dichas publicaciones.
	 */

	public function administrarPublicaciones()
	{
		//Limito la busqueda
		$noPaginas=6;

		//examino la página a mostrar y el inicio del registro a mostrar
		if(isset($_GET['pagina']))
		{
			$pagina = $_GET["pagina"];
			$inicio = ($pagina - 1) * $noPaginas;
		}else{
			$inicio = 0;
		   $pagina = 1;
		}

		if(isset($_GET['item']))
		{
			$item = $_GET["item"];
		}else{
			$item = 'fechaPub';
		}

		if(isset($_GET['order']))
		{
			$order = $_GET["order"];
		}else{
			$order = 'ASC';
		}


		$controlBD = new ControladorBD();

		$sql = "SELECT idPublicacionInmueble as id, idInmueble_inmueble, tipoPublicacion, estadoPublicacion, likesPublicacion, DATE_FORMAT(fechaPublicacion, '%d-%M/%Y') as fechaPub, idCiudad_ciudad, tipo_inmueble, barrio, direccion, precio, descripcion, idFotos_fotos, srcFotos, nombreCiudad FROM PublicacionInmueble INNER JOIN Inmueble ON idInmueble = idInmueble_inmueble LEFT JOIN Fotos ON Fotos.idfotos = Inmueble.idFotos_fotos LEFT JOIN Ciudad ON Ciudad.idCiudad = Inmueble.idCiudad_ciudad ORDER BY $item $order;";

		$publicaciones = $controlBD->obtenerDatosBD($sql);

		$totalPublicaciones = sizeof($publicaciones);
			
		if($totalPublicaciones == 0)
		{		
			echo"<div id='card-alert' class='card light-blue lighten-5'>
					<div class='card-content light-blue-text' >
						<p>
							<i class='material-icons'>notifications</i> No Hay Publicaciones.
						</p>
					</div>
				</div>";	
		}else{
				echo"<form name='administrarPublicaciones'>
						<div class='row'>
							<div class='col s12 m2 l2'>
								<label>Limite Registros</label>
								<select id='limit' name='limit' class='browser-default'>
									<option>5</option>
									<option>10</option>
									<option>15</option>
									<option>20</option>
									<option>25</option>
									<option>30</option>
									<option>50</option>
									<option>100</option>
									<option>200</option>
									<option>Todo</option>
								</select>
    							
							</div>
				        	<div class='input-field col s12 m4 l4 '>
				           	<input id='search' name='search' type='search' placeholder='Buscar'>
				          	<label class='label-icon' for='search'><i class='material-icons'>search</i></label>

				        	</div>
				      	<div class=' col s12 m2 l2 right'>
		  						<label>Ordenar</label>
		  						<select id='order' class='browser-default'>
			    					<option value='' disabled selected>Ordenar</option>
			    					<option value='idPublicacion ASC'>Id Pub Asc</option>
			    					<option value=''>Id Pub DESC</option>
			    					<option value=''>Tipo Pub. ASC</option>
			    					<option value=''>Tipo Pub. DESC</option>
			    					<option value=''>Dirección ASC</option>
			    					<option value=''>Dirección DESC</option>
			    					<option value=''>Valor ASC</option>
			    					<option value=''>Valor DESC</option>
			    					<option value=''>Ciudad ASC</option>
			    					<option value=''>Ciudad DESC</option>
			    					<option value=''>Fecha Pub ASC</option>
			    					<option value=''>Fecha Pub DESC</option>
			    					<option value=''>Estado ASC</option>
			    					<option value=''>Estado DESC/option>
			    					<option value=''>Likes ASC</option>
			    					<option value=''>Likes DESC</option>
  								</select>
  								
  							</div>
  						</div>
  					</form>";
				/*echo"<div id='card-alert' class='card green lighten-5'>
					<div class='card-content green-text center' >
						<p>
						Existen $totalPublicaciones publicaciones activas.
						</p>
					</div>
				</div>";
				*/
				//<i class='material-icons right'>arrow_drop_down</i>
			echo"<table class='striped bordered'>
				<thead>
					<tr>
						<th>-</th>
						<th><a id=id data-direction=ASC onclick=ordenar('id');>Id. Pub. </a></th>
						<th><a id=tipoPublicacion data-direction=ASC onclick=ordenar('tipoPublicacion')>Tipo Pub.</a></th>
						<th><a class=sorting  id=direccion data-direction=ASC onclick=ordenar('direccion')>Dirección</a></th>
						<th><a id=precio data-direction=ASC onclick=ordenar('precio')>Valor</a></th>
						<th><a id=nombreCiudad data-direction=ASC onclick=ordenar('nombreCiudad')>Nombre Ciudad</a></th>
						<th><a class=sorting id=fechaPub data-direction=ASC onclick=ordenar('fechaPub')>Fecha Pub</a></th>
						<th><a id=estadoPublicacion data-direction=ASC onclick=ordenar('estadoPublicacion')>Estado</a></th>
						<th><a id=likesPublicacion data-direction=ASC onclick=ordenar('likesPublicacion')>likes</a></th>
					</tr>
				</thead>
				<tbody>";
		
			for( $i= 0; $i < $totalPublicaciones; $i++)
			{
				$fotos = json_decode($publicaciones[$i]['srcFotos'], true);
																
				$noFoto = $fotos[0]["no"];
				$srcFoto = $fotos[0]["src"];

				if($publicaciones[$i]['estadoPublicacion'] == 0){
					$estadoPublicacion = "<i class='material-icons md-dark md-inactive'>check</i>";
				}else{
					$estadoPublicacion = "<i class='material-icons md-dark'>check</i>";
				}

				if($publicaciones[$i]['likesPublicacion'] == 0)
				{

					$likes = $publicaciones[$i]['likesPublicacion']." <i class='fa fa-heart-o' aria-hidden='true'></i>";
				}else{
					$likes = $publicaciones[$i]['likesPublicacion']." <i class='fa fa-heart' aria-hidden='true'></i>";
				}

				echo"<tr>
							<td><img class='small materialboxed' src='../uploads/".$srcFoto."'></td>
				 			<td>".$publicaciones[$i]['id']."</td>
			            <td>".$publicaciones[$i]['tipo_inmueble']." en ".$publicaciones[$i]['tipoPublicacion']."</td>
			            <td>".$publicaciones[$i]['direccion']."  en el barrio ".$publicaciones[$i]['barrio']."</td>
			            <td>".$publicaciones[$i]['precio']."</td>
			            <td>".$publicaciones[$i]['nombreCiudad']."</td>
			            <td>".$publicaciones[$i]['fechaPub']."</td>
							<td>".$estadoPublicacion."</td>
			            <td>".$likes."</td>
			         </tr>";
			}
			echo"</tbody></table>";

	//		print_r($publicacionesPorAprobar);
		}
	}

	public function consultarPublicaciones(){
		$controlBD = new ControladorBD();

		$sql = "SELECT idPublicacionInmueble, idInmueble_inmueble, tipoPublicacion, estadoPublicacion, likesPublicacion, DATE_FORMAT(fechaPublicacion, '%d-%M/%Y') as fechaPub, idCiudad_ciudad, tipo_inmueble, barrio, direccion, precio, descripcion, idFotos_fotos, srcFotos, nombreCiudad FROM PublicacionInmueble INNER JOIN Inmueble ON idInmueble = idInmueble_inmueble LEFT JOIN Fotos ON Fotos.idfotos = Inmueble.idFotos_fotos LEFT JOIN Ciudad ON Ciudad.idCiudad = Inmueble.idCiudad_ciudad ;";

		$publicaciones = $controlBD->obtenerDatosBD($sql);

		$totalPublicaciones = sizeof($publicaciones);
			
		if($totalPublicaciones == 0)
		{		
			echo"<div id='card-alert' class='card light-blue lighten-5'>
					<div class='card-content light-blue-text' >
						<p>
							<i class='material-icons'>notifications</i> No Hay Publicaciones.
						</p>
					</div>
				</div>";	
		}else{
			echo json_encode($publicaciones);
		}
	}

}//fin clase

$PublicacionInmueble = new PublicacionInmueble();
?>
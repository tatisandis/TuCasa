<?php
/* Buscar.php 
 * Autor: Tatiana Aramburo 
 * Enero 2018
 */

	session_start();
	require_once("include/Usuario.php");
	require_once("include/PublicacionInmueble.php");

	if(isset($_SESSION['email']) && $_SESSION['loggedin'] == true)
	{
			//Si esta autenticado Estas variables valen session_status() = 2 y $_SESSION['loggedin'] = 1;
			//echo("<h2>sesion iniciada. Estado:".session_status()."Sesion Loggedin:".$_SESSION['loggedin']."</h2>");
		$consultar = new Usuario();
		$usuario = $consultar->consultarUsuario();

	} else {
	//	header('Location: BuscarInmueble.php');
		//echo("<h3>Sesion No. estado:::".session_status().".</h3>");
	}

	

	$pubInmueble = new PublicacionInmueble();
	$buscarPubInmueble = $pubInmueble->buscarPubInmueble();

	$totalPublicaciones = sizeof($buscarPubInmueble);


?>
<!DOCTYPE html>
<html>
<head>
	<title>Lo que Buscas - en TuCasa</title>
	<!-- Fuentes -->
	<link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Devonshire|Montserrat+Alternates" rel="stylesheet"> 
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  	
	<!--Let browser know website is optimized for mobile-->
 	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
 	
	<!-- Iconos Font Awesome -->
	<!--<link rel="stylesheet" href="assets/css/font-awesome.min.css">-->
	<script src="https://use.fontawesome.com/d81e3f5289.js"></script>
	
 	<!-- sweet alert :-->
 	<script src="assets/plugins/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css">

	<!-- Estilos y funciones Javascript propias :-->
	<link rel="stylesheet" href="assets/css/style.css">
	<script type="text/javascript" src="assets/js/Functions.js"></script>
	
	<!-- jquery-form-validator -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.61/jquery.form-validator.min.js" type="text/javascript" charset="utf-8" ></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.61/lang/es.js" type="text/javascript" charset="utf-8"></script>
 	
 	<meta charset="UTF-8"/>
	<!--<link rel="stylesheet" type="text/css" href="css/nouislider.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.1.0/wNumb.min.js"></script> 
	<script type="text/javascript" src="js/nouislider.min.js"></script>-->
		
	<!-- sweet alert :-->
 	<script>
 		$(document).ready(function(){
     		$('.materialboxed').materialbox();
     		$(".button-collapse").sideNav();
			$('.collapsible').collapsible();
  			$('.dropdown-button').dropdown({constrain_width:false});
		});
    </script>   
</head>
<body>
<header>
	<nav class="nav-fixed">
		<div class="nav-wrapper container">
			<ul class="left">
				<li>
				<a href="index.php" class="brand-logo logo left">Tu casa </a>
				</li>
			</ul>
			<a href="#" data-activates="nav-mobile" class="button-collapse right"><i class="material-icons md-light">menu</i></a>
			<input type="hidden" name="idUsuarioSesion" id="idUsuarioSesion" value="<?php echo($_SESSION['idUsuario']);?>">
			<input type="hidden" name="emailSesion" id="emailSesion" value="<?php echo($_SESSION['email']);?>">
				
			<div class="header-search-wrapper hide-on-med-and-down">
				<!--<i class="material-icons" >search</i>-->
				<input class="header-search-input z-depth-2 browser-default" name="search" id="search" placeholder="Buscar" type="search">
				<label for="label-icon" for="search"><i class="material-icons">search</i></label>
			</div>
			<ul class="right hide-on-med-and-down">
				<li><a href="#"><i class="fa fa-user-circle"></i> <?php //echo($_SESSION['email']);?> </a></li>
				<li><a onclick="salir();"><i class="fa fa-sign-out"></i> Salir </a></li>
			</ul>
			<ul  class="right hide-on-large-only">
				
				<li><a href="#" title="<?php if(isset(_SESSION["email"])){echo($_SESSION["email"]);} ?>"><i class="fa fa-user-circle"></i></a></li>
				<li><a onclick="salir();" title="Iniciar Sesión"><i class="fa fa-sign-out"></i></a></li>
			</ul>
		</div>
	</nav>
	<form accept-charset="utf-8" method="POST">
	<ul id="nav-mobile" class="side-nav">
		<li class="user-details">
			<div class="row">
				<div class="col s4 m4 l4">
					<img class="circle responsive-img" src="assets/images/<?php if($usuario[0]["avatar"] == "" || $usuario[0]["avatar"] == "NULL"){ 
						echo('avatar_defecto.png');
					}else echo($usuario[0]['avatar']); ?>" alt="">
				</div>
				<div class="col s8 m8 l8">
					<a class="dropdown-button waves-effect waves-light" href="#" data-beloworigin="true" data-activates="dropdownUser">
						<i class="material-icons right" style="padding-top:10px;">arrow_drop_down</i><?php echo($usuario[0]["nombres"]); ?>
					</a>
					<ul id="dropdownUser" class="dropdown-content">
						<li>
							<a href="#">
								<i class="material-icons md-18">face</i>Pérfil
							</a>
						</li>
						<li>
							<a href="#">
								<i class="material-icons md-18">settings</i>Config
							</a>
						</li>
						<li><a href="#">
							<i class="fa fa-sign-out fa-lg"></i>Salir
							</a>
						</li>
					</ul>
					
				</div>
			</div>

		</li>
		<li class="bold">
			<a href="modules/publicacion_inmueble/FormPublicarInmueble.php" target="iframe"><i class="material-icons">add_to_queue</i>Publicar Inmueble</a> 
		</li>
		<li class="no-padding">
			<ul class="collapsible" data-collapsible="accordion">
				<li class="bold">
					<div class="collapsible-header"><i class="material-icons">view_carousel</i>
						Consultar</div>
					<div class="collapsible-body">
						<ul>
							<li><a href="modules/PanelPrincipalPublicador.php" target="iframe"><i class="fa fa-toggle-on" aria-hidden="true"></i>
Activas</a></li>
							<li><a href="modules/PanelPrincipalPublicador.php" target="iframe"><i class="fa fa-toggle-off" aria-hidden="true"></i>
Inactivas</a></li>
						</ul>
					</div>

				</li>
				
			</ul>
		</li>
		<li class="bold">
		  <a href="#" title="">Otro</a>
		</li>
	</ul>
	</form>
</header>

	<div class="container">
	<div class="row">
        <div class="col m3 l3"><!--
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">Card Title</span>
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="#">This is a link</a>
              <a href="#">This is a link</a>
            </div>
          </div>-->
          <aside>
          		<h5><?php echo($_GET['tipo_inmueble']." en  ".$_GET['tipo_oferta']." en ".$_GET['ubicacion']); ?></h5>
          		<div class="cantidadResultados"><?php echo($totalPublicaciones);?> Resultados</div>
          		<section class="opcionesVista">
          			<dl>
          				<dt>Ordenar Publicaciones</dt>
          				<div class="ordenarPor">
          					Mas relevantes
          				</div>
          				
          			</dl>
          		</section>
          		<section class="filtros_busqueda">
          			<dl>Tipo de Oferta</dl>
          			<dl>Precio desde</dl>
          			<dl>Precio hasta</dl>
          			<dl>Area desde</dl>
          			<dl>Are Hasta</dl>
          			<dl>Habitaciones</dl>
          			<dl>Baños</dl>
          			<dl>Estrato</dl>
          			<dl>Otras Caracteriísticas</dl>
          			<dl>Fecha de Publicación</dl>
          		</section>
          		
          	<h1>0</h1>


          </aside>
        </div>
        <div class="col s12 m7 l7">
        	<section id="results">
        		<?php

    			if($totalPublicaciones == 0)
    			{
    				echo"
                  		<div class='card-content orange-text'>
                    		<p>WARNING : Bandwidth limit exceeded</p>
                  		</div>
                  		<button type='button' class=''close orange-text' data-dismiss='alert' aria-label='Close'>
                    		<span aria-hidden='true'>×</span>
                  		</button>";
                
    			}else{
    				for( $i= 0; $i < $totalPublicaciones; $i++)
					{
						//$datosFotos = ;
						$fotos = json_decode($buscarPubInmueble[$i]['srcFotos'], true);
															
						$noFoto = $fotos[0]["no"];
						$srcFoto = $fotos[0]["src"];
		
							/* idPublicacionInmueble, idInmueble_inmueble, tipoPublicacion, likesPublicacion, DATE_FORMAT(fechaPublicacion, '%d-%M-%Y') as fechaPub, idCiudad_ciudad, tipo_inmueble, precio, descripcion, idFotos_fotos, srcFotos, nombreCiudad 
							*/

    		 			echo"<div class='card horizontal hoverable'>
						    	<div class='card-image valign-wrapper'>
						      		<img class='materialboxed responsive-img' src='uploads/".$srcFoto."'>
						    	</div>
						    	<div class='card-stacked'>
							    	<div class='card-content'>
								      	<span class='card-title activator grey-text text-darken-4'>".$buscarPubInmueble[$i]['tipo_inmueble']."<i class='material-icons right'>more_vert</i></span>
								      	<div class='row'>
								      		<div class='col right'>".$buscarPubInmueble[$i]['precio']."</div>
								      	</div>
								      	<div class='row'>
									      	<div class='col s2'>
									      		<i class='fa fa-bed' aria-hidden='true' title='Habitaciones'></i> ".$buscarPubInmueble[$i]['noHabitaciones']."
									      	</div>
									      	<div class='col s2'>
									      		<i class='fa fa-bath' aria-hidden='true' title='Baños'></i> ".$buscarPubInmueble[$i]['noBanios']."
									      	</div>
									      	<div class='col s5'>
									      		<i class='fa fa-home' aria-hidden='true' title='Area'></i> ".$buscarPubInmueble[$i]['noBanios']."
									      	</div> 
									      	<div class='col s3'>
									      		<i class='fa fa-car' aria-hidden='true' title='Garaje'></i> ".$buscarPubInmueble[$i]['noParqueadero']."
									      	</div>
										</div>      	
								      	<span>Descripción: ".$buscarPubInmueble[$i]['descripcion']."</span>
								    </div>
						    	<div class='card-action'>
						      		
						    	</div>
						    </div>
					  	</div>";
					  }	
				}?>
        	</section>
		</div>
		<div class="col hide-on-small-only m3 l2">Anuncios</div>
    </div>
	</div>

<footer class="page-footer">
	<div class="container">
		<div class="footer-copyright">
			<div class="container">
			© 2017 Copyright Information - <a href="http://twitter.com/tatisandis" target="_blank">Tatiana Aramburo</a>
			</div>
		</div>
	</div>
</footer>

</body>
</html>
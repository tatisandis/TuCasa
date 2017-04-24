<?php
/* find.php 
 * Autor: Tatiana Aramburo 
 * Marzo 2017
 */

	session_start();
	require_once("Usuario.php");

	if(isset($_SESSION['email']) && $_SESSION['loggedin'] == true)
	{
			//Si esta autenticado Estas variables valen session_status() = 2 y $_SESSION['loggedin'] = 1;
			//echo("<h2>sesion iniciada. Estado:".session_status()."Sesion Loggedin:".$_SESSION['loggedin']."</h2>");
		$consultar = new Usuario();
		$usuario = $consultar->consultarUsuario();

	} else {
		header('Location: index.php');
		//echo("<h3>Sesion No. estado:::".session_status().".</h3>");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tu Casa - Busqueda</title>
	
		<link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css?family=Devonshire|Montserrat+Alternates" rel="stylesheet"> 
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		
	 <!-- Compiled and minified CSS -->
	 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
	 	<!--<link rel="stylesheet" href="css/ghpages-materialize.css"> -->

	 	<link rel="stylesheet" href="css/style.css">
      <!--Let browser know website is optimized for mobile-->
	 	 <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> 

	  <!-- Compiled and minified JavaScript -->
	 	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
		<script src="https://use.fontawesome.com/500dcb24a1.js"></script>
		<!--
		<link rel="stylesheet" type="text/css" href="css/nouislider.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.1.0/wNumb.min.js"></script> 
		<script type="text/javascript" src="js/nouislider.min.js"></script>-->
		<!-- sweet alert :-->
 		<script src="js/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
 	
	 	<script src="js/Functions.js"></script>
	 	<meta charset="UTF-8"/>
	 	<script>
	 		$(document).ready(function(){
         		$('.materialboxed').materialbox();
         		$(".button-collapse").sideNav();
				$('.collapsible').collapsible();
      
         		/*var slider = document.getElementById('range-input');
				  noUiSlider.create(slider, {
				   start: [100000, 100000000],
				   connect: true,
				   step: 1,
				   range: {
				     'min': 0,
				     'max': 150000000
				   },
				   format: wNumb({
				     decimals: 0
				   })
				  });
				*/
				/*$('.dropdown-button').dropdown({
					  constrain_width: false
				});*/
				/*
				var nodes = [
					document.getElementById('min-valor'), // 0
					document.getElementById('max-valor')  // 1
				];
				// Display the slider value and how far the handle moved
				// from the left edge of the slider.
				slider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
					nodes[handle].innerHTML = values[handle] ;
					//nodes[handle].innerHTML = values[handle] + ', ' + positions[handle].toFixed(2) + '%';
				});*/
			});
      </script>   
</head>
<body>
<header>
	<nav class="nav-fixed">
		<div class="nav-wrapper">
			<ul class="left">
				<li>
				<a href="index.php" class="brand-logo logo left">Tu casa </a>
				</li>
			</ul>
			<a href="#" data-activates="nav-mobile" class="button-collapse right"><i class="material-icons md-light">menu</i></a>
				
			<div class="header-search-wrapper hide-on-med-and-down">
				<i class="material-icons" >search</i>
				<input class="header-search-input z-depth-2" name="search" placeholder="Buscar" type="text">
				
			</div>
			<ul class="right hide-on-med-and-down">
				<li><a href="#"><i class="fa fa-user-circle"></i> <?php echo($_SESSION['email']);?> </a></li>
				<li><a onclick="salir();"><i class="fa fa-sign-out"></i> Salir </a></li>
			</ul>
			<ul  class="right hide-on-large-only">
				<input type="hidden" name="idUsuarioSesion" id="idUsuarioSesion" value="<?php echo($_SESSION['idUsuario']);?>">
				<input type="hidden" name="emailSesion" id="emailSesion" value="<?php echo($_SESSION['email']);?>">
				<li><a href="#" title="<?php echo($_SESSION['email']);?>"><i class="fa fa-user-circle"></i></a></li>
				<li><a onclick="salir();" title="Iniciar Sesión"><i class="fa fa-sign-out"></i></a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
	</div>
	<form accept-charset="utf-8" method="POST">
	<ul id="nav-mobile" class="side-nav fixed">
		<li class="user-details">
			<div class="row">
				<div class="col s4 m4 l4">
					<img class="circle responsive-img" src="images/<?php if($usuario[0]["avatar"] == "" || $usuario[0]["avatar"] == "NULL"){ 
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
			<a href="PublicarInmueble.php" target="iframe"><i class="material-icons">add_to_queue</i>Publicar Inmueble</a> 
		</li>
		<li class="no-padding">
			<ul class="collapsible" data-collapsible="accordion">
				<li class="bold">
					<div class="collapsible-header"><i class="material-icons">view_carousel</i>
						Consultar</div>
					<div class="collapsible-body">
						<ul>
							<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i>
Activas</a></li>
							<li><a href="#"><i class="fa fa-toggle-off" aria-hidden="true"></i>
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
<main>
	<iframe src="PanelPrincipalPublicador.php" width="80%" name="iframe" id="iframe" onload="cargarHeight();">
	</iframe>
</main>
<footer>
	<div class="container">
	<div class="row">
		<div class="s12"> © 2017 Copyright Information - <a href="http://twitter.com/tatisandis" target="_blank">Tatiana Aramburo</a>
		</div>
	</div>
</footer>
</body>
</html>
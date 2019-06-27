<?php
/* find.php 
 * Autor: Tatiana Aramburo 
 * Marzo 2017
 */

	session_start();
	require_once("../include/Usuario.php");

	if(isset($_SESSION['email']) && $_SESSION['loggedin'] == true && ( $_SESSION["idRol"] = 1 || $_SESSION["idRol"] = 2 ))
	{
			//Si esta autenticado Estas variables valen session_status() = 2 y $_SESSION['loggedin'] = 1;
			//echo("<h2>sesion iniciada. Estado:".session_status()."Sesion Loggedin:".$_SESSION['loggedin']."</h2>");
		$consultar = new Usuario();
		$usuario = $consultar->consultarUsuario();

	} else {
		header('Location: login.php');
		//echo("<h3>Sesion No. estado:::".session_status().".</h3>");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<!--Let browser know website is optimized for mobile-->
 	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
 	<meta charset="UTF-8"/>
	<title>Tu Casa - Admin</title>
	
	<!-- Fuentes -->
	<link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Devonshire|Montserrat+Alternates" rel="stylesheet"> 
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!-- Iconos Font Awesome -->
	<!--<link rel="stylesheet" href="../assets/css/font-awesome.min.css">-->
	<!--<script src="https://use.fontawesome.com/500dcb24a1.js"></script>-->
	<script src="https://use.fontawesome.com/d81e3f5289.js"></script>

	<!--<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	 	
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  	
 	<!-- sweet alert :-->
 	<script src="../assets/plugins/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../assets/css/sweetalert.css">

	<!-- Estilos y funciones Javascript propias :-->
	<link rel="stylesheet" href="../assets/css/style.css">
	<script type="text/javascript" src="../assets/js/Functions.js"></script>
	
	<!-- jquery-form-validator -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.61/jquery.form-validator.min.js" type="text/javascript" charset="utf-8" ></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.61/lang/es.js" type="text/javascript" charset="utf-8"></script>
 	
 	
 	<!--<link rel="stylesheet" type="text/css" href="css/nouislider.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.1.0/wNumb.min.js"></script> 
	<script type="text/javascript" src="js/nouislider.min.js"></script>-->
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
		<div class="nav-wrapper">
			<ul class="left">
				<li>
				<a href="index.php" class="brand-logo logo left">Tu casa </a>
				</li>
			</ul>
			<a href="#" data-activates="nav-mobile" class="button-collapse right"><i class="material-icons md-light">menu</i></a>
			<input type="hidden" name="idUsuarioSesion" id="idUsuarioSesion" value="<?php echo($_SESSION['idUsuario']);?>">
			<input type="hidden" name="emailSesion" id="emailSesion" value="<?php echo($_SESSION['email']);?>">
			<input type="hidden" name="idRol" id="idRol" value="<?php echo($_SESSION['idRol']) ?>">
				
			<div class="header-search-wrapper hide-on-med-and-down">
				<!--<i class="material-icons" >search</i>-->
				<input class="header-search-input z-depth-2 browser-default" name="search" id="search" placeholder="Buscar" type="search">
				<label for="label-icon" for="search"><i class="material-icons">search</i></label>
			</div>
			<ul class="right hide-on-med-and-down">
				<li><a href="#"><i class="fa fa-user-circle"></i> <?php echo($_SESSION['email']);?> </a></li>
				<li><a onclick="salir();"><i class="fa fa-sign-out"></i> Salir </a></li>
			</ul>
			<ul  class="right hide-on-large-only">
				
				<li><a href="#" title="<?php echo($_SESSION['email']);?>"><i class="fa fa-user-circle"></i></a></li>
				<li><a onclick="salir();"><i class="fa fa-sign-out"></i></a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
	</div>
	<form accept-charset="utf-8" method="POST">
	<ul id="nav-mobile" class="side-nav fixed ">
		<li class="user-details ">
			<div class="row">
				<div class="col s4 m4 l4">
					<img class="circle responsive-img" src="../assets/images/<?php if($usuario[0]["avatar"] == "" || $usuario[0]["avatar"] == "NULL"){ 
						echo('avatar_defecto.png');
					}else echo($usuario[0]['avatar']); ?>" alt="avatar">
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
			<a href="Dashboard.php" target="iframe"><i class="material-icons">dashboard</i>Dashboard</a> 
		</li>
		<li class="bold">
			<a href="Publicaciones.php" target="iframe"><i class="material-icons">home</i>Publicaciones</a> 
		</li>
		<li class="no-padding">
			<ul class="collapsible" data-collapsible="accordion">
				<li class="bold">
					<div class="collapsible-header"><i class="material-icons">view_carousel</i>
						Consultar</div>
					<div class="collapsible-body">
						<ul>
							<!--<li><a href="" target="iframe"><i class="fa fa-toggle-on" aria-hidden="true"></i>
Activas</a></li>
							<li><a href="" target="iframe"><i class="fa fa-toggle-off" aria-hidden="true"></i>
Inactivas</a></li>-->
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
<!--<main>-->
	<iframe src="Dashboard.php" width="95%" name="iframe" id="iframe" onload="cargarHeight();">
	</iframe>
<!--</main>-->
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
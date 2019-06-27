<?php 
	session_start();

	if(isset($_SESSION['email']) && $_SESSION['loggedin'] == true)
	{
			header('Location: index.php');
			
	} else {
			// NO HACE NADA, SE QUEDA EN ESTA PAGINA
			

	}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<!--Let browser know website is optimized for mobile-->
 	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
 	<meta charset="utf-8">
 	<title>TuCasa .:. Ingresar al sistema</title>
 	<!-- Fuentes -->
	<link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Devonshire|Montserrat+Alternates" rel="stylesheet"> 
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!-- Iconos Font Awesome 
	<link rel="stylesheet" href="../css/font-awesome.min.css">-->
	<script src="https://use.fontawesome.com/500dcb24a1.js"></script>

	<!--<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	 	
	<!-- Compiled and minified CSS -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
 	
 	<!-- sweet alert :-->
 	<script src="../assets/plugins/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../assets/css/sweetalert.css">

	<!-- Estilos y funciones Javascript propias :-->
	<link rel="stylesheet" href="../assets/css/style.css">
	<script type="text/javascript" src="../assets/js/Functions.js"></script>
 	
 	
 </head>
 <body class="gris">

 <div id="login-page" class="row">
 	<div class="col s12 z-depth-4 card-panel">
 		<form  class="login-form " method="post" accept-charset="utf-8" onsubmit="return ingresarSistema(1);">
 			<div class="row">
 				<div class="input-field col s12 center">
 					<a href="index.php" class="brand-logo logo_negro center">Tu casa </a>
 				</div>
 			</div>
 			<div class="row margin">
 				<div class="input-field col s12">
 					<i class="material-icons prefix">person_outline</i>
 					<input type="text" name="email" id="emailLogin" placeholder="Username">
 					<label for="email">Nombre de Usuario</label>
 				</div>
 			</div>
 			<div class="row margin">
 				<div class="input-field col s12">
					<i class="material-icons prefix">lock_outline</i>
					<input type="password" name="password" id="passwordLogin" placeholder="Password">
 					<label for="password">Constraseña</label>
 				</div>
 			</div>
 			<div class="row">
 				<div class="input-field col s12 m12 l12 login-text">
 					<input type="checkbox" name="remember-me">
 					<label for="remember-me">Recordarme</label>
 				</div>
 			</div>
 			<div class="row">
 				<div class="input-field col s12">
 					<button type="submit" class="btn waves-effect waves-light col s12">Entrar</button>
 				</div>
 			</div>
 		</form>
 	</div>
 </div>
 </body>
 </html>
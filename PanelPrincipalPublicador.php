<?php
/* 
 * PanelPrincipalPublicador.php
 *
 */
	session_start();

	if(isset($_SESSION['email']) && $_SESSION['loggedin'] == true)
	{
			
			
	} else {
			header('Location: index.php');
			
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tu Casa - Panel Publicador</title>
	
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
	
	<!-- sweet alert :-->
	<script src="js/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	
 	<script src="js/Functions.js"></script>
 	<meta charset="UTF-8"/>
</head>
<body>
	<div class="container">
		<div id="resultado">
		<?php
			require_once("PublicacionInmueble.php");
			$publicacionInmueble = new PublicacionInmueble();
			$pub = $publicacionInmueble->obtenerDatosPubInmueblePorUsuario();
		?>					
		</div>
	</div>
			
</body>
</html>

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
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Devonshire|Montserrat+Alternates" rel="stylesheet"> 
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	
 	<!-- Compiled and minified CSS -->
 	<link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  	

 	<link rel="stylesheet" href="../assets/css/style.css">
  	<!--Let browser know website is optimized for mobile-->
 	 <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">


	<!-- sweet alert :-->
	<link rel="stylesheet" type="text/css" href="../assets/css/sweetalert.css">
	
 	<meta charset="UTF-8"/>
</head>
<body>
	<div class="container">
		<div id="resultado">
		<?php
			require_once("../include/PublicacionInmueble.php");
			$publicacionInmueble = new PublicacionInmueble();
			$pub = $publicacionInmueble->obtenerDatosPubInmueblePorUsuario();
		?>					
		</div>
	</div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="../assets/plugins/sweetalert.min.js"></script>		
	<script src="https://use.fontawesome.com/d81e3f5289.js"></script>	
	<script src="../assets/js/Functions.js"></script>
</body>
</html>

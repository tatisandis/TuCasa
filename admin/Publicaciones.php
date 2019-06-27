<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Publicaciones  .::. Admin</title>
	<!-- Fuentes -->
	<link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Devonshire|Montserrat+Alternates" rel="stylesheet"> 
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!-- Iconos Font Awesome -->
	<!--<link rel="stylesheet" href="../assets/css/font-awesome.min.css">-->
	<script src="https://use.fontawesome.com/d81e3f5289.js"></script>

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
	
	<!-- jquery-form-validator -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.61/jquery.form-validator.min.js" type="text/javascript" charset="utf-8" ></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.61/lang/es.js" type="text/javascript" charset="utf-8"></script>
		
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
    		$('.materialboxed').materialbox();
            $('select').material_select();  
  		});	
	</script>
</head>
<body>
<main>
	<div class="panel-heading">
		<h5><i class="fa fa-newspaper-o"></i>  Publicaciones</h5>
	</div>
	<div class="border-box">
    <div id="resultado">
	<?php  
		require_once("../include/PublicacionInmueble.php");
		$consultarPub = new PublicacionInmueble();
		$consultarPub->administrarPublicaciones();
	?>
	</div>
    </div>
</main>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title>Tu Casa - Registrar Usuario</title>
	
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
		<link rel="stylesheet" type="text/css" href="css/nouislider.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.1.0/wNumb.min.js"></script> 
		<script type="text/javascript" src="js/nouislider.min.js"></script>
	 	<script src="js/Functions.js"></script>
	 	<meta charset="UTF-8"/>
	 	<script>
	 		$(document).ready(function(){
         		$('.materialboxed').materialbox();
         		$(".button-collapse").sideNav();
				$('.datepicker').pickadate({
					  selectMonths: true, // Creates a dropdown to control month
    				selectYears: 15 // Creates a dropdown of 15 years to control year
 				 });
        
			});
      </script>   
</head>
<body>
<header>
	<nav class="nav-fixed">
		<div class="nav-wrapper">
			<a href="index.php" class="brand-logo logo left">Tu casa </a>
			<a href="#" data-activates="nav-mobile" class="button-collapse right"><i class="material-icons md-light">menu</i></a>
			<ul  class="right hide-on-med-and-down">
				<li ><a href="#">Registrese</a></li>
				<li><a href="#">Iniciar Sesión</a></li>
				
			</ul>
		</div>
	</nav>
	<div class="container">
	</div>
</header>
<section>
	<div class="image" id="divImage">
		<div class="container divTransparente">
			<div class="row">
				<form class="col s10" accept-charset="utf-8" method="POST">
					<div class="row">
						<div class="input-field  col s6">
							<i class="material-icons prefix">account_circle</i>
							<input type="text" name="nombres" class="validate" placeholder="nombres">
							<label for="nombres">Nombres</label>	
						</div>
						<div class="input-field  col s6">
							<i class="material-icons prefix">account_circle</i>
							<input type="text" name="apellidos" class="validate" placeholder="apellidos">
							<label for="apellidos">Apellidos</label>	
						</div>
					</div>
					<div class="row">
						<div class="  col s6">
							<i class="material-icons prefix">date_range</i>
							<label for="fechaNacimiento">Fecha de Nacimiento</label>
							<input type="date" name="fechaNacimiento" class="datepicker">
							
						</div>
						<div class="input-field  col s6">
							<i class="material-icons prefix">phone</i>
							<input type="tel" name="telefono" class="validate" placeholder="telefono">
							<label class="active" for="telefono">Telefono</label>	
						</div>
					</div>
					<div class="row">
						<div class="input-field  col s4">
							<i class="material-icons prefix">email</i>
							<input type="email" name="email" class="validate">
							<label data-error="wrong" data-success="right" for="email">Email</label>	
						</div>
						<div class="input-field  col s4">
							<input type="password" name="password" class="validate" placeholder="password">
							<label for="password">Password</label>	
						</div>
						<div class="input-field  col s4">
							<input type="password" name="password2" class="validate" placeholder="password">
							<label for="password2">Confirme Password</label>	
						</div>
					</div>
					<div class="row center">
					 <button class="btn waves-effect waves-light" type="submit" name="registrarUsuario">Registrarme
		    			<i class="material-icons right">send</i>
		  			</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</section>
<footer>
	<div class="container">
	<div class="row">
		<div class="s12"> © 2017 Copyright Information - <a href="http://twitter.com/tatisandis" target="_blank">Tatiana Aramburo</a>
		</div>
	</div>
</footer>
</body>
</html>
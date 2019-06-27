<?php
/* find.php 
 * Autor: Tatiana Aramburo 
 * Marzo 2017
 */

	session_start();

	if(isset($_SESSION['email']) && $_SESSION['loggedin'] == true)
	{
			//Si esta autenticado Estas variables valen session_status() = 2 y $_SESSION['loggedin'] = 1;
			//echo("<h2>sesion iniciada. Estado:".session_status()."Sesion Loggedin:".$_SESSION['loggedin']."</h2>");
	} else {
		//header('Location: index.php');
		//echo("<h3>Sesion No. estado:::".session_status().".</h3>");
	}
	/*
	$now = time();

	if($now > $_SESSION['expire']){
		session_destroy();

		echo "su Sesión ha terminado";
		exit;
	}*/
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
		<link rel="stylesheet" type="text/css" href="css/nouislider.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.1.0/wNumb.min.js"></script> 
		<script type="text/javascript" src="js/nouislider.min.js"></script>
		<!-- sweet alert :-->
 		<script src="js/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
 	
	 	<script src="js/Functions.js"></script>
	 	<meta charset="UTF-8"/>
	 	<script>
	 		$(document).ready(function(){
         		$('.materialboxed').materialbox();
         		$(".button-collapse").sideNav();
         		var slider = document.getElementById('range-input');
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

				var nodes = [
					document.getElementById('min-valor'), // 0
					document.getElementById('max-valor')  // 1
				];
				// Display the slider value and how far the handle moved
				// from the left edge of the slider.
				slider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
					nodes[handle].innerHTML = values[handle] ;
					//nodes[handle].innerHTML = values[handle] + ', ' + positions[handle].toFixed(2) + '%';
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
		<li class="search">
			Buscar Oferta
		</li>
		<li class="bold">
			Tipo de Oferta 
			<input id="ubicacion" name="ubicacion" type="text" onKeyUp="buscar();">

		</li>
		<li class="bold">Tipo de Inmueble
		  <select class="browser-default">
		    <option value="Alquilar">Alquilar</option>
		    <option value="Comprar">Comprar</option>
		  </select>
		</li>
		<li class="bold">Precio
			<div id="range-input" class="noUiSlider noUiHorizontal">
			</div>Desde :
			<span id="min-valor" class="center"></span>
		<li class="bold">Hasta : 
			<span id="max-valor" class="center"></span>
		</li>
		<li class="bold">Habitaciones 
			<select name="habitaciones" class="browser-default">
		    	<option value="1">1</option>
		    	<option value="2">2</option>
		    	<option value="3">3</option>
		    	<option value="4">4</option>
		    	<option value="5">5</option>
		    	<option value="6">6</option>
		    	<option value="7">7</option>
		    	<option value="8">8</option>
		    	<option value="9">9</option>
		    	<option value="10">10</option>
		  	</select>
		</li>
		<li class="bold">Baños
			<select name="banios" class="browser-default">
		    	<option value="1">1</option>
		    	<option value="2">2</option>
		    	<option value="3">3</option>
		    	<option value="4">4</option>
		    	<option value="5">5</option>
		    	<option value="6">6</option>
		    	<option value="7">7</option>
		    	<option value="8">8</option>
		    	<option value="9">9</option>
		    	<option value="10">10</option>
		  	</select>
		</li>

	</ul>
	</form>
</header>
<main>
	<div id="resultado" class="">
		<div class="row">
			<div class="col s10">
			  <div class="card horizontal hoverable">
			    <div class="card-image valign-wrapper">
			      <!--<img class="materialboxed responsive-img " src="images/Disenio-de-pequeño-comedor-de-casa-moderna.jpg" >-->
			      <img class="materialboxed responsive-img" src="images/Disenio-de-pequeño-comedor-de-casa-moderna.jpg" >
			    </div>
			    <div class="card-stacked">
			    	<div class="card-content grey lighten-5">
				      	<span class="card-title activator grey-text text-darken-4">Apartamento<i class="material-icons right">more_vert</i></span>
				      	<div class="row">
				      		<div class="col right">$ 150.000</div>
				      	</div>
				      	<div class="row">
					      	<div class="col s2">
					      		<i class="fa fa-bed" aria-hidden="true" title="Habitaciones"></i> 2
					      	</div>
					      	<div class="col s2">
					      		<i class="fa fa-bath" aria-hidden="true" title="Baños"></i> 2
					      	</div>
					      	<div class="col s5">
					      		<i class="fa fa-home" aria-hidden="true" title="Area"></i>200m2
					      	</div> 
					      	<div class="col s3">
					      		<i class="fa fa-car" aria-hidden="true" title="Garaje"></i> 2
					      	</div>
				      		
						</div>      	
				      	<span>Descripción: Este apto tiene cerca un colegio; pasa servicio de transporte:</span>
			      		<!--<a href="#">Link</a>-->
				    </div>
			    	<div class="card-action">
			      		
			    	</div>
			    </div>
			  </div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col s10">
			<div class="card-panel grey lighten-5 z-depth-1">
		          <div class="row valign-wrapper">
		            <div class="col s6">
		              <img src="images/Disenio-de-pequeño-comedor-de-casa-moderna.jpg" alt="" class=" responsive-img"> <!-- notice the "circle" class -->
		            </div>
		            <div class="col s6">
		            <div class="row">
				      		<div class="col right">$ 150.000</div>
				    </div>
				    <div class="row">
					      	<div class="col s2">
					      		<i class="fa fa-bed" aria-hidden="true" title="Habitaciones"></i> 2
					      	</div>
					      	<div class="col s2">
					      		<i class="fa fa-bath" aria-hidden="true" title="Baños"></i> 2
					      	</div>
					      	<div class="col s5">
					      		<i class="fa fa-home" aria-hidden="true" title="Area"></i>200m2
					      	</div> 
					      	<div class="col s2">
					      		<i class="fa fa-car" aria-hidden="true" title="Garaje"></i> 2
					      	</div>
					</div>      	
				     	
			      	<span>Descripción: dfasdkfasdjlkfjasdlkfalksdlfasdfsdafdsfasdfdfsf</span>
		            </div>
		          </div>
		        </div>
		 </div>
      </div>
    
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
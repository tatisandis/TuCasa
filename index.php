<?php
/* index.php 
 * Autor: Tatiana Aramburo 
 * Marzo 2017
 */

	session_start();

	if(isset($_SESSION['email']) && $_SESSION['loggedin'] == true)
	{
			header('Location: find.php');
			
	} else {
			// NO HACE NADA, SE QUEDA EN ESTA PAGINA
			

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tu Casa</title>
	
	<link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Devonshire|Montserrat+Alternates" rel="stylesheet"> 
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="css/font-awesome.min.css">

 	<!-- Compiled and minified CSS -->
 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">

 	<link rel="stylesheet" href="css/style.css">
  	<!--Let browser know website is optimized for mobile-->
 	 <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> 
  	<!-- Compiled and minified JavaScript -->
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
 	<script src="https://use.fontawesome.com/500dcb24a1.js"></script>
 	<script src="js/Functions.js"></script>
 	<!-- sweet alert :-->
 	<script src="js/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.61/jquery.form-validator.min.js" type="text/javascript" charset="utf-8" ></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.61/lang/es.js" type="text/javascript" charset="utf-8"></script>
 	<meta charset="UTF-8"/>
 	<script>
	    $(document).ready(function(){
     		$('select').material_select();
     		$(".button1-collapse").sideNav();
     		$('.modal').modal({
     			dismissible: false
     		}); //dismissible: false para que nada cierre el modal, solo el boton
     		$('.datepicker').pickadate({
     			  max: true,
				  selectMonths: true,
				  selectYears: 70,
				  //selectYears: true, // Creates a dropdown to control month
				  weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
				  today: 'Hoy',
				  clear: 'Limpiar',
				  close: 'Cerrar',
				  hiddenName: true,
				  formatSubmit: 'yyyy/mm/dd'
			});
			$.validate();
	  	});
	  	
  	</script>
	          
</head>
<body>
<header>
	<nav class="nav-fixed">
		<div class="nav-wrapper container">
			<a href="index.php" class="brand-logo logo left">Tu casa </a>
			<ul class="right hide-on-med-and-down">
				<li><a href="#modal1">Registrese</a></li>
				<li><a href="#modal2">Iniciar Sesión</a></li>
				<!--<li><a href="#" data-activates="nav-mobile" class="button-collapse top-nav waves-effect waves-light circle hide-on-large-only"><i class="material-icons">menu</i></a></li>-->
			</ul>
			<ul class="right hide-on-large-and-down">
				<li><a class="hide-on-large-only" href="#modal1"><i class="fa fa-user-plus"></i></a></li>
				<li><a class="hide-on-large-only" href="#modal2"><i class="fa fa-user-circle"></i></a></li>
			</ul>
		</div>
	</nav>
</header>
<section>
	<div class="image" id="divImage">
		<div class="container">
			<div id="divFind" class="row find">
				<div class="row">
					<h1 class="center">Encuentra tu casa aquí</h1>
				</div>
				<div class="row">
					 <div id="oferta" class="input-field col s12 m12 l12">
	               <input id="arrendar" type="radio" name="oferta" value="arrendar" checked>
	               <label for="arrendar">Alquilar</label>
	            
	               <input id="comprar" type="radio" name="oferta" value="comprar" checked>
	               <label for="comprar">Compar</label>
	             </div>
				</div>
				<div class="row">
					<div class="col s3 m3 l3">
						<!--<label>Tipo Inmueble</label>-->
	           			<select class="browser-default">
	                  	<option value="1">Apartamento</option>
	                  	<option value="2">Casa</option>
	                  	<option value="3">Lote</option>
		               </select> 
					</div>
					<div class="col s6 m6 l6">
	       			<input placeholder="Ubicacíón" id="ubicacion" type="input" required>
	       			
	     			</div>
	     			<div class="col s3 m3 l3">
	     				<button class="btn waves-effect waves-teal">
	     					<i class="material-icons right">search</i>
	     					Buscar
	     				</button>
	     			</div>
				</div>	
			</div>
		</div>
	</div>
	<!--Contenido se muestra cuando se quiere registrar-->
	<div id="modal1" class="modal modal-fixed-footer draggable">
		<button class="modal-btn-close modal-close" type="button"></button>
		<div class="row col s12 modal-header center"><h6>Regístrate!</h6></div>
		<form name="formRegistroUsuario"  id="formRegistroUsuario" class="col s12" accept-charset="utf-8" method="POST"  onsubmit="return registrarUsuario();">
		<div class="modal-content">
			<div class="row">
				<div class="row">
						<div class="input-field  col s6">
							<i class="material-icons prefix">account_circle</i>
							<input type="text" name="nombres" id="nombres" maxlength="45" data-validation="length required" placeholder="nombres" data-validation-length="3-45">
							<label data-error="Introduce nombres válidos" data-success="" for="nombres">Nombres</label>	
						</div>
						<div class="input-field  col s6">
							<i class="material-icons prefix">account_circle</i>
							<input type="text" name="apellidos" id="apellidos" class="validate" maxlength="45" placeholder="apellidos" data-validation="length required" data-validation-length="3-45">
							<label for="apellidos" data-error="Introduce apellidos validos" data-success="">Apellidos</label>	
						</div>
					</div>
					<div class="row">
						<div class="  col s6">
							<i class="material-icons prefix">date_range</i>
							<label for="fechaNacimiento">Fecha de Nacimiento</label>
							<input type="date" name="fechaNacimiento" id="fechaNacimiento" class="datepicker">
						</div>
						<div class="input-field  col s6">
							<i class="material-icons prefix">phone</i>
							<input type="tel" name="telefono" id="telefono" maxlength="10"  class="validate" placeholder="telefono" data-validation="length required" data-validation-length="10">
							<label for="telefono" data-error="Ingresa un telefono valido" data-success="">Telefono</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field  col s5">
							<i class="material-icons prefix">email</i>
							<input type="email" name="email" id="email" maxlength="45" class="validate" data-validation="length required" >
							<label data-error="Introduce un email válido" data-success="" for="email">Email</label>	
						</div>
						<div class="input-field  col s3">
							<i class="material-icons prefix">lock_outline</i>
							<input type="password" name="password" id="password" maxlength="100" class="validate" placeholder="password" data-validation="length required" data-validation-length="8-100">
							<label for="password">Password</label>	
						</div>
						<div class="input-field  col s3">
							<input type="password" name="password2" id="password2" maxlength="100" class="validate" placeholder="password" data-validation="length required" data-validation-length="8-100">
							<label for="password2">Confirme Password</label>	
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="modal-footer center">
			  <input class="btn waves-effect waves-light center " type="submit" name="botonRegistrarUsuario" id="botonResgistrarUsuario" onclick="//registrarUsuario();" value=Registrarme >			
		</div>
		</form>
	</div>
	<!--Contenido se muestra cuando se quiere  iniciar sesion-->
	<div id="modal2" class="modal">
		<button class="modal-btn-close modal-close" type="button"></button>
		<div class="modal-content">
			<div class="row col s12 modal-header center"><h6>Iniciar Sesión!</h6></div>
			<div class="row container">
				<form class="col s12" accept-charset="utf-8" method="POST" name="formIngresarAlSistema" id="formIngresarAlSistema" onsubmit="return ingresarSistema();">
					<div class="input-field  col s12">
						<i class="material-icons prefix">account_circle</i>
						<input type="email" name="email" id="emailLogin" class="validate" placeholder="email" required>
						<label for="email" data-error="Introduce un email válido" data-success="">Email  </label>	
					</div>
					<div class="input-field  col s12">
						<i class="material-icons prefix">lock_outline</i>
						<input type="password" name="password" id="passwordLogin" class="validate" placeholder="password" required>
						<label for="password" data-error="Introduce un password">Password</label>	
					</div>
					<button class="col s12 btn waves-effect waves-light" type="submit" name="botonIngresar">Iniciar Sesión</button>
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
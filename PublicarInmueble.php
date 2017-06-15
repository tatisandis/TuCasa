<?php
/* 
 * PanelPrincipalPublicador.php
 *
 */
/*
	session_start();

	if(isset($_SESSION['email']) && $_SESSION['loggedin'] == true)
	{
			
	} else {
			header('Location: index.php');
			
	}
	*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tu Casa - Publicar Inmueble</title>
	
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
	

	<script src="js/dropify.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/dropify.min.css">
 	<script src="js/Functions.js"></script>

 	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.61/jquery.form-validator.min.js" type="text/javascript" charset="utf-8" ></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.61/lang/es.js" type="text/javascript" charset="utf-8"></script>

 	<meta charset="UTF-8"/>
 	<script>
	 		$(document).ready(function(){
	 			$('select').material_select();
	 			$('.dropify').dropify();
	 			$.validate({ modules : 'security', validateHiddenInputs: true});
  			});
	 </script>
</head>
<body>
	<div class="container">
		<form name="formRegistrarPublicacion" id="formRegistrarPublicacion" method="post" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return publicarInmueble();">
			<h5 class="center">Publicar Inmueble</h5>
			<input type="hidden" name="funcion" value="registrarPublicacion">
			<fieldset>
				<legend><i class="fa fa-home" aria-hidden="true"></i>  Datos Publicación</legend>
				 <div class="row">
				 	<div class="input-field col s6">
						<select name="tipoPublicacion" id="tipoPublicacion" data-validation="required" data-validation-error-msg="Por favor escoge un tipo de publicación">
							<option value="" disabled selected>Escoge Tipo Publicación</option>
							<option value="Alquilar">Alquilar</option>
							<option value="Vender">Vender</option>
						</select>
						<label for='tipoPublicacion'>Tipo Publicación</label>	
					</div>
					<div class="input-field col s6">
						<select name="tipoInmueble" id="tipoInmueble" data-validation="required">
							<option value="" disabled selected>Escoge Inmueble</option>
							<option value="Apartamento">Apartamento</option>
							<option value="Aparta-Estudio">Aparta-Estudio</option>
							<option value="Bodega">Bodega</option>
							<option value="Cabaña">Cabaña</option>
							<option value="Casa">Casa</option>
							<option value="Casa Campestre">Casa Campestre</option>
							<option value="Aparta-Estudio">Casa-Lote</option>
							<option value="Consultorio">Consultorio</option>
							<option value="Edificio">Edificio</option>
							<option value="Finca">Finca</option>
							<option value="Habitación">Habitación</option>
							<option value="Local">Local</option>
							<option value="Lote">Lote</option>
							<option value="Oficina">Oficina</option>
							<option value="Parqueadero">Parqueadero</option>
						</select>
						<label for='tipoInmueble'>Tipo Inmueble</label>	
					</div>
				</div>
			</fieldset>
				
			<fieldset>
				<legend><i class="fa fa-map-marker" aria-hidden="true"></i>  Ubicación del Inmueble</legend>
				<div class="row">
					<div class="input-field col s6">
						<select name="ciudad" data-validation="required">
							<option value=""></option>
							<option value="109">Buenaventura</option>
						</select>
						<label>Ciudad/Municipio</label>
					</div>
					<div class="input-field col s6">
						 <input id="barrio" name="barrio" type="text" placeholder="Barrio" data-validation="length required" data-validation-length="3-45">
						<label for="barrio">Barrio</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6">
						 <input id="direccion" name="direccion" type="text" placeholder="Direccion" data-validation="length required" data-validation-length="3-45">
						<label for="direccion">Dirección</label>
					</div>	
				</div>
			</fieldset>
			<fieldset>
				<legend><i class="fa fa-info" aria-hidden="true"></i>  Descripción del Inmueble</legend>
				<div class="row">
					<div class="input-field col s3">
						<input id="precio" name="precio" type="text" placeholder="Precio"  data-validation="number" data-validation-allowing="float" data-validation-decimal-separator=",">
						<label for="precio">Precio ($)</label>
					</div>
					<div class="input-field col s3">
						<input id="area" name="area" type="text" placeholder="Area" data-validation="number">
						<label for="area">Area m2</label>
					</div>
					<div class="input-field col s3">
						<select name="estrato" id="estrato" data-validation="required">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
						</select>
						<label for="estrato">Estrato</label>
					</div>
				
					<div class="input-field col s3">
						<select name="habitaciones" id="habitaciones" data-validation="required">
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
						<label for="habitaciones">No Habitaciones</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s4">
						<select name="banios" id="banios" data-validation="required">
							<option value="0">0</option>
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
						<label for="banios">No Baños</label>
					</div>
					<div class="input-field col s4">
						<select name="pisos" id="pisos" data-validation="required">
							<option value="0">0</option>
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
						<label for="pisos">Pisos</label>
					</div>
					<div class="input-field col s4">
						<select name="parqueadero" id="parqueadero" data-validation="required">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
						</select>
						<label for="parqueadero">Parqueadero</label>
					</div>
				</div>
				<div class="input-field col s12">
					<div class="row">
						<span class="col s3">Estado Inmueble:</span>
						<input class="with-gap col s2" name="estadoInmueble" type="radio" id="nuevo" value="nuevo" data-validation="required"/>
						<label for="nuevo">Nuevo</label>
						<input class="with-gap col s2" name="estadoInmueble" type="radio" id="usado" value="usado" data-validation="required"/>
						<label for="usado">Usado</label>
  						<input class="with-gap col s3" name="estadoInmueble" type="radio" id="enConstruccion" value="enConstruccion" data-validation="required"/>
						<label for="enConstruccion">En Construcción</label>
					</div>
					</div>
					<fieldset>
						<legend><i class="fa fa-bars" aria-hidden="true"></i>  Características del Inmueble</legend>
						<div class="input-field col s12">
						<textarea id="descripcion" name="descripcion" class="materialize-textarea" data-validation="length" data-validation-length="3-45"></textarea>
      					<label for="descripcion">Comentarios</label>
					</div>
					</fieldset>
			</fieldset>
			<fieldset>
				<legend>Fotos Inmueble</legend>
				<div class="row">
					<div class="col s6">
						<input type="file" name="foto[]" class="dropify" data-height="300" data-max-file-size="3M" data-allowed-file-extensions="jpg png" >
					</div>
					<div class="col s6">
						<div class="row">
							<div class="col s4">
								<input type="file" name="foto[]" class="dropify col s4" data-height="120" data-max-file-size="3M" data-allowed-file-extensions="jpg png">
							</div>
							<div class="col s4">
								<input type="file" name="foto[]" class="dropify col s4" data-height="120" data-max-file-size="3M" data-allowed-file-extensions="jpg png" >
							</div>
							<div class="col s4">
								<input type="file" name="foto[]" class="dropify col s4" data-height="120" data-max-file-size="3M" data-allowed-file-extensions="jpg png">
							</div>
						</div>
						<div class="row">
							<div class="col s4">
								<input type="file" name="foto[]" class="dropify" data-height="120" data-max-file-size="3M" data-allowed-file-extensions="jpg png">
							</div>
							<div class="col s4">
								<input type="file" name="foto[]" class="dropify" data-height="120" data-max-file-size="3M" data-allowed-file-extensions="jpg png">
							</div>
							<div class="col s4">
								<input type="file" name="foto[]" class="dropify" data-height="120" data-max-file-size="3M" data-allowed-file-extensions="jpg png">
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<br>
			<div class="row">
				<div class="col s12 center">
					<button type="submit" onclick="//publicarInmueble()" class="btn waves-effect waves-light" name="botonRegistrar">
						<i class="material-icons">add_to_queue</i>
						Publicar
					</button>
				</div>
			</div>
		</form>				
		<div id="resultado"></div>
	</div>		
</body>
</html>
<?php
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dashboard</title>
	<!-- Fuentes -->
	<link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Devonshire|Montserrat+Alternates" rel="stylesheet"> 
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!-- Iconos Font Awesome -->
	<!--<link rel="stylesheet" href="../assets/css/font-awesome.min.css">-->
	<script src="https://use.fontawesome.com/d81e3f5289.js"></script>
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
	
	<!-- jquery-form-validator 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.61/jquery.form-validator.min.js" type="text/javascript" charset="utf-8" ></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.61/lang/es.js" type="text/javascript" charset="utf-8"></script>-->
</head>
<body>
	<main>
		
		<div class="row">
			<div class="col s12 m4 l3">
				<div class="card ">
					<div class="card-content"> 
			  			<div class="circulo-icono pull-left green">
							<i class="fa fa-users"></i>
						</div>
						<div class="title">
							<?php
								require_once("../include/Usuario.php");
								$consultarUsuarios = new Usuario();
								$consultarUsuarios->mostrarCuantosUsuariosRegistrados();
							?>
						</div>	
						<div class="Comment">Usuarios</div>	
					</div>
				</div>
			</div>
			<div class="col s12 m4 l3">
				<div class="card">
					<div class="card-content"> 
			  			<div class="circulo-icono pull-left blue">
							<i class="fa fa-newspaper-o"></i>
						</div>
						<div class="title">
							<?php  
								require_once("../include/PublicacionInmueble.php");
								$consultarPub = new PublicacionInmueble();
								$consultarPub->mostrarCuantasPublicacionesActivas();
							?>
							
						</div>	
						<div class="Comment">Publicaciones</div>	
					</div>
				</div>
			</div>
			<div class="col s12 m4 l3">
				<div class="card">
					<div class="card-content"> 
			  			<div class="circulo-icono pull-left orange">
							<i class="fa fa-home"></i>
						</div>
						<div class="title">
							<?php
							require_once("../include/Inmueble.php");
								$consultarInmueble = new Inmueble();
								$consultarInmueble->mostrarCuantosInmuebles();
							?>
						</div>	
						<div class="Comment">Inmuebles</div>	
					</div>
				</div>
			</div>
		</div>
	
		<div class="row">
			<div class="col s12 m6 l6">
				<ul id="publicaciones_por_aprobar" class="collection">
					<li class="collection-item avatar">
						<i class="fa fa-newspaper-o circle blue"></i>
						<span class="collection-header">Publicaciones Por Aprobar</span>
						
					</li>
					<li class="collection-item">
						<div class="row">
							<div class="row">
								<div class="col s12">
									
									<?php
									require_once("../include/PublicacionInmueble.php");
									$publicacionInmueble = new PublicacionInmueble();
									$publicacionInmueble->mostrarPublicacionesPorAprobar();
									?>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="col s12 m6 l6">
				<ul id="publicaciones_por_aprobar" class="collection">
					<li class="collection-item avatar">
						<i class="fa fa-users circle green"></i>
						<span class="collection-header">Usuarios Nuevos</span>
						<p>Último mes</p>
						
					</li>
						<?php
							require_once("../include/Usuario.php");
							$consultarUsuarios = new Usuario();
							$consultarUsuarios->mostrarUsuariosNuevos();
						?>
				</ul>
			</div>
		</div>
	</main>
</body>
</html>
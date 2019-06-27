/*
 * Functions.js
 * Autor: Tatiana A. Aramburo
 * 2017
 */


/*Cargar la altura en el iframe*/
function cargarHeight(){
	//document.getElementById("prueba").width = window.frames.prueba.document.body.offsetWidth + document.frames.prueba.document.body.scrollWidth;
	document.getElementById("iframe").height = window.frames.iframe.document.body.offsetHeight+100;
	//window.frames.iframe.document.body.offsetHeight; //+ window.frames.iframe.document.body.scrollHeight;
}


/*Funcion para Buscar inmueble*/
function buscarPublicacion(){
	/*var ubicacion = $("input#ubicacion").val();
	var fechaNacimiento = $("input[name=oferta]").val();*/
	var formData = new FormData(document.getElementById("formBuscarPublicacion"));//formData.append("idUsuario", idUsuario);

	if(ubicacion != ""){
		$.get("Buscar.php", {data: formData}, function(mensaje){
			$("#results").html(mensaje);
		});
	}else{
		//alert("ubicacion vacia");
		$("#resultado").html("");
	}
}

/* Función que valida el formulario de Registro de Usuario y luego envia petición asincrona para registrar los datos de un usuario */
function registrarUsuario() 
{
	var nombres = $("#nombres").val();	
	var apellidos = $("#apellidos").val();
	var fechaNacimiento = $("input[name=fechaNacimiento]").val();
	var telefono = $("#telefono").val();
	var email = $("#email").val();
	var password = $("#password").val();
	var password2 = $("#password2").val();


	$('#formRegistroUsuario').validate(function(valid, elem) {
   		//console.log('Element '+elem.name+' is '+( valid ? 'valid' : 'invalid'));
   		if( !valid ) {
   		 	window.parent.swal("Oops...", "Por favor verifique y complete algunos campos.", "error");
   		 	return false;
		}else{
			//swal({title: "Cargando...", text: "Cargando...",  imageUrl: "images/loading.gif"});
			$.ajax({
				url: "include/Usuario.php", 
				data: {funcion: 'registrarUsuario', nombres:nombres, apellidos:apellidos,fechaNacimiento:fechaNacimiento, telefono:telefono, email:email, password:password }, 
				type: 'POST', 
				dataType: 'html', 
				beforeSend: function(){
					swal({title: "Cargando...", text: "Cargando...", imageUrl: "../assets/images/loading.gif"});
				}, success: function(respuestaHTML){
					if(respuestaHTML == "ok"){
						$("#modal1").modal('close');
						document.getElementById("formRegistroUsuario").reset();
						swal("Que bien!", "Ya puede ingresar al sistema utilizando su email "+email+" y password!", "success");
					}else
						swal("Oops...", respuestaHTML, "error");
						return false;
					//$("#resultado").html(respuestaHTML);
				}, error : function(xhr, status){
					swal("Oops...", "Un error ocurrio!", "error");
					return false;
				}
			});
		}
	});
}

function ingresarSistema(rol)
{
	var url;
	var email = $("#emailLogin").val();
	var password = $("#passwordLogin").val();

	if(rol == 1){
		url = "../include/Usuario.php";
		var mensaje = swal({title: "Cargando...", text: "Cargando...",  imageUrl: "../assets/images/loading.gif"});
	}else{
		url = "include/Usuario.php";
	}	var mensaje = swal({title: "Cargando...", text: "Cargando...",  imageUrl: "assets/images/loading.gif"});
	console.log(url);

	if( email == 0 || password == 0){
		alert("Por favor llene los datos.");
		return false;
	}else
		mensaje;
		$.ajax({
			url: url, 
			data: {funcion: 'ingresarSistema', email:email, password:password, rol:rol}, 
			type: 'POST', 
			dtaType: 'html', 
			success: function(respuestaHTML){
				if(respuestaHTML == "ok"){
					swal("Que bien!", "Ingresaras al sistema "+email+"...", "success");
					if(rol == 1|| rol == 2){
						location.href = "index.php";
					}else if(rol == 3)
					{
						location.href = "index.php";
					}
				}else
					swal("Oops...", respuestaHTML, "error");
					return false;
				//$("#resultado").html(respuestaHTML);
			}, error : function(xhr, status){
				swal("Oops...", "Un error ocurrio!", "error");
				return false;
			}
		});
	return false;
}

function salir()
{
	var idUsuario = $("#idUsuarioSesion").val();
	var email = $("#emailSesion").val();
	var idRol = $("#idRol").val();
    
    console.log("idRol"+idRol);
	if(idRol == 1){//si usuario es administrador
		var url = "../include/Usuario.php";
		console.log("url"+url);
	}else{
		var url = "include/Usuario.php";
	}
	swal({title: "Cargando...", text: "Cargando...",  imageUrl: "assets/images/loading.gif"});
	$.ajax({
		url: url, 
		data: {funcion: 'salirSistema', idUsuario:idUsuario, email:email}, 
		type: 'POST', 
		dtaType: 'html', 
		success: function(respuestaHTML){
			if(respuestaHTML == "ok"){
				swal("Regresa Pronto!", " "+email+"...", "success");
				location.href = "index.php"
			}else
				swal("Oops...", respuestaHTML, "error");
				return false;
			//$("#resultado").html(respuestaHTML);
		}, error : function(xhr, status){
			swal("Oops...", "Un error ocurrio!", "error");
			return false;
		}
	});
}

function obtenerDatosPubInmueblePorUsuario(pagina){

	$.ajax({
		url: "../include/PublicacionInmueble.php", 
		data: {funcion: 'obtenerDatosPubInmueblePorUsuario', pagina:pagina}, 
		type: 'GET', 
		dtaType: 'html', 
		success: function(respuestaHTML){
			$("#resultado").html(respuestaHTML);
		}, error : function(xhr, status){
			swal("Oops...", "Un error ocurrio!", "error");
			return false;
		}
	});	
	cargarHeight();
}

function validarFormulario(){
	if( !$('#formRegistrarPublicacion').isValid('es', {}, false) )
	{
		console.log("Faltan datos por ingresar, formulario no  es valido para enviarlo.");
		window.parent.swal("Oops...", "Por favor verifique y complete algunos campos.", "error");
   		return false;
   	}else{return true;
   	}
	
}

function publicarInmueble()
{
	
	/*if( !$('#formRegistrarPublicacion').isValid('es', {}, false) )
	{
		console.log("Faltan datos por ingresar, formulario no  es valido para enviarlo.");
		window.parent.swal("Oops...", "Por favor verifique y complete algunos campos.", "error");
   		return false;
	}else{
	
		alert("Formulario se enviara");*/
	if(validarFormulario()== true)
	{	
		var formData = new FormData(document.getElementById("formRegistrarPublicacion"));//formData.append("idUsuario", idUsuario);
		//var idUsuario = $("#idUsuarioSesion").val();
		$.ajax({
			url: "../../include/PublicacionInmueble.php", 
			type: 'POST', 
			data: formData, // datos del formulario
			//Necesario para subir archivos via ajax
			cache: false,
	        contentType: false,
			processData: false,
			beforeSend: function(){
				window.parent.swal({title: "Cargando...", text: "Cargando...", imageUrl:"assets/images/loading.gif"});
				console.log("Cargando..");
				//return false;
			},success: function(respuestaHTML){
				if(respuestaHTML){
					window.parent.swal("Que bien!", respuestaHTML, "success");
					//$("#resultado").html(respuestaHTML);
					return false;				
				}else
					window.parent.swal("Oops...", respuestaHTML, "error");
					//$("#resultado").html(respuestaHTML);
					return false;
				//$("#resultado").html(respuestaHTML);
			},error : function(xhr, status){
				window.parent.swal("Oops...", "Un error ocurrio al publicar el inmueble!"+xhr, "error");
				console.log("error del xhr");
				return false;
			}
		});
		return false;
	}else{alert("no es valido"); return false;}
	
		
}

function ordenar(item){
	var item = item;
	var order = document.getElementById(item).getAttribute("data-direction"); 
	mostrarPublicacionesAdmin(item, order, 1);
}


function mostrarPublicacionesAdmin(item, order, pagina){
	$.ajax({
		url: "../include/PublicacionInmueble.php", 
		data: {funcion: 'administrarPublicaciones', pagina:pagina, item:item, order:order}, 
		type: 'GET', 
		dtaType: 'html', 
		success: function(respuestaHTML){
			$("#resultado").html(respuestaHTML);
			if(order == 'ASC'){
				document.getElementById(item).setAttribute("data-direction","DESC");
				document.getElementById(item).innerHTML += "&nbsp; <i class='fa fa-sort-asc' aria-hidden='true'></i>";
			}else{
				//
				document.getElementById(item).setAttribute("data-direction","ASC");
				document.getElementById(item).innerHTML += "&nbsp; <i class='fa fa-sort-desc' aria-hidden='true'></i>";
			}
		}, error : function(xhr, status){
			swal("Oops...", "Un error ocurrio!", "error");
			return false;
		}
	});	
}
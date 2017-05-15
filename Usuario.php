<?php
Require_once "ControladorBD.php";

class Usuario{
	private $idUsuario, $nombres, $apellidos, $fechaNacimiento, $telefono, $email, $password, $fechaRegistro, $fechaUltimoIngreso, $idRol_rol;
	private $controlBD, $emailExisteBD, $mensaje;

	public function __construct()
	{
		//parent::__construct();
		if(isset($_POST["funcion"]))
		{
			if($_POST["funcion"] == 'registrarUsuario'){
				$this->registrarUsuario();	
			}else if($_POST["funcion"] == 'ingresarSistema'){
				$this->ingresarAlSistema();
			}else if($_POST["funcion"] == 'salirSistema'){
				$this->salirSistema();
			}
			
		}//else echo"No hay ninguna función";
	}

    public function registrarUsuario()
    {
    	$controlBD = new ControladorBD();

		$nombres = $_POST['nombres'];
		$apellidos = $_POST['apellidos'];
		$fechaNacimiento = $_POST['fechaNacimiento'];
		$telefono = $_POST['telefono'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		$passwordMD5 = md5($password);

		$emailExisteBD = $controlBD->consultarBD("SELECT email from Usuario WHERE email='$email';");

		if($emailExisteBD){

			$mensaje = " El email $email ya está registrado.";
			echo($mensaje);

		}else{
			$sql = "INSERT INTO Usuario (nombres, apellidos, fechaNacimiento, telefono, email, password, fechaRegistro, fechaUltimoIngreso, idRol_rol) VALUES ('$nombres', '$apellidos', '$fechaNacimiento','$telefono', '$email', '$passwordMD5', CURRENT_DATE(), null, '3');";

			$controlBD = new ControladorBD();
			$registrarUsuario = $controlBD->registrarBD($sql);

			if( $registrarUsuario == true)
			{
				$mensaje = "ok";
				echo($mensaje);

			}else{
				$mensaje = " Hubo un erro al intentar registrar $email en la BD: $registrarUsuario. Por favor intentelo de nuevo. ";
				echo($mensaje);
			}	
		}

	}

	public function ingresarAlSistema()
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		//$rol = $_POST['rol'];

		$passwordMD5 = md5($password);

		$sql = "SELECT idUsuario, email FROM Usuario WHERE email='$email' AND password='$passwordMD5'";

		$controlBD = new ControladorBD();
		$result = $controlBD->obtenerDatosBD($sql);// retorna un array;

		$tamaño = sizeOf($result);

		if( sizeof($result) >= 1)
		{
			
			session_start();
			$_SESSION["loggedin"] = true;
			$_SESSION["idUsuario"] = $result[0]['idUsuario'];
			$_SESSION["email"] = $result[0]['email'];
			//$_SESSION['start'] = time();
			//$_SESSION['expire'] = $_SESSION['start'] + (5*60);

			$mensaje = "ok";
			echo($mensaje);
		}else{
			$mensaje = " El usuario y la clave no concuerdan, intente de nuevo.";
			echo($mensaje);
		}
	}

	public function consultarUsuario()
	{
		$idUsuario = $_SESSION["idUsuario"];

		$sql = "SELECT * FROM Usuario WHERE idUsuario=$idUsuario;";

		$controlBD = new ControladorBD();
		$usuario = $controlBD->obtenerDatosBD($sql); //retorna un array

		//print_r($usuario);
		return $usuario;
	}

	public function salirSistema()
	{
		$idUsuario = $_POST['idUsuario'];
		$email = $_POST['email'];

		$sql = "UPDATE Usuario SET fechaUltimoIngreso=now() WHERE idUsuario=$idUsuario;";

		$controlBD = new ControladorBD();
		$result = $controlBD->consultarBD($sql);

		if( $result == true)
		{
			session_start(); //mantiene activa la sesion
    		session_destroy(); //destruye la sesion iniciada
    		$mensaje = "ok";
    		echo($mensaje);
    	}else{
    		//$mensaje = " Ocurrió un error al cerrar la sesión, por favor intente de nuevo.";
    		$mensaje = $result;
			echo($mensaje);
    	}

	}

	public function getListUsers()
    {
    	/*echo "ejecutar getlistUsers()";
    	$sql = "SELECT * FROM Usuario;";
    	$Usuario = new ControladorBD();
    	//$objUsr = new Usuario();

    	$listadoUsuarios = $Usuario->getListUsersBD($sql, $this);

    	print_r($listadoUsuarios);
    	*/
        
    }
}

$Usuario = new Usuario();
?>
<?php
Require_once "ControladorBD.php";

class Fotos{
	
	public $idFotos, $srcFotos;
	public $files;
	
	public function __construct()
	{	//parent::__construct();
		if(isset($_POST["funcion"]))
		{
			//
		}
	}

	public function registrarFotos($fotos)
	{
		$sql = "INSERT INTO Fotos (idfotos, srcFotos) VALUES (NULL, '[";

		//print_r($fotos["foto"]);
		$tamaño = sizeOf($fotos);

		for($i=0; $i < $tamaño; $i++)
		{
			$no = $i+1;
			$sql .= "{\"no\":\"$no\", \"src\":\"".$fotos[$i]["name"]."\", \"type\":\"".$fotos[$i]["type"]."\", \"size\": \"".$fotos[$i]["size"]."\"}";	
			if( $no != $tamaño ){
				$sql .= ", ";	
			}
		}

		$sql.="]');";

		$controlBD = new ControladorBD();
		$registrarFotos = $controlBD->registrarBD($sql);

		if( $registrarFotos == true)
		{
			$ultimoId = $controlBD->consultarUltimoIdInsertado();
			return $ultimoId;
		}else{
			$mensaje = " Hubo un erro al intentar registrar las fotos en la BD. Por favor intentelo de nuevo.\n";
			echo($mensaje);
		}	
	}

	public function normalizarArregloFotos($files){
	 	//function normalize_files_array($files= []) {

		$this->files = $files;
				
        $normalized_array = [];

        foreach($files as $index => $file)
        {
        	
            if (!is_array($file['name'])) {
                $normalized_array[$index][] = $file;
                continue;
            	
            }

            foreach($file['name'] as $idx => $name) {
            	if(!empty($file["name"]["$idx"]))
            	{
                	//$normalized_array[$index][$idx] = [
                	$normalized_array[$idx] = [
                    'name' => $name,
                    'type' => $file['type'][$idx],
                    'tmp_name' => $file['tmp_name'][$idx],
                    'error' => $file['error'][$idx],
                    'size' => $file['size'][$idx]
                	];
            	}
            }

        }
        
		sort($normalized_array);

  		return $normalized_array;
	
	}


}
$Fotos = new Fotos();
?>
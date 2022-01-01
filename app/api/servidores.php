<?php
include('../../ajax/validarSesion.php');

$response =  array();
	if(isset($_GET["id"])){
		$id_subaplicativo = $_GET["id"];
		$tipo = $_GET["server"];
		include "mysqlconnection.php";
		if($tipo == "kenos"){
			$tipo = "Produccion";
		}else{
			$tipo = "Contingencia";
		}
			$query = "SELECT servidores.*
                FROM subaplicativos_servidor, servidores
                WHERE subaplicativos_servidor.ID_SERVIDOR = servidores.ID
								AND servidores.TIPO = '$tipo'
                AND subaplicativos_servidor.ID_SUBAPLICATIVO = ".$id_subaplicativo;


			$result = $mysqli->query($query);

			while ($fila = $result->fetch_assoc()) {
        $response[] = array(
          "ID" =>utf8_encode($fila["ID"]),
          "NOMBRE" =>utf8_encode ($fila["NOMBRE"]),
          "SO" =>utf8_encode ($fila["SO"]),
          "IP" =>utf8_encode ($fila["IP"]),
					"BASEDATOS" =>utf8_encode ($fila["BASEDATOS"]),
					"GRANJA" =>utf8_encode ($fila["GRANJA"])
        );
			}


	}else{
			$id_subaplicativo = $_GET["id_subaplicativo"];
		include "mysqlconnection.php";
			$tipo = $_GET["server"];
		if($tipo == "kenos"){
			$tipo = "Produccion";
		}else{
			$tipo = "Contingencia";
		}
		//Extraer información del proceso
		$query = "SELECT * FROM banco.servidores WHERE TIPO = '$tipo' AND ID not in (SELECT ID_SERVIDOR FROM banco.subaplicativos_servidor WHERE ID_SUBAPLICATIVO = $id_subaplicativo)";
		$result = $mysqli->query($query);

		while ($fila = $result->fetch_assoc()) {
			//escribir("ldap", $fila["ID"]." ".getName($fila["AFA"]). " ".getName($fila["RA"]));
			    $response[] = array(
			    	"ID" =>utf8_encode($fila["ID"]),
			    	"NOMBRE" =>utf8_encode ($fila["NOMBRE"]),
						"SO" =>utf8_encode ($fila["SO"]),
	          "IP" =>utf8_encode ($fila["IP"]),
						"BASEDATOS" =>utf8_encode ($fila["BASEDATOS"]),
						"GRANJA" =>utf8_encode ($fila["GRANJA"])
          );
			}
		//echo var_dump($response);
	}

	header('Content-type: application/json');
	echo json_encode($response);
 ?>

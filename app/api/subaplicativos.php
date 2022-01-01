<?php

include('../../ajax/validarSesion.php');


	$response =  array();

	$query = "SELECT * FROM subaplicativos";

	if(isset($_GET["id"]) && isset($_GET["ra"])){
		$id_app = $_GET["id"];
		$ra = $_GET["ra"];

		$query .= " WHERE ID_APLICATIVO = ".$id_app." AND RA = '".$ra."'";
		include "mysqlconnection.php";
		$result = $mysqli->query($query);

		while ($fila = $result->fetch_assoc()) {
			$response[] = array(
				"ID" =>utf8_encode($fila["ID"]),
				"NOMBRE" =>utf8_encode($fila["NOMBRE"]),
				"AFA" =>utf8_encode(getName($fila["AFA"])),
				"RA" =>utf8_encode(getName($fila["RA"])),
				"RA_FIN" =>utf8_encode(getName($fila["RA_FIN"]))
			);
		}
	}

	header('Content-type: application/json');
	echo json_encode($response);
 ?>

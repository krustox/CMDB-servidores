<?php
include('../../ajax/validarSesion.php');
	$response = array();
	$id_servidor = $_GET["id_servidor"];
	$id_subaplicativo = $_GET["id_subaplicativo"];

	$query = "INSERT INTO subaplicativos_servidor VALUES ('{$id_subaplicativo}','{$id_servidor}');";

	include "mysqlconnection.php";
	$result = $mysqli->query($query);

	if($result){
		escribir("Servidor", "Agregado " . $_SESSION["nombre"]." ". $_SESSION["ip"] . "  ".$query);
		$response["status"] = "ok";
		echo "Servidor Agregado";
	}else{
		escribir("Servidor", "Error " . $_SESSION["nombre"]." ". $_SESSION["ip"] . " ".$query);
		$response["status"] = "error";
		echo "Servidor no Agregado";
	}

 ?>

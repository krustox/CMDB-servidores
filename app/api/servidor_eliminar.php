<?php
include('../../ajax/validarSesion.php');

	$id_servidor = $_GET["id_servidor"];
	$id_subaplicativo = $_GET["id_subaplicativo"];

	$query = "DELETE FROM subaplicativos_servidor WHERE ID_SUBAPLICATIVO = '{$id_subaplicativo}' AND ID_SERVIDOR = '{$id_servidor}'";

	include "mysqlconnection.php";
	$result = $mysqli->query($query);

	if($result){
		escribir("Servidor_Eliminado", "Eliminado " . $_SESSION["nombre"]." ". $_SESSION["ip"] . "  ".$query);
		echo "Se eliminó el registro seleccionado";
	}else{
		escribir("Servidor_Eliminado", "ERROR " . $_SESSION["nombre"]." ". $_SESSION["ip"] . "  ".$query);
		echo "No se pudo eliminar el registro seleccionado";
	}

 ?>

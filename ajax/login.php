<?php
include('../Config/mysql.php');
include('../Config/variables.php');
include('../Functions/Archivo.php');
include('../Functions/Function.php');
include('../Functions/ldap.php');

$user = $_POST['user'];
$contra = $_POST['pass'];
session_start();

if($contra == ""){
	$contra = "xxx   xxx";
}
if(substr($user, 0,5) != "banco" && $user != "ABEST")
{
	$user = "banco\\".$user;
}

if(strpos($user,"banco") === FALSE ){
	if($user == "ABEST" & $contra == "ABEST") {
		$ip = getRealIP();
		$session = session_id();
		$encuesta = "SERVIDORES-RA";

		iniciar_session($user,$session,$ip,$encuesta,$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host);
		$_SESSION['c'] = "1";
		$_SESSION['status'] = "OK";
		$_SESSION['nombre'] = "mpoblet3";
		$_SESSION['nombre1'] = $user;
		$_SESSION['session'] = $session;
		$_SESSION['encuesta'] = $encuesta;
		$_SESSION['ip'] = $ip;

		header("Location: http://$host/bancoestado-servidores/app/procesos/index.php");
	}else{

		echo "Hay un error en la informacion del usuario";
		escribir("login_err", "|".$user . "| No pudo ingresar |". $contra."|");
		header("Location: http://$host/bancoestado-servidores/index.php?login=error");
	}
}else{

	//LDAP
if(login($user, $contra)) {
	$ip = getRealIP();
	$session = session_id();
	$encuesta = "SERVIDORES-RA";
	iniciar_session(substr($user,6),$session,$ip,$encuesta,$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host);

	if($user == "banco\\"."darbelae"){
			$_SESSION['nombre'] = "mpoblet3";
	}else{
			$_SESSION['nombre'] = substr($user,6);
	}
	$_SESSION['c'] = "1";
	$_SESSION['nombre1'] = substr($user,6);
	$_SESSION['ip'] = $ip;
	$_SESSION['session'] = $session;
	$_SESSION['encuesta'] = $encuesta;
	$_SESSION['status'] = "OK";

	header("Location: http://$host/bancoestado-servidores/app/procesos/index.php");
	}else{

	echo "Hay un error en la informacion del usuario";
	escribir("login_err", "|".$user . "| No pudo ingresar |". $contra."|");
	header("Location: http://$host/bancoestado-servidores/index.php?login=error");
	}
}
?>

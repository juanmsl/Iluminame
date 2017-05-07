<?php

require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

if(isset($_POST['old_password']) &&
	isset($_POST['new_password']) &&
	isset($_POST['conf_new_password'])) {

	$old_password = filter($_POST['old_password']);
	$new_password = filter($_POST['new_password']);
	$conf_new_password = filter($_POST['conf_new_password']);

	$isValidPassword = strlen($new_password) >= 6 && strlen($new_password) <= 20 && $new_password == $conf_new_password && $new_password != $old_password;

	if($isValidPassword) {
		$new_password = $core->UberHash($new_password);
		$update_query = "UPDATE estudiantes SET contrasena = '" . $new_password . "' WHERE id = " . USER_ID . ";";
		$_SESSION['UBER_USER_H'] = $new_password;
		dbquery($update_query);
		$_SESSION['configuration_result'] = "Se ha cambiado la contraseña correctamente";
		$_SESSION['emoji'] = 'happy';
	} else {
		$_SESSION['configuration_result'] = "No se pudo cambiar la contraseña";
		$_SESSION['emoji'] = 'sad';
	}
	header("Location: " . WWW . "/configuration.php");
	exit;
}

?>

<?php
require_once "global.php";

if (LOGGED_IN)
{
	header("Location: " . WWW . "/home.php");
	exit;
}


if (isset($_POST['register_username']) && isset($_POST['register_email']) && isset($_POST['register_password']) && isset($_POST['register_password_conf']))
{
	$register_username = $_POST['register_username'];
	$register_email = $_POST['register_email'];
	$register_password = $_POST['register_password'];
	$register_password_conf = $_POST['register_password_conf'];

	$reg_username = filter($register_username);
	$reg_email = filter($register_email);
	$reg_password = filter($register_password);
	$reg_password_check = filter($register_password_conf);

	$isValidEmail = $users->IsValidEmail($reg_email) && $register_email == $reg_email;
	$isValidUser = $users->IsValidName($reg_username) && $register_username == $reg_username;
	$isValidPassword = strlen($reg_password) >= 3 && strlen($reg_password) <= 20;

	if (!$users->IsEmailTaken($reg_email) && !$users->IsNameTaken($reg_username) && $reg_password_check == $reg_password)
	{
		$reg_password = hash('sha256', $reg_password);
		dbquery("INSERT INTO estudiantes (usuario, contrasena, correo, nombre, foto, telefono, aboutme) VALUES ('" . $reg_username . "', '" . $reg_password . "', '" . $reg_email . "', '" . $reg_username . "', 'http://i.imgur.com/jFUbUdc.jpg', '', 'Bienvenid@ a Iluminame');");
		$_SESSION['UBER_USER_E'] = $reg_username;
		$_SESSION['UBER_USER_H'] = $core->UberHash($reg_password);

		header("Location: " . WWW . "/security_check.php");
	}
	else {
		echo 'registro invalido';
	}

}
?>

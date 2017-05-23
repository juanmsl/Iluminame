<?php
define('PAGE_ID', "index");
require_once "global.php";

if (LOGGED_IN)
{
	header("Location: " . WWW . "/home.php");
	exit;
}

$login_result = "";
$login_username = "";
$first_load = true;

if (isset($_POST['login_username']) && isset($_POST['login_password']))
{
	$first_load = false;
	$login_username = $_POST['login_username'];
	$credUser = filter($_POST['login_username']);
	$credPass = filter($_POST['login_password']);

	if ($credUser != $login_username)
	{
		$credUser = "";
	}

	if (strlen($credUser) < 1)
	{
		$login_result = "Por favor ingresa un usuario valido";
	}
	elseif (strlen($credPass) < 1)
	{
		$login_result = "Por favor ingresa una contraseña valida";
	}
	else
	{
		if ($users->ValidateUser($credUser, $core->UberHash($credPass)))
		{
			$_SESSION['UBER_USER_E'] = $credUser;
			$_SESSION['UBER_USER_H'] = $core->UberHash($credPass);
			$_SESSION['set_cookies'] = isset($_POST['remember_me']) && $_POST['remember_me'] === true;
			header("Location: " . WWW . "/security_check.php");
			exit;
		}
		else
		{
			$login_result = "El usuario o la contraseña no es correcto";
		}
	}
}

if (isset($_GET["forgot"]) && $_GET["forgot"] == true)
{
	$login_result = "Tu nueva contraseña ha sido enviada a tu correo";
}
if (isset($_GET["forgoterror"]) && $_GET["forgoterror"] == true)
{
	$login_result = "El correo ingresado no tiene una cuenta asociada";
}

include ('php/index_content.php');

if($first_load) {
	echo "<script>initFormById('initial-form', 'login-form', true);</script>";
} else {
	echo "<script>initFormById('initial-form', 'login-form', false);</script>";
}
?>

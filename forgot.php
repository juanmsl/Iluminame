<?php
require_once "global.php";

if (LOGGED_IN)
{
	header("Location: " . WWW . "/home.php");
	exit;
}

function generatePassword()
{
	$data = "";
	for ($i=1; $i<=6; $i++){
		$data = $data . chr(rand(97,122));
	}
	return $data;
}

if (isset($_POST['forgot_email']))
{
	$forgot_email = $_POST['forgot_email'];
	$register_password_conf = $_POST['register_password_conf'];

	$email = filter($forgot_email);

	$result = dbquery("SELECT id, nombre, correo FROM estudiantes WHERE correo LIKE '" . $email . "'");
  if (mysqli_num_rows($result) > 0)
  {
    $result = $result->fetch_assoc();

		$password = generatePassword();

		dbquery("UPDATE estudiantes SET contrasena = '" . $core->UberHash($password) . "' WHERE id = " . $result["id"]);

    sendRecuperationEmail(clean($result["nombre"]), clean($result["correo"]), clean($password));
		header("Location: /index.php?forgot=true");
  } else {
    header("Location: /index.php?forgoterror=true");
  }


}
?>

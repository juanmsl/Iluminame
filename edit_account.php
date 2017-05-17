<?php

require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

if(isset($_POST['name']) &&
	isset($_POST['username']) &&
	isset($_POST['email']) &&
	isset($_POST['phone_number']) &&
	isset($_POST['aboutme'])) {

	$name = filter($_POST['name']);
	$username = filter($_POST['username']);
	$email = filter($_POST['email']);
	$phone_number = filter($_POST['phone_number']);
	$aboutme = filter($_POST['aboutme']);

	$isValidEmail = $users->IsValidEmail($email) && $email == $_POST['email'];
	$isValidUser = $users->IsValidName($username) && $username == $_POST['username'];

	$update_query = "UPDATE estudiantes SET nombre = '" . $name . "', telefono = '" . $phone_number . "', aboutme = '" .$aboutme . "'";

	if($isValidEmail && $isValidUser) {
		if($email != $myrow["correo"] && !$users->IsEmailTaken($email)) {
			$update_query .= ', correo = "' . $email . '" ';
		} else if($email != $myrow["correo"]) {
			$_SESSION['configuration_result'] = "Este correo ya esta registrado en el sistema";
			$_SESSION['emoji'] = 'sad';
			header("Location: " . WWW . "/configuration.php");
			exit;
		}
		if($username != $myrow["usuario"] && !$users->IsNameTaken($username)) {
			$update_query .= ', usuario = "' . $username . '" ';
			$_SESSION['UBER_USER_E'] = $username;
		} else if($username != $myrow["usuario"]) {
			$_SESSION['configuration_result'] = "Este usuario ya esta registrado en el sistema";
			$_SESSION['emoji'] = 'sad';
			header("Location: " . WWW . "/configuration.php");
			exit;
		}
		if($_FILES['photo']['error'] == 0) {
			function getExtension($mime) {
				$extensions = array("image/jpeg" => "jpg", "image/png" => "png", "image/gif" => "gif");
				if (array_key_exists($mime, $extensions)) {
					return $extensions[$mime];
				} else {
					return null;
				}
			}

			$extension = getExtension($_FILES["photo"]["type"]);
			if ($extension == null) {
				$_SESSION['configuration_result'] = "Esta imagen no es un formato valido";
				$_SESSION['emoji'] = 'sad';
				header("Location: " . WWW . "/configuration.php");
				exit;
			}

			$temp_file = $_FILES["photo"]["tmp_name"];
			$check = getimagesize($temp_file);

			if ($check !== false) {
				//echo "File is an image - " . $check["mime"] . ".";
				$extension = getExtension($check["mime"]);
				if ($extension == null) {
					$_SESSION['configuration_result'] = "Suba una imagen valida, el archivo cargado no es una imagen";
					$_SESSION['emoji'] = 'sad';
					header("Location: " . WWW . "/configuration.php");
					exit;
				}
				$target_name = "user_pictures/" . USER_ID . "-" . $myrow["usuario"] . "." . $extension;

				if ($_FILES["photo"]["size"] > 5000000) {
					$_SESSION['configuration_result'] = "El tamaño de la imagen no debe exceder los 5 MB";
					$_SESSION['emoji'] = 'sad';
					header("Location: " . WWW . "/configuration.php");
					exit;
				}
				if (move_uploaded_file($temp_file, $target_name)) {
					echo "The file " . $target_name . " has been uploaded.";
					$update_query .= ', foto = "https://iluminame.co/' . $target_name . '"';
				} else {
					$_SESSION['configuration_result'] = "Hubo un error al subir la imagen, intentalo nuevamente";
					$_SESSION['emoji'] = 'sad';
					header("Location: " . WWW . "/configuration.php");
				}
			} else {
				$_SESSION['configuration_result'] = "Suba una imagen valida, el archivo cargado no es una imagen";
				$_SESSION['emoji'] = 'sad';
				header("Location: " . WWW . "/configuration.php");
				exit;
			}
		}
	}

	$update_query .= ' WHERE id = ' . USER_ID . ';';
	dbquery($update_query);

	$_SESSION['configuration_result'] = "Se ha editado la cuenta correctamente";
	$_SESSION['emoji'] = 'happy';
	header("Location: " . WWW . "/configuration.php");
	exit;
}

?>

<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

$search_result = $myrow;
if (isset($_GET["id"]))
{
	$user_id = filter($_GET["id"]);
	if ($user_id != $_GET["id"])
	{
		header("Location: " . WWW . "/logout.php");
		exit;
	}
	$user_id = intval($user_id);
	$user_query = dbquery("SELECT nombre, usuario, foto, aboutme, (SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = '" . $user_id . "') as seguidos, (SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguido = '" . $user_id . "') as seguidores FROM estudiantes WHERE id = '" . $user_id . "'");
	if ($user_query->num_rows == 1)
	{
		$search_result = $user_query->fetch_assoc();
	}
}
if (isset($_GET["user"]))
{
	$user_name = filter($_GET["user"]);
	if ($user_name != $_GET["user"])
	{
		header("Location: " . WWW . "/logout.php");
		exit;
	}
	$user_query = dbquery("SELECT nombre, usuario, foto, aboutme, (SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = COALESCE((SELECT id FROM estudiantes WHERE usuario LIKE '" . $user_name . "'), 0)) as seguidos, (SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguido = COALESCE((SELECT id FROM estudiantes WHERE usuario LIKE '" . $user_name . "'), 0)) as seguidores FROM estudiantes WHERE usuario LIKE '" . $user_name . "'");
	if ($user_query->num_rows == 1)
	{
		$search_result = $user_query->fetch_assoc();
	}
}

include ('php/profile_content.php');
?>

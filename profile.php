<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

$search_result = $myrow;
$final_query = "";
$user_query = false;
if (isset($_GET["id"])) {
	$user_query = true;
	$user_id = filter($_GET["id"]);
	if ($user_id != $_GET["id"]) {
		header("Location: " . WWW . "/logout.php");
		exit;
	}
	$user_id = intval($user_id);
	$final_query = "id = '" . $user_id . "'";
}
elseif (isset($_GET["user"])) {
	$user_query = true;
	$user_name = filter($_GET["user"]);
	if ($user_name != $_GET["user"]) {
		header("Location: " . WWW . "/logout.php");
		exit;
	}
	$final_query = "usuario = '" . $user_name . "'";
}

if($user_query) {
	$user_query = dbquery("SELECT id, nombre, usuario, foto, aboutme,
		(SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = id) as seguidos,
		(SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguido = id) as seguidores,
		(SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = '" . USER_ID . "' and estudiante_id_seguido = id) as isFollow,
        (SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguido = '" . USER_ID . "' and estudiante_id_seguidor = id) as isFollowMe
		FROM estudiantes WHERE " . $final_query);

	if ($user_query->num_rows == 1) {
		$search_result = $user_query->fetch_assoc();
		$follow_button_class = 'follow';
		$follow_button_text = 'Seguir';
		$isMyProfile = $search_result["id"] == USER_ID;
		$isFollowMe = $search_result["isFollowMe"] == 1;
		$extra = '?id=' . clean($search_result["id"]);
		if($search_result["isFollow"] == '1') {
			$follow_button_class = 'unfollow';
			$follow_button_text = 'Dejar de seguir';
		}
		include ('php/profile_content.php');
	} else {
		include ('php/notFound_content.php');
	}
}
else {
	$isMyProfile = true;
	$extra = '';
	include ('php/profile_content.php');
}

?>

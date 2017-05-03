<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

$id_user = '';
if (isset($_GET["id"])) {
	$user_id = filter($_GET["id"]);
	if ($user_id != $_GET["id"]) {
		header("Location: " . WWW . "/logout.php");
		exit;
	}
	$user_id = intval($user_id);
	$id_user = $user_id;
} else {
	$id_user = USER_ID;
}

$items_query = dbquery("SELECT estudiantes.id, estudiantes.foto, estudiantes.nombre, estudiantes.usuario,
	(SELECT COUNT(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = estudiantes.id AND estudiante_id_seguido = " . USER_ID . ") as isFollowMe,
	(SELECT COUNT(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = '" . USER_ID . "' AND estudiante_id_seguido = id) as isFollow
	FROM estudiantes, estudiantes_seguidores
	WHERE estudiantes_seguidores.estudiante_id_seguido = estudiantes.id AND
	estudiantes_seguidores.estudiante_id_seguidor = " . $id_user . "
	order by nombre;");

$items_available = $items_query->num_rows;

if ($items_available > 0)
{
	include ('php/users_content.php');

	while ($item = $items_query->fetch_assoc())
	{
		echo "<script>
			addUserUI({
				link: 'profile.php?user=" . clean($item["usuario"]) . "',
				picture: '" . clean($item["foto"]) . "',
				name: '" . clean($item["nombre"]) . "',
				user: '" . clean($item["usuario"]) . "',
				user_id: '" . clean($item["id"]) . "',
				isFollowMe: '" . clean($item["isFollowMe"]) . "',
				isFollow: '" . clean($item["isFollow"]) . "',
				isMe: '" . (clean($item["id"]) == USER_ID) . "'
			});
		</script>";
	}
} else {
	$object_not_found = 'Usuario';
	include ('php/notFound_content.php');
}
?>

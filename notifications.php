<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

include ('php/notifications_content.php');

/*$ntfs = dbquery("SELECT notificaciones.descripcion, notificaciones.id, notificaciones.fecha, notificaciones.fecha, notificaciones.vista, notificaciones.estudiante_id_recibe, notificaciones.estudiante_id_envia, estudiantes.nombre, estudiantes.foto, estudiantes.usuario
	FROM notificaciones JOIN estudiantes ON (notificaciones.estudiante_id_envia = estudiantes.id)
	WHERE notificaciones.vista = '0' AND notificaciones.estudiante_id_recibe = " . USER_ID . "
	ORDER BY fecha DESC;");

$ntfs_available = $ntfs->num_rows;
$group_date = array();
if ($ntfs_available > 0)
{
	while ($ntf = $ntfs->fetch_assoc())
	{
		$notifications .= "<script>
			addNotification({
				notification_link: 'profile.php?user=" . clean($ntf["usuario"]) . "',
				notification_date: '" . strftime("%d de %B del %Y, %I:%M %p", $ntf["fecha"]) . "',
				user_picture: '" . clean($ntf["foto"]) . "',
				notification_description: '" . clean($ntf["descripcion"]) . "'
			});
		</script>";
	}
}*/
?>

<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

include ('php/notifications_content.php');

$ntfs = dbquery("SELECT notificaciones.descripcion, notificaciones.fecha, notificaciones.vista,
	estudiantes.foto, estudiantes.usuario
	FROM notificaciones JOIN estudiantes ON (notificaciones.estudiante_id_envia = estudiantes.id)
	WHERE notificaciones.estudiante_id_recibe = " . USER_ID . "
	ORDER BY fecha DESC;");

$ntfs_available = $ntfs->num_rows;
$group_date = array();
$id_current_group = 0;
if ($ntfs_available > 0)
{
	while ($ntf = $ntfs->fetch_assoc())
	{
		$date = strftime("%d de %B del %Y", $ntf["fecha"]);
		if(!in_array($date,$group_date)) {
			$group_date[] = $date;
			$id_current_group = count($group_date);
			echo "<script> createGroupNotifications('#notifications-group', {date: '" . $date . "', id: '" . $id_current_group . "'}); </script>";
		}
		echo "<script>
			addNotificationToGroup({
				link: 'profile.php?user=" . clean($ntf["usuario"]) . "',
				hour: '" . strftime("%I:%M %p", $ntf["fecha"]) . "',
				picture: '" . clean($ntf["foto"]) . "',
				viewed: " . ($ntf["vista"] == '1' ? 'true' : 'false') . ",
				description: '" . $ntf["descripcion"] . "'
			}, '#" . $id_current_group . "');
		</script>";
	}
}
?>

<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

include ('php/home_content.php');

if (isset($search)) {
	$items_query = dbquery("SELECT
		monitorias.id as monitoria_id, monitorias.fecha_inicio, monitorias.fecha_fin, monitorias.lugar, monitorias.estudiante_id, monitorias.materia_id, monitorias.es_publica,
		estudiantes.nombre as estudiante_nombre, estudiantes.usuario, estudiantes.foto,
		materias.nombre as materia_nombre,
		estudiantes_materias.costo_h_public, estudiantes_materias.max_estud,
		(SELECT count(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = (monitorias.id) AND estudiante_id = " . USER_ID . ") as inscrito,
		(SELECT count(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = (monitorias.id)) as monitoria_inscripciones
		FROM monitorias
		JOIN estudiantes ON (estudiantes.id = monitorias.estudiante_id)
		JOIN materias ON (materias.id = monitorias.materia_id)
		JOIN estudiantes_materias ON (estudiantes_materias.materia_id = monitorias.materia_id AND estudiantes_materias.estudiante_id = monitorias.estudiante_id)
		WHERE monitorias.estudiante_id IN (SELECT estudiantes_seguidores.estudiante_id_seguido FROM estudiantes_seguidores)
		AND (materias.nombre LIKE '%" . $search . "%')
		ORDER BY fecha_inicio DESC;");

	$users_query = dbquery("SELECT estudiantes.foto, estudiantes.nombre, estudiantes.usuario,
		(SELECT COUNT(*) FROM estudiantes_seguidores WHERE estudiantes_seguidores.estudiante_id_seguidor = estudiantes.id AND estudiantes_seguidores.estudiante_id_seguido = " . USER_ID . ") as isFollow
		FROM estudiantes
		WHERE estudiantes.nombre LIKE '%" . $search . "%' OR estudiantes.usuario LIKE '%" . $search . "%'
		ORDER BY nombre;");
} else {
	$items_query = dbquery("SELECT
		monitorias.id as monitoria_id, monitorias.fecha_inicio, monitorias.fecha_fin, monitorias.lugar, monitorias.estudiante_id, monitorias.materia_id, monitorias.es_publica,
		estudiantes.nombre as estudiante_nombre, estudiantes.usuario, estudiantes.foto,
		materias.nombre as materia_nombre,
		estudiantes_materias.costo_h_public, estudiantes_materias.max_estud,
		(SELECT count(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = (monitorias.id) AND estudiante_id = " . USER_ID . ") as inscrito,
		(SELECT count(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = (monitorias.id)) as monitoria_inscripciones
		FROM monitorias
		JOIN estudiantes ON (estudiantes.id = monitorias.estudiante_id)
		JOIN materias ON (materias.id = monitorias.materia_id)
		JOIN estudiantes_materias ON (estudiantes_materias.materia_id = monitorias.materia_id AND estudiantes_materias.estudiante_id = monitorias.estudiante_id)
		WHERE monitorias.estudiante_id IN (SELECT estudiantes_seguidores.estudiante_id_seguido FROM estudiantes_seguidores WHERE estudiante_id_seguidor = " . USER_ID . ")
		ORDER BY fecha_inicio DESC;");
}

$items_available = $items_query->num_rows;
if ($items_available > 0)
{
	while ($item = $items_query->fetch_assoc())
	{
		echo "<script>
			addHomeMonitorie({
				link: '#',
				id: '" . clean($item["monitoria_id"]) . "',
				user_link: 'profile.php?user=" . clean($item["usuario"]) . "',
				user_picture: '" . clean($item["foto"]) . "',
				subject_name: '" . clean($item["materia_nombre"]) . "',
				user_name: '" . clean($item["estudiante_nombre"]) . "',
				place: '" . clean($item["lugar"]) . "',
				date: '" . strftime("%d de %B del %Y", $item["fecha_inicio"]) . "',
				time: '" . strftime("%I:%M %p", $item["fecha_inicio"]) . " - " . strftime("%I:%M %p", $item["fecha_fin"]) . "',
				price: '" . easyNumber(clean($item["costo_h_public"])) . "',
				inscriptions: '" . clean($item["monitoria_inscripciones"]) . "',
				type: '" . (clean($item["es_publica"]) == '0'? false : true ) . "',
				is_signed: " . clean($item["inscrito"]) . ",
				maximun: '" . clean($item["max_estud"]) . "'
			});
		</script>";
	}
}

if(isset($search)) {
	$users = $users_query->num_rows;
	if ($users > 0)
	{
		while ($user = $users_query->fetch_assoc())
		{
			echo "<script>
				addUserSearch({
					link: 'profile.php?user=" . clean($user["usuario"]) . "',
					picture: '" . clean($user["foto"]) . "',
					name: '" . clean($user["nombre"]) . "',
					user: '" . clean($user["usuario"]) . "',
					isFollow: '" . (clean($user["isFollow"]) == 1 ? 'Te sigue' : '') . "'
				});
			</script>";
		}
	}
}
?>

<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

include ('php/home_content.php');

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
ORDER BY monitoria_id;");

$items_available = $items_query->num_rows;
if ($items_available > 0)
{
	while ($item = $items_query->fetch_assoc())
	{
		echo "<script>
			addHomeMonitorie({
				monitorie_link: '#',
				monitorie_id: '" . clean($item["monitoria_id"]) . "',
				user_link: 'profile.php?user=" . clean($item["usuario"]) . "',
				user_picture: '" . clean($item["foto"]) . "',
				subject_name: '" . clean($item["materia_nombre"]) . "',
				user_name: '" . clean($item["estudiante_nombre"]) . "',
				monitorie_place: '" . clean($item["lugar"]) . "',
				monitorie_date: '" . strftime("%B %d de %Y", $item["fecha_inicio"]) . "',
				monitorie_time: '" . strftime("%I:%M%p", $item["fecha_inicio"]) . " - " . strftime("%I:%M%p", $item["fecha_fin"]) . "',
				monitorie_price: '" . easyNumber(clean($item["costo_h_public"])) . "',
				monitorie_inscriptions: '" . clean($item["monitoria_inscripciones"]) . "',
				monitorie_type: '" . (clean($item["es_publica"]) == '0'? false : true ) . "',
				monitorie_is_signed: " . clean($item["inscrito"]) . ",
				monitorie_maximun: '" . clean($item["max_estud"]) . "'
			});
		</script>";
	}
}
?>

<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

$follows_query = dbquery("SELECT count(*) as seguidos FROM estudiantes_seguidores WHERE estudiante_id_seguidor = " . USER_ID . ";")->fetch_assoc();
$have_follows = (clean($follows_query['seguidos']) != '0');
$search_monitoria = false;
$search_materia = false;
$search_usuario = false;
$welcome = !$have_follows && !isset($_GET['search']);
$home_query = !$welcome;

if (isset($_GET['search'])) {
	$search_monitoria = ($_GET['type'] == 'Monitoria');
	$search_materia = ($_GET['type'] == 'Materia');
	$search_usuario = ($_GET['type'] == 'Usuario');
	$home_query = !($search_monitoria || $search_materia || $search_usuario);
}

if($search_monitoria) {
	$query = dbquery("SELECT
		monitorias.id as monitoria_id, monitorias.fecha_inicio, monitorias.fecha_fin, monitorias.lugar, monitorias.estudiante_id, monitorias.materia_id, monitorias.es_publica,
		estudiantes.nombre as estudiante_nombre, estudiantes.id as monitor_id, estudiantes.usuario, estudiantes.foto,
		materias.nombre as materia_nombre,
		estudiantes_materias.costo_h_public, estudiantes_materias.max_estud,
		(SELECT count(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = (monitorias.id) AND estudiante_id = " . USER_ID . ") as inscrito,
		(SELECT count(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = (monitorias.id)) as monitoria_inscripciones
		FROM monitorias
		JOIN estudiantes ON (estudiantes.id = monitorias.estudiante_id)
		JOIN materias ON (materias.id = monitorias.materia_id)
		JOIN estudiantes_materias ON (estudiantes_materias.materia_id = monitorias.materia_id AND estudiantes_materias.estudiante_id = monitorias.estudiante_id)
		WHERE monitorias.estudiante_id IN (SELECT estudiantes_seguidores.estudiante_id_seguido FROM estudiantes_seguidores)
		AND (materias.nombre LIKE '%" . $_GET['search'] . "%') AND monitorias.fecha_inicio > " . time() . "
		ORDER BY fecha_inicio DESC;");
} else if($search_materia) {
	$query = dbquery("SELECT
			estudiantes.id,
			estudiantes.foto,
			estudiantes.usuario,
			estudiantes.nombre as nombre_estu,
			estudiantes_materias.materia_id,
			materias.nombre,
			estudiantes_materias.descripcion,
			estudiantes_materias.costo_h_priv,
			estudiantes_materias.costo_h_public,
			estudiantes_materias.max_estud,
			IFNULL((SELECT AVG(calificacion) FROM comentarios WHERE comentarios.monitoria_id = monitorias.id),0) as promedio
			FROM estudiantes_materias JOIN monitorias
				ON (monitorias.materia_id = estudiantes_materias.materia_id AND monitorias.estudiante_id = estudiantes_materias.estudiante_id) JOIN materias
				ON (materias.id = estudiantes_materias.materia_id) JOIN estudiantes
				ON (estudiantes_materias.estudiante_id = estudiantes.id)
			WHERE materias.nombre like '%" . $_GET['search'] . "%'
			ORDER BY promedio DESC;");
} else if($search_usuario) {
	$query = dbquery("SELECT estudiantes.id, estudiantes.foto, estudiantes.nombre, estudiantes.usuario,
		(SELECT COUNT(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = estudiantes.id AND estudiante_id_seguido = " . USER_ID . ") as isFollowMe,
		(SELECT COUNT(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = '" . USER_ID . "' AND estudiante_id_seguido = id) as isFollow
		FROM estudiantes
		WHERE estudiantes.nombre LIKE '%" . $_GET['search'] . "%' OR estudiantes.usuario LIKE '%" . $_GET['search'] . "%'
		ORDER BY nombre;");
} elseif($home_query) {
	$query = dbquery("SELECT
			monitorias.id as monitoria_id, monitorias.fecha_inicio, monitorias.fecha_fin, monitorias.lugar, monitorias.es_publica, monitorias.estudiante_id as monitor_id,
			estudiantes.nombre as estudiante_nombre, estudiantes.foto,
			materias.nombre as materia_nombre,
			estudiantes_materias.costo_h_priv, estudiantes_materias.costo_h_public, estudiantes_materias.max_estud,
			(SELECT COUNT(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = monitorias.id) as monitoria_inscripciones,
			(SELECT COUNT(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = monitorias.id AND estudiante_id = " . USER_ID . ") as inscrito
			FROM monitorias JOIN estudiantes ON (monitorias.estudiante_id  = estudiantes.id) JOIN materias
			ON (materias.id = monitorias.materia_id) JOIN estudiantes_materias
			ON (estudiantes_materias.estudiante_id = estudiantes.id AND estudiantes_materias.materia_id = materias.id)
			WHERE monitorias.estudiante_id IN (SELECT estudiantes_seguidores.estudiante_id_seguido FROM estudiantes_seguidores WHERE estudiante_id_seguidor = " . USER_ID . ")
			ORDER BY fecha_inicio DESC;");
}

if(isset($query)) {
	$query_results = $query->num_rows;
}
include ('php/home_content.php');

if ($search_monitoria || $home_query) {
	if($query_results > 0) {
		echo "<script>$('#home-monitories').removeClass('box-grow');</script>";
		while ($item = $query->fetch_assoc()) {
			echo "<script>
			addMonitorieTo({
				isMe: '" . (clean($item["monitor_id"]) == USER_ID) . "',
				link: 'tutorie.php?id=" . clean($item["monitoria_id"]) . "',
				id: '" . clean($item["monitoria_id"]) . "',
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
				card: 'card',
				disabled: " . ($item["fecha_inicio"] < time() ? 1 : 0) . ",
				maximun: '" . clean($item["max_estud"]) . "'
			}, '#home-monitories');
			</script>";
		}
	}
}

if($search_materia) {
	if ($query_results > 0) {
		echo "<script>$('#subjects-search').removeClass('box-grow');</script>";
		while ($subject = $query->fetch_assoc()) {
			echo "<script>
					addSubjectTo({
						user_link: 'profile.php?user=" . clean($subject["usuario"]) . "',
						subject_link: 'subjects.php?id=" . clean($subject["materia_id"]) . "&user=" . clean($subject["id"]) . "',
						user_picture: '" . clean($subject["foto"]) . "',
						user_name: '" . clean($subject["nombre_estu"]) . "',
						user_id: '" . clean($subject["id"]) . "',
						subject_id: '" . clean($subject["materia_id"]) . "',
						subject_name: '" . clean($subject["nombre"]) . "',
						description: '" . clean($subject["descripcion"]) . "',
						cost_pr: '" . easyNumber(clean($subject["costo_h_priv"])) . "',
						cost_pb: '" . easyNumber(clean($subject["costo_h_public"])) . "',
						max: '" . clean($subject["max_estud"]) . "',
						rating_value: '" . clean($subject["promedio"]) . "',
						card: 'card'
					}, '#subjects-search');
				</script>";
		}
	}
}

if($search_usuario) {
	if ($query_results > 0) {
		echo "<script>$('#users-search').removeClass('box-grow');</script>";
		while ($user = $query->fetch_assoc()) {
			echo "<script>
				addUserTo({
					link: 'profile.php?user=" . clean($user["usuario"]) . "',
					picture: '" . clean($user["foto"]) . "',
					name: '" . clean($user["nombre"]) . "',
					user: '" . clean($user["usuario"]) . "',
					user_id: '" . clean($user["id"]) . "',
					isFollowMe: '" . clean($user["isFollowMe"]) . "',
					isFollow: '" . clean($user["isFollow"]) . "',
					isMe: '" . (clean($user["id"]) == USER_ID) . "'
				}, '#users-search');
			</script>";
		}
	}
}
?>

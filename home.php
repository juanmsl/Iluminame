<?php
require_once "global.php";

if (!LOGGED_IN) {
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
$query_results = 0;

if (isset($_GET['search'])) {
	$type = filter($_GET['type']);
	$search = filter($_GET['search']);
	$search_monitoria = ($type == 'Monitoria');
	$search_materia = ($type == 'Materia');
	$search_usuario = ($type == 'Usuario');
	$home_query = !($search_monitoria || $search_materia || $search_usuario);
}

if($search_monitoria) {
	$query = monitorie_query("WHERE monitorias.estudiante_id IN (SELECT estudiantes_seguidores.estudiante_id_seguido FROM estudiantes_seguidores) AND (materias.nombre LIKE '%" . $search . "%' OR estudiantes.nombre LIKE '%" . $search . "%' OR estudiantes.usuario LIKE '%" . $search . "%') AND monitorias.fecha_inicio > " . time());
	$query_results = $query->num_rows;
} else if($search_materia) {
	$query = subjects_query("WHERE materias.nombre like '%" . $search . "%' OR estudiantes.nombre LIKE '%" . $search . "%' OR estudiantes.usuario LIKE '%" . $search . "%'");
	$query_results = $query->num_rows;
} else if($search_usuario) {
	$query = dbquery("SELECT estudiantes.id, estudiantes.foto, estudiantes.nombre, estudiantes.usuario,
		(SELECT COUNT(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = estudiantes.id AND estudiante_id_seguido = " . USER_ID . ") as isFollowMe,
		(SELECT COUNT(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = '" . USER_ID . "' AND estudiante_id_seguido = id) as isFollow
		FROM estudiantes
		WHERE estudiantes.nombre LIKE '%" . $search . "%' OR estudiantes.usuario LIKE '%" . $search . "%'
		ORDER BY nombre;");
		$query_results = $query->num_rows;
} else if($home_query) {
	$query = monitorie_query("WHERE monitorias.estudiante_id IN (SELECT estudiantes_seguidores.estudiante_id_seguido FROM estudiantes_seguidores WHERE estudiante_id_seguidor = " . USER_ID . ")");
	$query_results = $query->num_rows;
}

include ('php/home_content.php');

if ($search_monitoria || $home_query) {
	echo "<script>$('#home-monitories').removeClass('box-grow');</script>";
	while ($item = $query->fetch_assoc()) {
		addMonitorieTo($item, '#home-monitories', 'card', false);
	}
} else if($search_materia) {
	echo "<script>$('#subjects-search').removeClass('box-grow');</script>";
	while ($subject = $query->fetch_assoc()) {
		addSubjectTo($subject, '#subjects-search', 'card');
	}
} else if($search_usuario) {
	echo "<script>$('#users-search').removeClass('box-grow');</script>";
	while ($user = $query->fetch_assoc()) {
		addUserTo($user, '#users-search');
	}
}
?>

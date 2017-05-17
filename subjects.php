<?php
require_once "global.php";

if (!LOGGED_IN) {
	header("Location: " . WWW . "/");
	exit;
}

$my_subjects = true;

if (isset($_GET["id"]) && isset($_GET["user"])) {
	$id = filter($_GET["id"]);
	$user_id = filter($_GET["user"]);

	if ($id != $_GET["id"] || $user_id != $_GET["user"]) {
		header("Location: " . WWW . "/subjects.php");
		exit;
	}

	$my_subjects = false;

	$subjects_query = subjects_query("WHERE estudiantes_materias.materia_id = " . $id . " and estudiantes_materias.estudiante_id = " . $user_id);

	if($subjects_query->num_rows == 1) {
		$subjects_query = $subjects_query->fetch_assoc();
		$subject_monitories = monitorie_query("WHERE estudiantes.id = " . $user_id . " AND materias.id = " . $id);

		$usuario = clean($subjects_query['usuario']);
		$foto = clean($subjects_query['foto']);
		$materia = clean($subjects_query['nombre']);
		$monitor = clean($subjects_query['nombre_estu']);
		$costo_pr = '$ ' . easyNumber(clean($subjects_query['costo_h_priv']));
		$costo_pb = '$ ' . easyNumber(clean($subjects_query['costo_h_public']));
		$is_my_subject = (clean($subjects_query['id']) == USER_ID);
		$descripcion = clean($subjects_query["descripcion"]);
		$calificacion = clean($subjects_query["promedio"]);
		$button_function = '';

		include ('php/subjects_content.php');

		echo "<script> addRatingTo('subject-rating', " . $calificacion . ", '#subject-rating'); </script>";

		while($monitorie = $subject_monitories->fetch_assoc()) {
			$container = (($monitorie["fecha_inicio"] > time()) ? '#active-monitories' : '#past-monitories' );
			addMonitorieTo($monitorie, $container, 'card', true);
		}
	} else {
		$object_not_found = 'Materia no encontrada';
		include ('php/notFound_content.php');
	}
} else {
	include ('php/subjects_content.php');

	$subjects_query = subjects_query("WHERE estudiantes_materias.estudiante_id = " . USER_ID);
	while($subject = $subjects_query->fetch_assoc()) {
		addSubjectTo($subject, '#subjects-group', 'card');
	}
}
?>

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
		$button_function = "onclick=\"createSolicitud({
			modal_id: 'solicitud_" . clean($subjects_query["materia_id"]) . "_" . clean($subjects_query["id"]) . "',
			user_link: 'profile.php?user=" . $usuario . "',
			user_name: '" .  clean($subjects_query["nombre_estu"]) . "',
			user_picture: '" . $foto . "',
			subject_link: 'subjects.php?id=" . clean($subjects_query["materia_id"]) . "&user=" . clean($subjects_query["id"]) . "',
			subject_name: '" . $materia . "',
			rating_value: " . $calificacion . ",
			description: '" . $descripcion . "',
			cost_pr: '" . clean($subjects_query['costo_h_priv']) . "',
			cost_pb: '" . clean($subjects_query['costo_h_public']) . "',
			user_id: '" . clean($subjects_query["id"]) . "',
			subject_id: '" . clean($subjects_query["materia_id"]) . "',
			max: " . clean($subjects_query["max_estud"]) . "
		})\"";

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
	$new_subjects_query = dbquery("SELECT
		materias.id, materias.nombre
		FROM materias
		WHERE materias.id
			NOT IN (SELECT materias.id
				FROM materias JOIN estudiantes_materias ON (materias.id = estudiantes_materias.materia_id)
				WHERE estudiantes_materias.estudiante_id = " . USER_ID . ");");
	$new_subjects = '';

	while($sbj = $new_subjects_query->fetch_assoc()) {
		$new_subjects .= "<option value='" . clean($sbj['id']) . "'>" . clean($sbj['nombre']) . "</option>";
	}

	include ('php/subjects_content.php');

	$subjects_query = subjects_query("WHERE estudiantes_materias.estudiante_id = " . USER_ID);

	while($subject = $subjects_query->fetch_assoc()) {
		addSubjectTo($subject, '#subjects-group', 'card');
	}
}
?>

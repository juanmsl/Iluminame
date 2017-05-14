<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

$my_subjects = true;
if (isset($_GET["id"]) && isset($_GET["user"])) {
	$id = filter($_GET["id"]);
	if ($id != $_GET["id"]) {
		header("Location: " . WWW . "/logout.php");
		exit;
	}

	$user_id = filter($_GET["user"]);
	if ($user_id != $_GET["user"]) {
		header("Location: " . WWW . "/logout.php");
		exit;
	}

	$my_subjects = false;

	$subjects_query = dbquery("SELECT
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
		IFNULL((SELECT AVG(calificacion) FROM comentarios JOIN monitorias ON (comentarios.monitoria_id = monitorias.id) WHERE monitorias.estudiante_id = estudiantes.id AND monitorias.materia_id = materias.id),0) as promedio
			FROM estudiantes_materias JOIN materias
				ON (materias.id = estudiantes_materias.materia_id) JOIN estudiantes
				ON (estudiantes_materias.estudiante_id = estudiantes.id)
			WHERE estudiantes_materias.materia_id = " . $id . " and estudiantes_materias.estudiante_id = " . $user_id . "
			ORDER BY promedio DESC");

	if($subjects_query->num_rows == 1) {
		$subjects_query = $subjects_query->fetch_assoc();
		$subject_monitories = dbquery("SELECT
			monitorias.id as monitoria_id, monitorias.fecha_inicio, monitorias.fecha_fin, monitorias.lugar, monitorias.es_publica, monitorias.estudiante_id as monitor_id,
			estudiantes.nombre as estudiante_nombre, estudiantes.foto,
			materias.nombre as materia_nombre,
			estudiantes_materias.costo_h_priv, estudiantes_materias.costo_h_public, estudiantes_materias.max_estud,
			(SELECT COUNT(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = monitorias.id) as monitoria_inscripciones,
			(SELECT COUNT(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = monitorias.id AND estudiante_id = " . USER_ID . ") as inscrito,
			IFNULL((SELECT AVG(calificacion) FROM comentarios WHERE comentarios.monitoria_id = monitorias.id),0) as promedio
			FROM monitorias JOIN estudiantes ON (monitorias.estudiante_id  = estudiantes.id) JOIN materias
			ON (materias.id = monitorias.materia_id) JOIN estudiantes_materias
			ON (estudiantes_materias.estudiante_id = estudiantes.id AND estudiantes_materias.materia_id = materias.id)
			WHERE estudiantes.id = " . $user_id . " AND materias.id = " . $id . "
			ORDER BY fecha_inicio DESC;");

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
			echo "<script>console.log('" . $container . "');</script>";
			echo "<script>
				addMonitorieTo({
					isMe: '" . (clean($monitorie["monitor_id"]) == USER_ID) . "',
					link: 'tutories.php?id=" . clean($monitorie["monitoria_id"]) . "',
					id: '" . clean($monitorie["monitoria_id"]) . "',
					user_picture: '" . clean($monitorie["foto"]) . "',
					subject_name: '" . clean($monitorie["materia_nombre"]) . "',
					user_name: '" . clean($monitorie["estudiante_nombre"]) . "',
					place: '" . clean($monitorie["lugar"]) . "',
					date: '" . strftime("%d de %B del %Y", $monitorie["fecha_inicio"]) . "',
					time: '" . strftime("%I:%M %p", $monitorie["fecha_inicio"]) . " - " . strftime("%I:%M %p", $monitorie["fecha_fin"]) . "',
					price: '" . easyNumber(clean($monitorie["costo_h_public"])) . "',
					inscriptions: '" . clean($monitorie["monitoria_inscripciones"]) . "',
					is_public: '" . (clean($monitorie["es_publica"]) == '0'? false : true ) . "',
					is_signed: " . clean($monitorie["inscrito"]) . ",
					card: 'card',
					disabled: " . ($monitorie["fecha_inicio"] < time() ? 1 : 0) . ",
					maximun: '" . clean($monitorie["max_estud"]) . "',
					ignoreConditions: " . ($monitorie["fecha_inicio"] < time() ? 1 : 0) . "
				}, '" . $container . "');
			</script>";
		}
	} else {
		$object_not_found = 'Materia no encontrada';
		include ('php/notFound_content.php');
	}
} else {
	include ('php/subjects_content.php');

	$subjects_query = dbquery("SELECT
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
			WHERE estudiantes_materias.estudiante_id = " . USER_ID . "
			ORDER BY promedio DESC;");

	while($subject = $subjects_query->fetch_assoc()) {
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
					cost_pr: '" . clean($subject["costo_h_priv"]) . "',
					cost_pb: '" . clean($subject["costo_h_public"]) . "',
					max: '" . clean($subject["max_estud"]) . "',
					rating_value: '" . clean($subject["promedio"]) . "',
					card: 'card'
				}, '#subjects-group');
			</script>";
	}
}
?>

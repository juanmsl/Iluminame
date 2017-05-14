<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

$user_name = USER_NAME;

if (isset($_GET["user"])) {
	$user_name = filter($_GET["user"]);
	if ($user_name != $_GET["user"]) {
		header("Location: " . WWW . "/logout.php");
		exit;
	}
}

$user_query = dbquery("SELECT id, nombre, usuario, foto, aboutme,
	(SELECT COUNT(*) FROM estudiantes_materias WHERE estudiantes_materias.estudiante_id = estudiantes.id) as count_materias,
	(SELECT COUNT(*) FROM monitorias WHERE monitorias.estudiante_id = estudiantes.id) as count_monitorias_dictadas,
	(SELECT COUNT(DISTINCT estudiantes_monitorias_inscripciones.estudiante_id) FROM estudiantes_monitorias_inscripciones, monitorias WHERE estudiantes_monitorias_inscripciones.monitoria_id = monitorias.id AND monitorias.estudiante_id = estudiantes.id) as count_estudiantes,
	(SELECT COUNT(*) FROM estudiantes_monitorias_inscripciones WHERE estudiantes_monitorias_inscripciones.estudiante_id = estudiantes.id) as count_monitorias_asistidas,
	(SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = id) as seguidos,
	(SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguido = id) as seguidores,
	(SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = '" . USER_ID . "' and estudiante_id_seguido = id) as isFollow,
    (SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguido = '" . USER_ID . "' and estudiante_id_seguidor = id) as isFollowMe
	FROM estudiantes
	WHERE estudiantes.usuario = '" . $user_name . "';");

$monitorie_query = dbquery("SELECT
		monitorias.id as monitoria_id, monitorias.fecha_inicio, monitorias.fecha_fin, monitorias.lugar, monitorias.es_publica, monitorias.estudiante_id as monitor_id,
		estudiantes.nombre as estudiante_nombre, estudiantes.foto,
		materias.nombre as materia_nombre,
		estudiantes_materias.costo_h_priv, estudiantes_materias.costo_h_public, estudiantes_materias.max_estud,
		(SELECT COUNT(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = monitorias.id) as monitoria_inscripciones,
		(SELECT COUNT(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = monitorias.id AND estudiante_id = " . USER_ID . ") as inscrito
		FROM monitorias JOIN estudiantes ON (monitorias.estudiante_id  = estudiantes.id) JOIN materias
		ON (materias.id = monitorias.materia_id) JOIN estudiantes_materias
		ON (estudiantes_materias.estudiante_id = estudiantes.id AND estudiantes_materias.materia_id = materias.id)
		WHERE estudiantes.usuario = '" . $user_name . "' AND monitorias.es_publica AND fecha_inicio > " . time() . "
		ORDER BY fecha_inicio DESC;");

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
		WHERE estudiantes.usuario = '" . $user_name . "'
		ORDER BY promedio DESC;");

if ($user_query->num_rows == 1) {
	$search_result = $user_query->fetch_assoc();
	$follow_button_class = ($search_result["isFollow"] == '1') ? 'unfollow' : 'follow';
	$follow_button_text = ($search_result["isFollow"] == '1') ? 'Dejar de seguir' : 'Seguir';
	$isMyProfile = $search_result["id"] == USER_ID;
	$isFollowMe = $search_result["isFollowMe"] == 1;
	$extra = $isMyProfile ? '' : '?id=' . clean($search_result["id"]);

	$count_materias = $search_result["count_materias"];
	$count_monitorias_dictadas = $search_result["count_monitorias_dictadas"];
	$count_estudiantes = $search_result["count_estudiantes"];
	$count_monitorias_asistidas = $search_result["count_monitorias_asistidas"];

	$have_public_monitories = ($monitorie_query->num_rows > 0);
	$have_subjects = ($subjects_query->num_rows > 0);

	include ('php/profile_content.php');

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
					card: ''
				}, '#profile-subjects');
			</script>";
	}

	while($monitorie = $monitorie_query->fetch_assoc()) {
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
				card: '',
				disabled: " . ($monitorie["fecha_inicio"] < time() ? 1 : 0) . ",
				maximun: '" . clean($monitorie["max_estud"]) . "'
			}, '#profile-active-monitories');
		</script>";
	}

	echo "<script>
		$('#profile-subjects, #profile-active-monitories').owlCarousel({
			autoheight: true,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:2
				},
				1200:{
					items:3
				}
			}
		});
	</script>";

} else {
	$object_not_found = 'Usuario no encontrado';
	include ('php/notFound_content.php');
}
?>

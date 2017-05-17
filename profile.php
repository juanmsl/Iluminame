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
		header("Location: " . WWW . "/profile.php");
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

$monitorie_query = monitorie_query("WHERE estudiantes.usuario = '" . $user_name . "' AND monitorias.es_publica AND fecha_inicio > " . time());
$subjects_query = subjects_query("WHERE estudiantes.usuario = '" . $user_name . "'");

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
		addSubjectTo($subject, '#profile-subjects', '');
	}

	while($monitorie = $monitorie_query->fetch_assoc()) {
		addMonitorieTo($monitorie, '#profile-active-monitories', '', false);
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

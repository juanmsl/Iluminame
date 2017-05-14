<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

include ('php/my_tutories_content.php');

$monitories_query = dbquery("SELECT
	materias.nombre as materia_nombre,
	estudiantes.nombre as estudiante_nombre, estudiantes.foto,
	monitorias.id as monitoria_id, monitorias.fecha_inicio, monitorias.fecha_fin, monitorias.lugar, monitorias.es_publica, monitorias.estudiante_id as monitor_id,
	estudiantes_materias.costo_h_priv, estudiantes_materias.costo_h_public, estudiantes_materias.max_estud,
	(SELECT COUNT(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = monitorias.id) as monitoria_inscripciones,
	(SELECT COUNT(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = monitorias.id AND estudiante_id = " . USER_ID . ") as inscrito,
	IFNULL((SELECT AVG(calificacion) FROM comentarios WHERE comentarios.monitoria_id = monitorias.id),0) as promedio
	FROM estudiantes_monitorias_inscripciones JOIN monitorias
	ON (estudiantes_monitorias_inscripciones.monitoria_id = monitorias.id) JOIN estudiantes
	ON (estudiantes.id = monitorias.estudiante_id) JOIN materias on (materias.id = monitorias.materia_id) JOIN estudiantes_materias
	ON (estudiantes_materias.estudiante_id = estudiantes.id AND estudiantes_materias.materia_id = materias.id)
	WHERE estudiantes_monitorias_inscripciones.estudiante_id = " . USER_ID . "
	ORDER BY fecha_inicio DESC;");

while($monitorie = $monitories_query->fetch_assoc()) {
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

?>

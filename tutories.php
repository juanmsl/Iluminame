<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}


$my_tutories = true;
if (isset($_GET["id"])) {
	$id = filter($_GET["id"]);
	if ($id != $_GET["id"]) {
		header("Location: " . WWW . "/tutories.php");
		exit;
	}

	$my_tutories = false;

	$monitorie_query = monitorie_query("WHERE monitorias.id = " . $id);

	if($monitorie_query->num_rows == 1) {
		$monitorie_query = $monitorie_query->fetch_assoc();

		$monitoria_id = clean($monitorie_query["monitoria_id"]);
		$fecha = strftime("%d de %B del %Y", $monitorie_query["fecha_inicio"]);
		$duracion = strftime("%I:%M %p", $monitorie_query["fecha_inicio"]) . " - " . strftime("%I:%M %p", $monitorie_query["fecha_fin"]);
		$lugar = clean($monitorie_query["lugar"]);
		$es_publica = clean($monitorie_query["es_publica"]) == '1';
		$calificacion = clean($monitorie_query["promedio"]);

		$monitor_id = clean($monitorie_query["monitor_id"]);
		$monitor = clean($monitorie_query["estudiante_nombre"]);
		$usuario = clean($monitorie_query["usuario"]);
		$foto = clean($monitorie_query["foto"]);
		$is_my_monitorie = $monitor_id == USER_ID;

		$materia = clean($monitorie_query["materia_nombre"]);
		$descripcion = clean($monitorie_query["descripcion"]);
		$costo = easyNumber(($es_publica) ? clean($monitorie_query["costo_h_public"]) : clean($monitorie_query["costo_h_priv"]));
		$maximo = clean($monitorie_query["max_estud"]);

		$is_signed = $monitorie_query["inscrito"] == 1 ? true : false;
		$is_disabled = ($monitorie_query["fecha_inicio"] < time());

		if($es_publica || (!$es_publica && $monitorie_query["fecha_inicio"] < time()) || (!$es_publica && $is_signed) || $is_my_monitorie) {
			$user_query = dbquery("SELECT estudiantes.id, estudiantes.foto, estudiantes.nombre, estudiantes.usuario,
				(SELECT COUNT(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = estudiantes.id AND estudiante_id_seguido = " . USER_ID . ") as isFollowMe,
				(SELECT COUNT(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = " . USER_ID . " AND estudiante_id_seguido = estudiantes.id) as isFollow
				FROM estudiantes JOIN estudiantes_monitorias_inscripciones
				ON (estudiantes.id = estudiantes_monitorias_inscripciones.estudiante_id)
				WHERE estudiantes_monitorias_inscripciones.monitoria_id = " . $id . "
				ORDER BY nombre;");

			$comentary_query = dbquery("SELECT
				estudiantes.foto,
				estudiantes.nombre,
				comentarios.calificacion,
				comentarios.descripcion,
				comentarios.id
				FROM estudiantes JOIN comentarios ON (estudiantes.id = comentarios.estudiante_id)
				WHERE comentarios.monitoria_id = " . $id . ";");

			$inscritos = $user_query->num_rows;
			$button_class = (($is_signed && $es_publica) ? 'leave' : (($inscritos == $maximo || !$es_publica) ? 'full' : 'join'));
			$button_function = (($is_signed && $es_publica) ? 'leave' : (($inscritos == $maximo && $es_publica) ? '' : ((!$es_publica) ? 'cancel' : 'join')));
			$button_function = (($button_function == '') ? '' : ('onclick=\'' . $button_function . '_monitorie(' . $monitoria_id . ', this, false)\''));
			$button_enable = (($is_signed || $inscritos < $maximo) ? '' : 'disabled');
			$button_text = (($is_signed && $es_publica) ? 'Abandonar monitoria' : (($inscritos == $maximo && $es_publica) ? 'Monitoria llena' : ((!$es_publica) ? 'Cancelar monitoria' : 'Deseo unirme')));

			include ('php/tutories_content.php');

			echo "<script> addRatingTo('tutorie-rating', " . $calificacion . ", '#tutorie-rating'); </script>";

			while ($user = $user_query->fetch_assoc()) {
				addUserTo($user, '#estudents');
			}

			while ($comentary = $comentary_query->fetch_assoc()) {
				addComentaryTo($comentary, '#comments');
			}
		} else {
			$object_not_found = 'Esta monitoria es privada';
			include ('php/notFound_content.php');
		}
	} else {
		$object_not_found = 'Monitoria no encontrada';
		include ('php/notFound_content.php');
	}
}  else {
	include ('php/tutories_content.php');

	$monitories_query = dbquery("SELECT
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
		WHERE estudiantes.id = " . USER_ID . "
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
}

?>

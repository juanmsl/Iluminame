<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

if (isset($_GET["id"])) {
	$id = filter($_GET["id"]);
	if ($id != $_GET["id"]) {
		header("Location: " . WWW . "/logout.php");
		exit;
	}

	$monitorie_query = dbquery("SELECT
		monitorias.id, monitorias.fecha_inicio, monitorias.fecha_fin, monitorias.lugar, monitorias.es_publica, monitorias.estudiante_id as monitor_id,
		estudiantes.nombre, estudiantes.usuario, estudiantes.foto, estudiantes.telefono, estudiantes.correo,
		materias.nombre as materia, estudiantes_materias.descripcion, estudiantes_materias.costo_h_priv, estudiantes_materias.costo_h_public, estudiantes_materias.max_estud,
		(SELECT count(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = monitorias.id AND estudiante_id = " . USER_ID . ") as inscrito,
        IFNULL((SELECT AVG(calificacion) FROM comentarios WHERE comentarios.monitoria_id = monitorias.id),0) as promedio
		FROM
		estudiantes JOIN monitorias ON (estudiantes.id = monitorias.estudiante_id) JOIN
		estudiantes_materias ON (estudiantes_materias.estudiante_id = monitorias.estudiante_id AND estudiantes_materias.materia_id = monitorias.materia_id) JOIN
		materias ON (materias.id = estudiantes_materias.materia_id)
		WHERE
	monitorias.id = " . $id . ";");

	if($monitorie_query->num_rows == 1) {
		$monitorie_query = $monitorie_query->fetch_assoc();

		$monitoria_id = clean($monitorie_query["id"]);
		$fecha = strftime("%d de %B del %Y", $monitorie_query["fecha_inicio"]);
		$duracion = strftime("%I:%M %p", $monitorie_query["fecha_inicio"]) . " - " . strftime("%I:%M %p", $monitorie_query["fecha_fin"]);
		$lugar = clean($monitorie_query["lugar"]);
		$es_publica = clean($monitorie_query["es_publica"]) == '1';
		$calificacion = clean($monitorie_query["promedio"]);

		$monitor_id = clean($monitorie_query["monitor_id"]);
		$monitor = clean($monitorie_query["nombre"]);
		$usuario = clean($monitorie_query["usuario"]);
		$foto = clean($monitorie_query["foto"]);
		$telefono = clean($monitorie_query["telefono"]);
		$correo = clean($monitorie_query["correo"]);
		$is_my_monitorie = $monitor_id == USER_ID;

		$materia = clean($monitorie_query["materia"]);
		$descripcion = clean($monitorie_query["descripcion"]);
		$costo = easyNumber(($es_publica) ? clean($monitorie_query["costo_h_public"]) : clean($monitorie_query["costo_h_priv"]));
		$maximo = clean($monitorie_query["max_estud"]);

		$is_signed = $monitorie_query["inscrito"] == 1 ? true : false;
		$is_disabled = ($monitorie_query["fecha_inicio"] < time());

		if($es_publica || (!$es_publica && $monitorie_query["fecha_inicio"] < time()) || (!$es_publica && $is_signed) || $is_my_monitorie) {
			$user_query = dbquery("SELECT estudiantes.id, estudiantes.foto, estudiantes.nombre, estudiantes.usuario,
				(SELECT COUNT(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = estudiantes.id AND estudiante_id_seguido = " . USER_ID . ") as isFollowMe,
				(SELECT COUNT(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = " . USER_ID . " AND estudiante_id_seguido = estudiantes.id) as isFollow
				FROM estudiantes JOIN estudiantes_monitorias_inscripciones ON (estudiantes.id = estudiantes_monitorias_inscripciones.estudiante_id)
				WHERE estudiantes_monitorias_inscripciones.monitoria_id = " . $id . "
				order by nombre;");

			$comentary_query = dbquery("SELECT estudiantes.foto, estudiantes.nombre, comentarios.calificacion, comentarios.descripcion, comentarios.id
				FROM estudiantes JOIN comentarios ON (estudiantes.id = comentarios.estudiante_id)
				WHERE comentarios.monitoria_id = " . $id . ";");

			$inscritos = $user_query->num_rows;
			$button_class = (($is_signed && $es_publica) ? 'leave' : (($inscritos == $maximo || !$es_publica) ? 'full' : 'join'));
			$button_function = (($is_signed && $es_publica) ? 'leave' : (($inscritos == $maximo && $es_publica) ? '' : ((!$es_publica) ? 'cancel' : 'join')));
			$button_function = (($button_function == '') ? '' : ('onclick=\'' . $button_function . '_monitorie(' . $monitoria_id . ', this, false)\''));
			$button_enable = (($is_signed || $inscritos < $maximo) ? '' : 'disabled');
			$button_text = (($is_signed && $es_publica) ? 'Abandonar monitoria' : (($inscritos == $maximo && $es_publica) ? 'Monitoria llena' : ((!$es_publica) ? 'Cancelar monitoria' : 'Deseo unirme')));

			include ('php/tutorie_content.php');

			echo "<script> addRatingTo('tutorie-rating', " . $calificacion . ", '#tutorie-rating'); </script>";

			while ($user = $user_query->fetch_assoc()) {
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
				}, '#estudents');
				</script>";
			}

			while ($comentary = $comentary_query->fetch_assoc()) {
				echo "<script>
				addComentaryTo({
					picture: '" . clean($comentary["foto"]) . "',
					name: '" . clean($comentary["nombre"]) . "',
					rating_value: '" . clean($comentary["calificacion"]) . "',
					description: '" . clean($comentary["descripcion"]) . "',
					comentary_id: '" . clean($comentary["id"]) . "'
				}, '#comments');
				</script>";
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
	$object_not_found = 'Monitoria no encontrada';
	include ('php/notFound_content.php');
}

?>

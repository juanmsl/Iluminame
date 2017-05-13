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
		(SELECT count(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = monitorias.id AND estudiante_id = " . USER_ID . ") as inscrito
		FROM
		estudiantes JOIN monitorias ON (estudiantes.id = monitorias.estudiante_id) JOIN
		estudiantes_materias ON (estudiantes_materias.estudiante_id = monitorias.estudiante_id AND estudiantes_materias.materia_id = monitorias.materia_id) JOIN
		materias ON (materias.id = estudiantes_materias.materia_id)
		WHERE
	monitorias.id = " . $id . ";");

	$user_query = dbquery("SELECT estudiantes.id, estudiantes.foto, estudiantes.nombre, estudiantes.usuario,
		(SELECT COUNT(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = estudiantes.id AND estudiante_id_seguido = " . USER_ID . ") as isFollowMe,
		(SELECT COUNT(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = " . USER_ID . " AND estudiante_id_seguido = estudiantes.id) as isFollow
		FROM estudiantes JOIN estudiantes_monitorias_inscripciones ON (estudiantes.id = estudiantes_monitorias_inscripciones.estudiante_id)
		WHERE estudiantes_monitorias_inscripciones.monitoria_id = " . $id . "
		order by nombre;");

	if($monitorie_query->num_rows == 1) {
		$monitorie_query = $monitorie_query->fetch_assoc();

		$monitoria_id = clean($monitorie_query["id"]);
		$fecha = strftime("%d de %B del %Y", $monitorie_query["fecha_inicio"]);
		$duracion = strftime("%I:%M %p", $monitorie_query["fecha_inicio"]) . " - " . strftime("%I:%M %p", $monitorie_query["fecha_fin"]);
		$lugar = clean($monitorie_query["lugar"]);
		$es_publica = clean($monitorie_query["es_publica"]) == '1';

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
		$inscritos = $user_query->num_rows;
		$button_class = (($is_signed) ? 'leave' : (($inscritos == $maximo) ? 'full' : 'join'));
		$button_function = (($is_signed) ? 'leave' : (($inscritos == $maximo) ? '' : 'join'));
		$button_function = (($button_function == '') ? '' : ('onclick=\'' . $button_function . '_monitorie(' . $monitoria_id . ', this, false)\''));
		$button_enable = (($is_signed || $inscritos < $maximo) ? '' : 'disabled');
		$button_text = (($is_signed) ? 'Abandonar monitoria' : (($inscritos == $maximo) ? 'Monitoria llena' : 'Deseo unirme'));

		$is_disabled = ($monitorie_query["fecha_inicio"] < time());

		include ('php/tutorie_content.php');

		if($user_query->num_rows > 0) {
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

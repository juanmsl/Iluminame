<?php

require_once "../global.php";

if (!LOGGED_IN) {
	header("Location: " . WWW . "/");
	exit;
}

@$myObj->result = "ok";

if(isset($_POST["lugar"]) && isset($_POST["fecha"]) && isset($_POST["duracion"]) && isset($_POST["publica"]) && isset($_POST["monitor_id"]) && isset($_POST["materia_id"])) {
	$lugar = filter($_POST["lugar"]);
	$fecha = filter($_POST["fecha"]);
	$duracion = filter($_POST["duracion"]);
	$is_public = filter($_POST["publica"]);
	$monitor_id = filter($_POST["monitor_id"]);
	$materia_id = filter($_POST["materia_id"]);

	if($lugar == $_POST["lugar"] && $fecha == $_POST["fecha"] && $duracion == $_POST["duracion"] && $is_public == $_POST["publica"] && $monitor_id == $_POST["monitor_id"] && $materia_id = $_POST["materia_id"]) {
		$fecha_inicio = strtotime($fecha);
		$fecha_fin = strtotime($fecha) + (3600 * $duracion);

		dbquery("INSERT INTO monitorias (fecha_inicio, fecha_fin, lugar, es_publica, estudiante_id, materia_id) VALUES (" . $fecha_inicio . "," . $fecha_fin . ",'" . $lugar . "','" . $is_public . "'," . $monitor_id . "," . $materia_id . ")");

		$id = mysqli_insert_id($db->link);

		dbquery("REPLACE INTO estudiantes_monitorias_inscripciones (estudiante_id, monitoria_id) VALUES ('" . USER_ID . "', '" . $id . "');");
		$myObj->result = "ok";
	} else {
		$myObj->result = "Datos erroneos";
	}
} else {
	$myObj->result = "Faltan datos";
}

$myJSON = json_encode($myObj);
echo $myJSON;
?>

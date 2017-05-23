<?php
require_once "../global.php";

if (!isset($_POST["subject"]) || !isset($_POST["desc"]) || !isset($_POST["value_pr"]) || !isset($_POST["value_pb"]) || !isset($_POST["max"])) {
	exit;
}

$subject = filter($_POST["subject"]);
$desc = filter($_POST["desc"]);
$value_pr = filter($_POST["value_pr"]);
$value_pb = filter($_POST["value_pb"]);
$max = filter($_POST["max"]);

dbquery("INSERT INTO estudiantes_materias (estudiante_id, materia_id, descripcion, costo_h_priv, costo_h_public, max_estud)
	VALUES (" . USER_ID . ", " . $subject . ", '" . $desc . "', " . $value_pr . ", " . $value_pb . ", " . $max . ");");

$followers = dbquery("SELECT estudiantes_seguidores.estudiante_id_seguidor FROM estudiantes_seguidores WHERE estudiantes_seguidores.estudiante_id_seguido = " . USER_ID . ";");
$subject_name = dbqueryEvaluate("SELECT materias.nombre FROM materias WHERE materias.id = " . $subject . ";");

while($fll = $followers->fetch_assoc()) {
	$msg = base64_encode("<b>" . clean($myrow["nombre"]) . "</b> ahora dicta <b>" . clean($subject_name) . "</b>");
	$link = base64_encode("subjects.php?id=" . $subject . "&user=" . USER_ID);

	dbquery("INSERT
		INTO notificaciones (descripcion, fecha, vista, estudiante_id_recibe, estudiante_id_envia, link_event)
		VALUES ('" . $msg . "', " . time() . ", '0', " . $fll["estudiante_id_seguidor"] . " , " . USER_ID . ", '" . $link . "')");
}

@$MyObj->result = "Ok";
$myJSON = json_encode($MyObj);
echo $myJSON;
?>

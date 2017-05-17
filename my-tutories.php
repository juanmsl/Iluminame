<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

include ('php/my_tutories_content.php');

$monitories_query = monitorie_query("JOIN estudiantes_monitorias_inscripciones
	ON (estudiantes_monitorias_inscripciones.monitoria_id = monitorias.id)
	WHERE estudiantes_monitorias_inscripciones.estudiante_id = " . USER_ID);

while($monitorie = $monitories_query->fetch_assoc()) {
	$container = (($monitorie["fecha_inicio"] > time()) ? '#active-monitories' : '#past-monitories' );
	addMonitorieTo($monitorie, $container, 'card', true);
}

?>

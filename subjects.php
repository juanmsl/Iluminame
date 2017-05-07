<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

include ('php/subjects_content.php');

$subjects_query = dbquery("SELECT
		estudiantes_materias.materia_id,
		materias.nombre,
		estudiantes_materias.descripcion,
		estudiantes_materias.costo_h_priv,
		estudiantes_materias.costo_h_public,
		estudiantes_materias.max_estud,
		IFNULL((SELECT AVG(calificacion) FROM comentarios WHERE comentarios.monitoria_id = monitorias.id),0) as promedio
		FROM estudiantes_materias JOIN monitorias
			ON (monitorias.materia_id = estudiantes_materias.materia_id AND monitorias.estudiante_id = estudiantes_materias.estudiante_id) JOIN materias
			ON (materias.id = estudiantes_materias.materia_id)
		WHERE estudiantes_materias.estudiante_id = " . USER_ID . ";");

while($subject = $subjects_query->fetch_assoc()) {
	echo "<script>
			addSubjectTo({
				subject_id: '" . clean($subject["materia_id"]) . "',
				subject_name: '" . clean($subject["nombre"]) . "',
				description: '" . clean($subject["descripcion"]) . "',
				cost_pr: '" . clean($subject["costo_h_priv"]) . "',
				cost_pb: '" . clean($subject["costo_h_public"]) . "',
				max: '" . clean($subject["max_estud"]) . "',
				rating_value: '" . clean($subject["promedio"]) . "'
			}, '#subjects-group');
		</script>";
}

?>

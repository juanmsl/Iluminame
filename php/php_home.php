<<<<<<< HEAD
<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}
$items_query = dbquery("SELECT
monitorias.id as monitoria_id, monitorias.fecha_inicio, monitorias.fecha_fin, monitorias.lugar, monitorias.estudiante_id, monitorias.materia_id,
estudiantes.nombre as estudiante_nombre, estudiantes.usuario, estudiantes.foto,
materias.nombre as materia_nombre,
estudiantes_materias.costo_h_public, estudiantes_materias.max_estud,
(SELECT count(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = (monitorias.id)) as monitoria_inscripciones
FROM monitorias
JOIN estudiantes ON (estudiantes.id = monitorias.estudiante_id)
JOIN materias ON (materias.id = monitorias.materia_id)
JOIN estudiantes_materias ON (estudiantes_materias.materia_id = monitorias.materia_id AND estudiantes_materias.estudiante_id = monitorias.estudiante_id)
ORDER BY monitoria_id;");

$items_available = $items_query->num_rows;
$items_data = "";
if ($items_available > 0) {
	while ($item = $items_query->fetch_assoc())
	{

		$items_data .= '<section class="box card"><a href="profile.php?user=' . clean($item["usuario"]) . '" class="box-h-section box-header"><img src="' . clean($item["foto"]) . '" class="picture"/>
				<div class="box-v-section box-justify-center gutter-0">
					<p class="sub-title">' . clean($item["materia_nombre"]) . '</p>
					<p>' . clean($item["estudiante_nombre"]) . '</p>
				</div></a>
			<section class="box-v-section">
				<p name="Lugar: " class="box-data">' . clean($item["lugar"]) . '</p>
				<p name="Fecha: " class="box-data">' . strftime("%B %d de %Y", $item["fecha_inicio"]) . '</p>
				<p name="Duración: " class="box-data">' . strftime("%I:%M%p", $item["fecha_inicio"]) . ' - ' . strftime("%I:%M%p", $item["fecha_fin"]) . '</p>
				<p name="Precio por estudiante: " class="box-data">$' . clean($item["costo_h_public"]) . '</p>
			</section>
			<section class="box-v-section box-footer box-align-center">
				<p class="box-data">' . clean($item["monitoria_inscripciones"]) . '/' . clean($item["max_estud"]) . ' personas</p>
				<button class="join-button">Deseo unirme</button>
			</section>
		</section>
		';
	}

}

?>
=======
<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}
$items_query = dbquery("SELECT
monitorias.id as monitoria_id, monitorias.fecha_inicio, monitorias.fecha_fin, monitorias.lugar, monitorias.estudiante_id, monitorias.materia_id,
estudiantes.nombre as estudiante_nombre, estudiantes.usuario, estudiantes.foto,
materias.nombre as materia_nombre,
estudiantes_materias.costo_h_public, estudiantes_materias.max_estud,
(SELECT count(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = (monitorias.id)) as monitoria_inscripciones
FROM monitorias
JOIN estudiantes ON (estudiantes.id = monitorias.estudiante_id)
JOIN materias ON (materias.id = monitorias.materia_id)
JOIN estudiantes_materias ON (estudiantes_materias.materia_id = monitorias.materia_id AND estudiantes_materias.estudiante_id = monitorias.estudiante_id)
ORDER BY monitoria_id;");

$items_available = $items_query->num_rows;
$items_data = "";
if ($items_available > 0) {
	while ($item = $items_query->fetch_assoc())
	{

		$items_data .= '<section class="box card"><a href="profile.php?user=' . clean($item["usuario"]) . '" class="box-h-section box-header"><img src="' . clean($item["foto"]) . '" class="picture"/>
				<div class="box-v-section box-justify-center gutter-0">
					<p class="sub-title">' . clean($item["materia_nombre"]) . '</p>
					<p>' . clean($item["estudiante_nombre"]) . '</p>
				</div></a>
			<section class="box-v-section">
				<p name="Lugar: " class="box-data">' . clean($item["lugar"]) . '</p>
				<p name="Fecha: " class="box-data">' . strftime("%B %d de %Y", $item["fecha_inicio"]) . '</p>
				<p name="Duración: " class="box-data">' . strftime("%I:%M%p", $item["fecha_inicio"]) . ' - ' . strftime("%I:%M%p", $item["fecha_fin"]) . '</p>
				<p name="Precio por estudiante: " class="box-data">$' . clean($item["costo_h_public"]) . '</p>
			</section>
			<section class="box-v-section box-footer box-align-center">
				<p class="box-data">' . clean($item["monitoria_inscripciones"]) . '/' . clean($item["max_estud"]) . ' personas</p>
				<button class="join-button">Deseo unirme</button>
			</section>
		</section>
		';
	}

}

?>
>>>>>>> refs/remotes/origin/master

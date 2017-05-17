<?php
// ############################################################################
// Prepare the local environment
define('UBER', true);
define('DS', DIRECTORY_SEPARATOR);
define('LB', chr(13));
define('CWD', dirname(__FILE__) . DS);
define('INCLUDES', CWD . 'inc' . DS);
define('SITE_NAME', "Ilumíname");

date_default_timezone_set('America/Bogota');
setlocale(LC_TIME, "Spanish_Colombia");

error_reporting(E_ALL);
@session_start();

// ############################################################################
// Initialize core classes
require_once INCLUDES . "class.core.php";
require_once INCLUDES . "class.db.mysql.php";
require_once INCLUDES . "class.users.php";

$core = new uberCore();
$users = new uberUsers();

// ############################################################################
// Execute some required core functionality

$core->ParseConfig();
$db = new MySQL($core->config['MySQL']['hostname'], $core->config['MySQL']['username'],	$core->config['MySQL']['password'], $core->config['MySQL']['database']);
$db->Connect();

// ############################################################################
// Session handling

if (isset($_SESSION['UBER_USER_E']) && isset($_SESSION['UBER_USER_H']))
{
	$userE = $_SESSION['UBER_USER_E'];
	$userH = $_SESSION['UBER_USER_H'];

	$usersql = dbquery("SELECT id, usuario, correo, nombre, foto, telefono, aboutme, (SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = COALESCE((SELECT id FROM estudiantes WHERE usuario LIKE '" . $userE . "'), 0)) as seguidos, (SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguido = COALESCE((SELECT id FROM estudiantes WHERE usuario LIKE '" . $userE . "'), 0)) as seguidores FROM estudiantes WHERE usuario LIKE '" . $userE . "' AND contrasena = '" . $userH . "' LIMIT 1");
	$myrow = mysqli_fetch_assoc($usersql);
	if (mysqli_num_rows($usersql) > 0)
	{
		define('LOGGED_IN', true);
		define('USER_NAME', $userE);
		define('USER_ID', $myrow["id"]);
		define('USER_HASH', $userH);
	}
	else
	{
		@session_destroy();
		header('Location: /');
		exit;
	}
}
else
{
	define('LOGGED_IN', false);
	define('USER_NAME', 'Invitado');
	define('USER_ID', -1);
	define('USER_HASH', null);
}

$core->CheckCookies();

function dbquery($strQuery = '')
{
	global $db;

	if($db->IsConnected())
	{
		return $db->DoQuery($strQuery);
	}

	return $db->Error('Could not process query, no active db connection detected..');
}

function dbqueryEvaluate($strQuery, $i = 0)
{
	global $db;
	if($db->IsConnected())
	{
		return $db->Evaluate($strQuery, $i);
	}

	return $db->Error('Could not process query, no active db connection detected..');
}

function filter($strInput = '')
{
	global $db;
	return mysqli_real_escape_string($db->link, trim($strInput));
	//return mysqli_real_escape_string($db->link, stripslashes(trim($strInput)));
}
function clean($strInput = '', $ignoreHtml = false, $nl2br = false, $encoding = "UTF-8")
{
	$strInput = stripslashes(trim($strInput));
	if (!$ignoreHtml)
	{
		$strInput = htmlspecialchars($strInput, ENT_QUOTES | ENT_HTML5, $encoding);
	}
	if ($nl2br)
	{
		$strInput = nl2br($strInput);
	}
	return $strInput;
}

function easyNumber($number)
{
	$test=555;
	$string_return='';
	$count_numbers=0;
	for ($i = 1; $i <= strlen($number); $i++)
	{
		$string_return=substr($number,strlen($number)-$i,1).$string_return;
		$count_numbers++;
		if($count_numbers==3 && $i != strlen($number))
		{
			$string_return='.'.$string_return;
			$count_numbers=0;
		}
	}
	return $string_return;
}

function timeAgo($timestamp, $minute = "minuto", $hour = "hora", $day = "d&iacute;a", $week = "semana", $seconds = "segundos", $minutes = "minutos", $hours = "horas", $days = "d&iacute;as", $weeks = "semanas")
{
	$difference = time() - $timestamp;
	if ($difference < 60)
		return "Hace $difference $seconds";
	else
	{
		$difference = round($difference / 60);
		if ($difference < 60)
		{
			if ($difference == 1) return "Hace $difference $minute";
			else return "Hace $difference $minutes";
		}
		else
			$difference = round($difference / 60);

		if ($difference < 24)
		{
			if ($difference == 1) return "Hace $difference $hour";
			else return "Hace $difference $hours";
		}
		else
			return strftime("%d de %B del %Y, %I:%M %p", $timestamp);
			//$difference = round($difference / 24);

		if ($difference < 7)
		{
			if ($difference == 1) return "$difference $day";
			else return "$difference $days";
		}
		else
		{
			$difference = round($difference / 7);
			if ($difference == 1) return "$difference $week";
			else return "$difference $weeks";
		}
	}
}

function subjects_query($where) {
	return dbquery("SELECT
			estudiantes.id,
			estudiantes.foto,
			estudiantes.usuario,
			estudiantes.nombre as nombre_estu,
			estudiantes_materias.materia_id,
			materias.nombre,
			estudiantes_materias.descripcion,
			estudiantes_materias.costo_h_priv,
			estudiantes_materias.costo_h_public,
			estudiantes_materias.max_estud,
			IFNULL((SELECT AVG(calificacion) FROM comentarios JOIN monitorias ON (comentarios.monitoria_id = monitorias.id) WHERE monitorias.estudiante_id = estudiantes.id AND monitorias.materia_id = materias.id),0) as promedio
			FROM estudiantes_materias JOIN materias
				ON (materias.id = estudiantes_materias.materia_id) JOIN estudiantes
				ON (estudiantes_materias.estudiante_id = estudiantes.id)
			" . $where . "
			ORDER BY promedio DESC;");
}

function addSubjectTo($subject, $container, $card) {
	echo "<script>
			addSubjectTo({
				user_link: 'profile.php?user=" . clean($subject["usuario"]) . "',
				user_user: '" . clean($subject["usuario"]) . "',
				subject_link: 'subjects.php?id=" . clean($subject["materia_id"]) . "&user=" . clean($subject["id"]) . "',
				user_picture: '" . clean($subject["foto"]) . "',
				user_name: '" . clean($subject["nombre_estu"]) . "',
				user_id: '" . clean($subject["id"]) . "',
				subject_id: '" . clean($subject["materia_id"]) . "',
				subject_name: '" . clean($subject["nombre"]) . "',
				description: '" . clean($subject["descripcion"]) . "',
				cost_pr: '" . clean($subject["costo_h_priv"]) . "',
				cost_pb: '" . clean($subject["costo_h_public"]) . "',
				max: '" . clean($subject["max_estud"]) . "',
				rating_value: '" . clean($subject["promedio"]) . "',
				card: '" . $card . "'
			}, '" . $container . "');
		</script>";
}

function monitorie_query($where) {
	return dbquery("SELECT
		monitorias.id as monitoria_id,
		monitorias.fecha_inicio,
		monitorias.fecha_fin,
		monitorias.lugar,
		monitorias.es_publica,
		monitorias.materia_id,
		monitorias.estudiante_id as monitor_id,
		estudiantes.nombre as estudiante_nombre,
		estudiantes.usuario,
		estudiantes.foto,
		materias.nombre as materia_nombre,
		estudiantes_materias.costo_h_priv,
		estudiantes_materias.costo_h_public,
		estudiantes_materias.max_estud,
		estudiantes_materias.descripcion,
		(SELECT count(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = (monitorias.id)) as monitoria_inscripciones,
		(SELECT count(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = (monitorias.id) AND estudiante_id = " . USER_ID . ") as inscrito,
		IFNULL((SELECT AVG(calificacion) FROM comentarios WHERE comentarios.monitoria_id = monitorias.id),0) as promedio
		FROM monitorias JOIN estudiantes
			ON (monitorias.estudiante_id  = estudiantes.id) JOIN materias
			ON (materias.id = monitorias.materia_id) JOIN estudiantes_materias
			ON (estudiantes_materias.estudiante_id = estudiantes.id AND estudiantes_materias.materia_id = materias.id)
		" . $where . "
		ORDER BY fecha_inicio DESC;");
}

function addMonitorieTo($monitorie, $container, $card, $ignoreConditions) {
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
				card: '" . $card . "',
				disabled: " . ($monitorie["fecha_inicio"] < time() ? 1 : 0) . ",
				maximun: '" . clean($monitorie["max_estud"]) . "'" .
				(($ignoreConditions) ? (",ignoreConditions: " . ($monitorie["fecha_inicio"] < time() ? 1 : 0)) : "" ) .
			"}, '" . $container . "');
		</script>";
}

function addUserTo($user, $container) {
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
			}, '" . $container . "');
		</script>";
}

function addComentaryTo($comentary, $container) {
	echo "<script>
			addComentaryTo({
				picture: '" . clean($comentary["foto"]) . "',
				name: '" . clean($comentary["nombre"]) . "',
				rating_value: '" . clean($comentary["calificacion"]) . "',
				description: '" . clean($comentary["descripcion"]) . "',
				comentary_id: '" . clean($comentary["id"]) . "'
			}, '" . $container . "');
		</script>";
}

?>

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

	$usersql = dbquery("SELECT id, usuario, correo, nombre, foto, telefono, aboutme FROM estudiantes WHERE usuario LIKE '" . $userE . "' AND contrasena = '" . $userH . "' LIMIT 1");
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

//$core->CheckCookies();

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
		$strInput = htmlentities($strInput, ENT_QUOTES | ENT_HTML5, $encoding);
	}
	if ($nl2br)
	{
		$strInput = nl2br($strInput);
	}
	return $strInput;
}

function timeAgo($timestamp, $minute = "minuto", $hour = "hora", $day = "d&iacute;a", $week = "semana", $seconds = "segundos", $minutes = "minutos", $hours = "horas", $days = "d&iacute;as", $weeks = "semanas")
{
	$difference = time() - $timestamp;
	if ($difference < 60)
		return "$difference $seconds";
	else
	{
		$difference = round($difference / 60);
		if ($difference < 60)
		{
			if ($difference == 1) return "$difference $minute";
			else return "$difference $minutes";
		}
		else
			$difference = round($difference / 60);

		if ($difference < 24)
		{
			if ($difference == 1) return "$difference $hour";
			else return "$difference $hours";
		}
		else
			$difference = round($difference / 24);

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
?>

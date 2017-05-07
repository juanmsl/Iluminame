<?php
//Based on uberCMS (2010), by Roy 'Meth0d'.
class uberCore
{
	public $execStart;
	public $config;

	public function __construct()
	{
		$this->execStart = microtime(true);
	}

	public function ParseConfig()
	{
		$configPath = INCLUDES . 'inc.config.php';

		if (!file_exists($configPath))
		{
			$this->systemError('Configuration Error', 'The configuration file could not be located at ' . $configPath);
		}

		require_once $configPath;

		if (!isset($config) || count($config) < 2)
		{
			$this->systemError('Configuration Error', 'The configuration file was located, but is in an invalid format. Data is missing or in the wrong format.');
		}

		$this->config = $config;

		define('WWW', $this->config['Site']['www']);
	}

	public static function SystemError($title, $text)
	{
		echo "<h2>ERROR</h2> \n <!-- \n $title \n\n  $text \n -->";
		exit;
	}

	public function UberHash($input = '')
	{
		//return $input;
		//return base64_encode($input);
		return sha1($input);
	}

	public static function GetIP()
	{
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
			return $_SERVER["HTTP_X_FORWARDED_FOR"];
		if (isset($_SERVER["HTTP_CLIENT_IP"]))
			return $_SERVER["HTTP_CLIENT_IP"];
		return $_SERVER["REMOTE_ADDR"];
	}

	public function CheckCookies()
	{
		if (LOGGED_IN)
		{
			return;
		}
		if (isset($_COOKIE['rememberme']) && $_COOKIE['rememberme'] =="true" && isset($_COOKIE['rememberme_token']) && isset($_COOKIE['rememberme_name']))
		{
			$name = filter($_COOKIE['rememberme_name']);
			$token = filter($_COOKIE['rememberme_token']);
			$find = dbquery("SELECT null FROM estudiantes WHERE usuario = '" . $name . "' AND contrasena = '" . $token . "' LIMIT 1");

			if (mysqli_num_rows($find) > 0)
			{
				$_SESSION['UBER_USER_E'] = $name;
				$_SESSION['UBER_USER_H'] = $token;
				$_SESSION['set_cookies'] = true; // renew cookies

				header("Location: " . WWW . "/security_check.php");
				exit;
			}
		}
	}
}
?>

<?php

class uberUsers
{
	/**************************************************************************************************/
	public function IsValidEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			return true;
		}
		return false;
	}

	public function IsValidName($nm = '')
	{
		if (preg_match('/^[a-z0-9\d-.,;:!?@]+$/i', $nm) && strlen($nm) >= 3 && strlen($nm) <= 14)
		{
			return true;
		}

		return false;
	}

	public function IsNameTaken($nm = '')
	{
		return ((mysqli_num_rows(dbquery("SELECT null FROM estudiantes WHERE usuario = '" . $nm . "' LIMIT 1")) > 0) ? true : false);
	}

	public function IsEmailTaken($nm = '')
	{
		return ((mysqli_num_rows(dbquery("SELECT null FROM estudiantes WHERE correo = '" . $nm . "' LIMIT 1")) > 0) ? true : false);
	}

	public function IdExists($id = 0)
	{
		return ((mysqli_num_rows(dbquery("SELECT null FROM estudiantes WHERE id = '" . $id . "' LIMIT 1")) > 0) ? true : false);
	}

	public function IsNameBlocked($nm = '')
	{
		foreach ($this->blockedNames as $bl)
		{
			if (strtolower($nm) == strtolower($bl))
			{
				return true;
			}
		}

		foreach ($this->blockedNameParts as $bl)
		{
			if (strpos(strtolower($nm), strtolower($bl)) !== false)
			{
				return true;
			}
		}

		return false;
	}

	/**************************************************************************************************/

	function ValidateUser($usuario, $password)
	{
		return mysqli_num_rows(dbquery("SELECT null FROM estudiantes WHERE usuario = '" . $usuario . "' AND contrasena = '" . $password. "' LIMIT 1"));
	}

	static function User2id($usuario = '')
	{
		return intval(dbqueryEvaluate("SELECT id FROM estudiantes WHERE usuario = '" . $usuario . "' LIMIT 1"));
	}
	/**************************************************************************************************/
}

?>

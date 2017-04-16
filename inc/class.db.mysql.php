<?php

class MySQL
{
	private $connected;
	private $hostname;
	private $username;
	private $password;
	private $database;
	public $link;

	public $numQueries = 0;

	public function __construct($host, $user, $pass, $db)
	{
		$this->connected = false;
		$this->hostname = $host;
		$this->username = $user;
		$this->password = $pass;
		$this->database = $db;
	}

	public function IsConnected()
	{
		if ($this->connected)
		{
			return true;
		}
		return false;
	}

	public function Connect()
	{
		$this->link = new mysqli($this->hostname, $this->username, $this->password, $this->database);
		if ($this->link->connect_errno)
		{
			$this->error($this->link->connect_error);
		}
		else
		{
			$this->connected = true;
			if (!$this->link->set_charset("utf8")) {
				$this->error("Couldn't set charset to UTF-8");
			}
		}
	}

	public function Disconnect()
	{
		if($this->connected)
		{
			$this->link->Close() or $this->error("could not close conn");
			$this->connected = false;
		}
	}

	public function DoQuery($query)
	{
		$this->numQueries++;
		$resultset = $this->link->query($query) or $this->error($this->link->error);
		return $resultset;
	}

	public function evaluate($query, $i = 0)
	{
		$result = $this->DoQuery($query);
		$row = $result->fetch_row();
		return $row[$i];
	}

	public function error($errorString)
	{
		global $core;

		$core->systemError('Database fail', $errorString);
	}

	public function __destruct()
	{
		$this->disconnect();
	}
}

?>

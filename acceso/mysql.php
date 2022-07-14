<?php
/***** Clase para la coneccion a la base de datos ***/

class mysql
{
	// ---------------------------
	var $host = 'localhost';
	var $user = 'root';		     //Tu nombre de usuario
	var $password = '';		     //Tu contrasenia
	var $database = 'dbpap';	//el nombre de tu base de datos
	// ---------------------------
	var $link_id = 0;
	var $num_queries = 0;
	var $query_id = 0;
	
	function connect()
	{
		$this->link_id = @mysql_connect($this->host, $this->user, $this->password);
		if (!$this->link_id)
		{
			die('Connection to MySQL server failed.');
		}
		if (!@mysql_select_db($this->database, $this->link_id))
		{
			die('Unable to select database.');
		}
                mysql_query("SET NAMES 'utf8'");
		return $this->link_id;
	}

	function fetch()
	{
		if (!$this->query_id)
		{
			return false;
		}
		return @mysql_fetch_array($this->query_id);
	}

	function num_rows()
	{
		if (!$this->query_id)
		{
			return false;
		}
		return @mysql_num_rows($this->query_id);
	}
	
	function num_queries()
	{
		return $this->num_queries;
	}

	function query($sql)
	{
		if (!$sql)
		{
			return false;
		}
		if (!$this->connect())
		{
			return false;
		}
		if ($this->query_id)
		{
			$this->free();
		}
		$this->query_id = @mysql_query($sql, $this->link_id);
		if (!$this->query_id)
		{
			die('Something is wrong in your query syntax.');
		}
		$this->num_queries++;
		return $this->query_id;
	}

	function free()
	{
		@mysql_free_result($this->query_id);
		$this->query_id = 0;
	}

	function version()
	{
		return substr(@mysql_get_server_info($this->link_id), 0, 7);
	}

	function close()
	{
		if (!$this->link_id)
		{
			return false;
		}
		return @mysql_close($this->link_id);
	}
}

?>
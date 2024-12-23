<?php

class DB
{
	private $conn;
	public function __construct()
	{
		$this->conn = new mysaqli('localhost', 'root', '', 'pagina');
	}
	public function get_connection()
	{
		return $this->conn;
	}
}
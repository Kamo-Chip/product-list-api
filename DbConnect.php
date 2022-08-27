<?php

/**
 * Database Connection
 */
class DbConnect
{
	private $server = 'us-cdbr-east-06.cleardb.net';
	private $dbname = 'heroku_d11828329da3bdf';
	private $user = 'b7b023a1da2d4e';
	private $pass = 'f2d64834';

	protected function connect()
	{
		try {
			// $conn = new PDO('mysql:host=' . $this->server . ';dbname=' . $this->dbname, $this->user, $this->pass);
			// $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			// return $conn;
			$conn = mysqli_connect($this->server, $this->user, $this->pass, $this->dbname);
			return $conn;
		} catch (\Exception $e) {
			echo "Database Error: " . $e->getMessage();
		}
	}
}

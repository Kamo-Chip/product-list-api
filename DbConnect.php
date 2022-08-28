<?php

/**
 * Database Connection
 */
class DbConnect
{
	protected function connect()
	{
		try {
			$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
			$server = $url["host"];
			$username = $url["user"];
			$password = $url["pass"];
			$db = substr($url["path"], 1);

			$conn = new mysqli($server, $username, $password, $db);
			return $conn;
		} catch (\Exception $e) {
			echo "Database Error: " . $e->getMessage();
		}
	}
}

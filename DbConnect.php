<?php

/**
 * Database Connection
 */
class DbConnect
{
	private $server = 'localhost';
	private $dbname = 'id19461161_productlist';
	private $user = 'id19461161_productlistuser';
	private $pass = '5hSVQ&iu[=AD<cOm';

	// private $server = 'sql302.epizy.com';
	// private $dbname = 'epiz_32444252_productlist';
	// private $user = 'epiz_32444252';
	// private $pass = 'Uaeb3SGyF8UmobP';

	protected function connect()
	{
		try {
			$conn = new PDO('mysql:host=' . $this->server . ';dbname=' . $this->dbname, $this->user, $this->pass);
			$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			return $conn;
		} catch (\Exception $e) {
			echo "Database Error: " . $e->getMessage();
		}
	}
}

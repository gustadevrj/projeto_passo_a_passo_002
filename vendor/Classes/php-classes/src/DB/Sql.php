<?php 

namespace Vendor\DB;

class Sql {
	const HOSTNAME = "127.0.0.1";
	const DBNAME = "projeto_teste_002";
	const CHARSET = "utf8mb4";//utf8 - utf8mb4
	const USERNAME = "root";
	const PASSWORD = "";

	private $conn;

	public function __construct()
	{
		$this->conn = new \PDO(
			"mysql:host=" . Sql::HOSTNAME . ";dbname=" . Sql::DBNAME . ";charset=" . Sql::CHARSET, 
			Sql::USERNAME, 
			Sql::PASSWORD
		);
	}

	private function setParams($statement, $parameters = array())
	{
		foreach ($parameters as $key => $value) {
			$this->bindParam($statement, $key, $value);
		}
	}

	private function bindParam($statement, $key, $value)
	{
		$statement->bindParam($key, $value);
	}

	public function query($rawQuery, $params = array())
	{
		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();
	}

	public function select($rawQuery, $params = array()):array
	{
		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
}
?>
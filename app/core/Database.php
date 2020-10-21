<?php

namespace App\Core;

/**
 * Classe que abstrai as operações do PDO
 */
class Database
{
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASSWORD;
	private $dbname = DB_NAME;

	private $dbh;
	private $error;
	private $stmt;

	private static $instance;
	
	/**
	 * Retorna uma instancia dessa classe
	 *
	 * @return void
	 */
	public static function get() : Database
	{
		if (!isset(self::$instance)) :
			self::$instance = new Database;
		endif;
		return self::$instance;
	}

	public function __construct()
	{
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8';
		$options = array(
			\PDO::ATTR_PERSISTENT => true,
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
		);

		try {
			$this->dbh = new \PDO($dsn, $this->user, $this->pass, $options);
		}
		catch (\PDOException $e) {
			$this->error = $e->getMessage();
		}
	}

		
	/**
	 * Prepara a declaracao da query
	 *
	 * @param  mixed $query
	 * @return void
	 */
	public function query($query)
	{
		$this->stmt = $this->dbh->prepare($query);
	}

		
	/**
	 * Faz o bind dos valores
	 *
	 * @param  mixed $param
	 * @param  mixed $value
	 * @param  mixed $type
	 * @return void
	 */
	public function bind($param, $value, $type = null)
	{
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = \PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = \PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = \PDO::PARAM_NULL;
					break;
				default:
					$type = \PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

		
	/**
	 * Executa a query
	 *
	 * @return void
	 */
	public function execute()
	{
		return $this->stmt->execute();
	}

		
	/**
	 * Retorna todos os valores como um tipo array
	 *
	 * @return void
	 */
	public function resultset()
	{
		$this->execute();
		return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

		
	/**
	 * Retorna o resultado único como um tipo array 
	 *
	 * @return void
	 */
	public function single()
	{
		$this->execute();
		return $this->stmt->fetch(\PDO::FETCH_ASSOC);
	}

		
	/**
	 * Retorna a quantidade de registros
	 *
	 * @return void
	 */
	public function rowCount()
	{
		return $this->stmt->rowCount();
	}

		
	/**
	 * Retorna o útlimo ID inserido no banco de dados
	 *
	 * @return void
	 */
	public function lastInsertId()
	{
		return $this->dbh->lastInsertId();
	}
}
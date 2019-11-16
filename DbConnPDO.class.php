<?php

/**
* PDO database connection
* Representa a ligação global à base de dados
*
* @package Chat\PDO
*/
class DbConnPDO extends PDO
{
	/** 
	* @var string|null Message err_message 
	*/
	private $err_message = null;

	/*
	* Constructor
	* Open the database connection
	*/
	function __construct()
	{
		$connection_string = sprintf('mysql:host=%s;dbname=%s;charset=utf8', DB_HOSTNAME, DB_NAME);

		try {
			parent::__construct($connection_string, DB_USERNAME, DB_PASSWORD);
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			$this->err_message = $e->getMessage();
			throw $e;
		}
	}

	/**
	* Show error.
	*
	* @return string Error 	
	*/
	public function getError()
	{
		return $this->err_message;
	}

	/*
	* Close connection.
	*
	* Close the connection when the object is destroid 	
	*/
	public function FunctionName($value='')
	{
		$this->conn = null;
	}
}
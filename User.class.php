<?php

/**
* Chat User
*
* @package Chat\User
* @author Williams Santos
*/

class User extends DbConnPDO
{
	/**
	* @var string|null Query SQL
	*/
	private $sql = null;

	/*
	* Constructor
	*/
	function __construct(argument)
	{
		parent::__construct();
	}

	/**
	* Check if nickname exists in database
	*
	* @param string $nickname Nickname from user
	*
	* @return boolean Return true if nickname exists
	*/
	public function checkNicknameExists($nickname)
	{
		try {
			$this->sql = 'SELECT Nickname FROM `'.USERS.'` WHERE `Nickname` = :ninckname LIMIT 1';

			$stmt = $this->prepare($this->sql);
			$stmt->bindParam(':nickname',$ninckname,PDO::PARAM_STR);
			$stmt->execute();
			$num_rows = $stmt->rowCount();

			if ($num_rows == 0) {
				return false;
			}
			return true;
		} catch (Exception $e) {
			throw $e;
		}
	}


	/**
	* Insert User in database.
	*
	* @param string $nickname Nickname
	*
	* @return boolean Return true if insert is sucessfuly or false if fails
	*/
	public function insert($nickname)
	{
		$this->sql = 'INSERT INTO `'.USERS.'` (Nickname) VALUES (:nickname)';

		try {
			$stmt = $this->prepare($this->sql);
			$stmt->bindParam(':nickname',$ninckname, PDO::PARAM_STR);

			if ($stmt->execute()) {
				$stmt->closeCursor();
				return true;
			}
			
			$stmt->closeCursor();
			return false;
		} catch (Exception $e) {
			throw $e;
		}
	}

	/**
	* @return string Return the Query.
	*/
	public function _toString()
	{
		if (is_null($this->sql)) {
			return 'Null';
		}
		return $this->sql;
	}
}

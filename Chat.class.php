<?php

/**
 * Messages in Chat
 *
 * @package Chat\Messages
 * @author Williams Santos
 */
class Chat extends DbConnPDO
{
	/**
	* @var string|null Query SQL
	*/	
	private $sql = null;

	/*
	* Construct
	*/
	function __construct()
	{
		parent::__construct();
	}

	/**
	* Read the last x messages in the chat
	*
	* @param int $limit Numbers of messages
	*
	* @return boolean Return true if nickname exists
	*/
	public function getMessages($limit)
	{
		try {

			$this->sql = 'SELECT `FromNickname`,`Message` FROM `'.MESSAGES.'` ORDER BY IdMessage DESC LIMIT :limit';

			$stmt =  $this->prepare($this->sql);
			$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
			$stmt->execute();

			$obj = $stmt->fetchAll(PDO::FETCH_OBJ);
			$stmt->closeCursor();
			
			return $obj;
		} catch (Exception $e) {
			throw $e;
		}
	}

	/**
	*
	* Insert the message into database.
	*
	* @param string $from Nickname why send the message
	* @param string $message Message
	*
	* @return boolean Return a boolean true if is sucess or false in error
	*/
	public function insert($from, $message)
	{

		$this->sql = 'INSERT INTO `'.MESSAGES.'` (`FromNickname`,`Message`) VALUES (:from, :message)';

		try {

			$stmt = $this->prepare($this->sql);
			$stmt->bindParam(':from', $from, PDO::PARAM_STR);
			$stmt->bindParam(':message', $message, PDO::PARAM_STR);
			
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
	* @return string Return SQL query.
	*/
	public function _toString()
	{
		if (is_null($this->sql)) {
			return 'NULL';
		}
		return $this->sql; 
	}
}
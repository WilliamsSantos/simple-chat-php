<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require 'constants.inc.php';
require 'DbConnPDO.class.php';
require 'Chat.class.php';

# 1 Read the database messages

try {

	$chat 		= new Chat();
	$messages = $chat->getMessages(10);

	echo json_encode($messages);

} catch (Exception $e) {

	$message = 'Ocorreu um erro.';
	
	echo json_encode($message);
	exit;
}
<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require 'constants.inc.php';
require 'DbConnPDO.class.php';
require 'Chat.class.php';

# 1º Read messages from database
try {
 	$chat 	 = new Chat();
 	$message = $chat->getMessages(10);

 	echo json_encode($messages);
} catch (Exception $e) {
	$message = 'Ocorreu um erro.';
	echo json_encode(array(
		"action" 		=> "insert",
		"notification" 	=> "error",
		"message" 		=> $message
		)
	);
	exit;
}

<?php

require 'constants.inc.php';
require 'DbConnPDO.class.php';
require 'User.class.php';

$nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_STRING);
$message  = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

# 1º Insert message into database
try {
	$chat = new Chat();
	$chat->insert($nickname, $message);
} catch (Exception $e) {
	echo 'ocorreu um erro ao fazer  o INSERT na DB<br>';
	echo $chat->_toString();
}
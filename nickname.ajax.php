<?php

session_start();

require 'constants.inc.php';
require 'DbConnPDO.class.php';
require 'User.class.php';

//Define a variable with nickname request by POST method
$nickname =  filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_STRING);

# 1º Check if the nickname have 3 minimum characters

if (strlen($nickname) < 3) {
	$message = 'O nickname deve conter pelo menos 3 caracteres.';
	echo json_encode(array(
			'action' 		=> 'insert',
			'notification'	=> 'error',
			'message' 		=> $message 
		);
	exit;
	);
}

# 2º Check if the nickname exists in the database
try {
	$user  = new User();
	$nickname_exists = $user->checkNicknameExistis($nickname);
	if ($nickname_exists) {
		$message = 'Este nickname já existe.';
		echo json_encode(array(
			'action' 		=> 'insert',
			'notification'	=> 'error',
			'message' 		=> $message 
			);
		exit;
		);
	}
} catch (Exception $e) {
	$message = 'Ocorreu um Erro.';
	echo json_encode(array(
		'action' 		=> 'insert',
		'notification'	=> 'error',
		'message' 		=> $message 
		);
	exit;
	);
}

# 3º Insert the nickname in the database

try {
	$user->insert($nickname);

	$_SESSION['nickname'] = $nickname;
	echo json_encode(array(
			'action' => 'replace',
			'notification' => 'success',
			'message' => 'Olá '.$nickname.', aguarde por favor...' 
		)
	);
} catch (Exception $e) {
	$message = 'Ocorreu um Erro.';
	echo json_encode(array(
		'action' 		=> 'insert',
		'notification'	=> 'error',
		'message' 		=> $message 
		);
	exit;
	);
}
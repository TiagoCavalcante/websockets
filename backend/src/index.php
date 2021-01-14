<?php
	# includes
	require __DIR__ . '/../vendor/autoload.php';
	require_once __DIR__ . '/Chat.php';

	# use namespaces
	use Ratchet\Server\IoServer;
	use Chat\ChatServer;

	$server = new Ratchet\App('localhost', 8080);
	$server->route('/chat', new ChatServer(), ['*']);
	$server->run();
?>

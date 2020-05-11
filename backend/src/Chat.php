<?php
	namespace Chat;

	use Exception;
	use SplObjectStorage;
	use Ratchet\ConnectionInterface;
	use Ratchet\MessageComponentInterface;
	
	final class ChatServer implements MessageComponentInterface {
		private $clients;
	
		public function __construct() {
			$this->clients = new SplObjectStorage();
		}
	
		public function onOpen(ConnectionInterface $connection) : void {
			$this->clients->attach($connection);
			$connection->send(json_encode([
				'name' => 'SERVER',
				'message' => 'Hello, world!'
			]));
		}
	
		public function onMessage(ConnectionInterface $from, $msg) : void {
			foreach ($this->clients as $client)
				$client->send($msg);
		}
	
		public function onClose(ConnectionInterface $connection) : void {
			$this->clients->detach($connection);
		}
	
		public function onError(ConnectionInterface $connection, \Exception $exception) : void {
			$connection->close();
		}
	}
?>
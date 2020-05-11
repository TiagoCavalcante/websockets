const webSocket = new WebSocket('ws://localhost:8080/chat');

webSocket.addEventListener('message', event => {
	const data = JSON.parse(event.data);
	document.getElementById('chat').innerHTML += "<p><b>" + data.name + " say: </b>" + data.message + "</p>";
});

document.getElementById('message').addEventListener('keyup', () => {
	if (event.keyCode === 13) {
		webSocket.send(JSON.stringify({
			name: document.getElementById('name').value,
			message: document.getElementById('message').value
		}));
		document.getElementById('message').value = '';
	}
});
<?php
  $host = "123.31.47.47";
  $port = 8888;
  $socket = fsockopen($host, $port);
  $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
  if ($socket === false) {
      echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
  } else {
      echo "SOCKET OK.\n";
  }

  echo "Attempting Connection...";
  $result = socket_connect($socket, $host, $port);
  if($result == false){
    echo "socket_connection() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
  }
  else{
    $query = 'GET / HTTP/1.0'."\r\n".
	'User-Agent: NTRIP LefebureNTRIPClient/20131124'."\r\n".
	'Accept:*/*'."\r\n".
	'Connection: close'."\r\n".
	'Authorization: Basic a2ltbGFpOmtpbWxhaQ=='."\r\n\r\n";
	socket_write ($socket, $query, strlen ($query));

	while($buffer=@socket_read($socket,512,PHP_NORMAL_READ)){
		echo $buffer.'<br/>';
	}
  }
  socket_close($socket);
  echo "Closing socket.";
?>


     

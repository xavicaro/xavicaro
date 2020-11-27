<?php
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Accept, X-Access-Token, X-Application-Name, X-Request-Sent-Time');

    $server   = 'localhost:3306';
    $username = 'blancticketing';
    $password = 'b74ancf357iva1@#tick';
    $database = 'ticketup';

     // Connect to the server with our settings defined above.
    $connection = new mysqli($server, $username, $password, $database );

	if ($connection->connect_error) 
	{
		die("Connection failed: " . $connection->connect_error);
	}
	
	$ticket = urldecode($_GET["ticket"]);
		
	$res = $connection -> query("SELECT * FROM `futura_space` WHERE codes = '$ticket'");

	while($row = $res->fetch_array())
	{
		$rows[] = $row;
	}

	if (isset($rows)) 
	{
		echo "1"; //El código existe
	}
	else 
	{
		echo "0"; //El código no existe.
	}
	
	
	 
	
$connection ->close();

?>
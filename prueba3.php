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
		
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	
	$ticket = urldecode($_GET["ticket"]);

	$consulta = "INSERT INTO `futura_space` (`id_futura_space`, `codes`) VALUES (NULL, '$ticket')";

	if ($connection -> query($consulta) === TRUE)
	echo "Inserted!";

	//printf("Result (UPDATE): %d\n", $connection->affected_rows);


	$connection ->close();

?>
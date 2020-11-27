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

	// Código que viene del formulario, introducido por el asistente
$codigoScann = $ticket;

// Genero un array con los dos IDs obtenidos de $codigoScann
$codes = explode("-", $codigoScann);
$id_purchaser   = $codes[0];
$id_attendee    = $codes[1];
    
// ID del evento
$evento = 104;

// Consulta para verificar que el ticket es válido.
// Primero relaciona el asistente con el comprador y el evento
// En los datos del comprador, verifica que no está anulado, y que hay un valor en 'invoice' o en 'receipt’.
// Esta consulta devuelve también los datos del ticket (por si necesitáis también el nombre de la entrada u otro dato)
$res = $connection -> query("SELECT * FROM `attendees` JOIN `purchasers` ON `purchasers`.`id_purchaser` = `attendees`.`id_purchaser` JOIN `tickets` ON `tickets`.`ticket_id` = `attendees`.`ticket_id` WHERE `attendees`.`id_purchaser` = $id_purchaser AND `attendees`.`id_attendee` = $id_attendee AND `attendees`.`event_id` = $evento AND `purchasers`.`annulled` != 1 AND (`purchasers`.`invoice` !=0 OR `purchasers`.`receipt` !=0)");

while($row = $res->fetch_array())
	{
		$rows[] = $row;
	}

	if (isset($rows)) 
	{
	
		foreach($rows as $row)
		{
			echo $row[4];
		}
	}
	else 
	{
		echo "-1";
	}	
	

	
$connection ->close();

?>
<?php
//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'r007');
define('DB_NAME', 'energy');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}
//SELECT date(horario) as date, ROUND(SUM(potencia)/(3600000)*(0.62378769 ),2) AS preco, HOUR(horario) as hora, DATE_FORMAT(CURDATE(), '%d-%m-%y') as dia from medidas where DATE(horario)= CURDATE() GROUP BY hora ASC

//query to get data from the table
$query = sprintf("SELECT date(horario) as dia, ROUND(SUM(potencia)/(3600000)*(0.62378769 ),2) AS preco, HOUR(horario) as hora from medidas where DATE(horario)=CURDATE() GROUP BY hora ASC");
////execute query
//$query = sprintf("SELECT DATE_FORMAT(horario,'%d') AS dia, SUM(potencia) AS pot FROM medidas");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);

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

//query to get data from the table
$query = sprintf("SELECT ROUND(SUM(potencia)/(3600000)*(0.62378769 ),2) AS preco, HOUR(horario) as hora, date_format(curdate(), '%d-%m-%y') as dia from medidas where date(horario)= curdate() group by hora asc");

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

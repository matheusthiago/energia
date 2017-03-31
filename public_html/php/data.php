<?php

//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'r007');
define('DB_NAME', 'energy');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$mysqli) {
    die("Connection failed: " . $mysqli->error);
}
$query = sprintf("SELECT concat(DAY( horario ), '/', MONTH( horario )) AS diaMes, DAY( horario ) AS dia, ROUND((SUM(potencia)/3600000)*(0.62378769 ),2) AS preco FROM medidas GROUP BY dia ORDER BY YEAR(horario) ASC, MONTH(horario) ASC, dia ASC LIMIT 30");//execute query
$result = $mysqli->query($query);
//loop through the returned data
$data = array();
foreach ($result as $row) {
    $data[] = $row;
}
// $data= array_slice($data , count($data)-30, 30);
//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);

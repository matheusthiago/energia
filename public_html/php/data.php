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

//query to get data from the table
//$query = sprintf("SELECT concat(DAY(horario), '/', MONTH(horario)) as diaMes, ROUND(SUM(potencia/1000),2) AS pot, Day(horario) AS day FROM medidas GROUP BY day");
//$query = sprintf("SELECT concat(DAY(horario), '/', MONTH(horario)) as diaMes, DAY(horario) as dia, ROUND(SUM(potencia/1000),2) AS pot, 
//ROUND(SUM(potencia/1000)/(3600*24)*(0.62378769),2) as preco FROM medidas group by dia");

$query = sprintf("SELECT concat( DAY( horario ) , '/', MONTH( horario ) ) AS diaMes, DAY( horario ) AS dia, ROUND( SUM( potencia /1000 ) , 2 ) AS pot, ROUND( SUM( potencia /1000 ) / count( second( horario ) /3600 ) * ( 0.62378769 ) , 2 ) AS preco, (
count( second( horario ) ) /3600
) AS conthora
FROM medidas
GROUP BY diaMes
ORDER BY 'medidas.horario'");
//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
    $data[] = $row;
}
 $data= array_slice($data , count($data)-30, 30);
//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);

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
$query = sprintf("SELECT concat(dia,'/',mes) as diaMes, dia, round((sum(potencia))*(0.62378769),2) as preco from medidasHora group by dia, mes, ano order by ano asc, mes asc, dia asc"); //execute query
$result = $mysqli->query($query);
//loop through the returned data
$data = array();
foreach ($result as $row) {
    $data[] = $row;
}
$data = array_slice($data, count($data) - 30, 30);
//free memory associated with result
$result->close();
//close connection
$mysqli->close();
//now print the data
print json_encode($data);
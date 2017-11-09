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
//$query = sprintf("SELECT concat(dia,'/',mes) as diaMes, dia, round((sum(potencia))*(0.62378769),2) as preco from medidasHora group by dia, mes, ano order by ano asc, mes asc, dia asc"); //Ultimos 30 dias
//$query = sprintf("SELECT concat(dia,'/',mes) as diaMes, dia, ROUND(SUM(potencia)*(0.58847192),2) AS preco, sum(potencia) AS pot  FROM medidasHora WHERE (mes=04 and dia>=07) OR (mes=5 and dia<=9)group by dia, mes, ano order by ano asc, mes asc, dia asc"); // mes 4-5
//$query= sprintf("SELECT concat(dia,'/',mes) as diaMes, dia, ROUND(SUM(potencia)*(0.61342401),2) AS preco, sum(potencia) AS pot FROM medidasHora WHERE (mes=03 and dia>=09) OR (mes=4 and dia<07)group by dia, mes, ano order by ano asc, mes asc, dia asc"); // mes 3-4
//$query= sprintf("SELECT concat(dia,'/',mes) as diaMes, dia, ROUND(SUM(potencia)*(0.61342401),2) AS preco, sum(potencia) AS pot FROM medidasHora WHERE (mes=05 and dia>=09) OR (mes=6 and dia<=08)group by dia, mes, ano order by ano asc, mes asc, dia asc"); // mes 5-6
$query= sprintf("SELECT concat(dia,'/',mes) as diaMes, dia, ROUND(SUM(potencia)*(0.61342401),2) AS preco, sum(potencia) AS pot FROM medidasHora where mes>08 and dia>07 and dia<24 group by dia, mes, ano order by ano asc, mes asc, dia asc");

$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
    $data[] = $row;
}
//$data = array_slice($data, count($data) - 30, 30);
//free memory associated with result
$result->close();
//close connection
$mysqli->close();
//now print the data
print json_encode($data);

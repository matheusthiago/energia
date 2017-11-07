<?php

//setting header to json
header('Content-Type: application/json');
////SELECT ROUND(SUM(potencia)*(0.588),2) AS preco, sum(potencia) FROM medidasHora WHERE (mes=04 and dia>=07) OR (mes=5 and dia<=9)
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
//$query = "SELECT ROUND(SUM(potencia)*(0.62378769 ),2) AS preco, concat(hora,':00') as hora, CONCAT(`dia`,'-',`mes`,'-',`ano`) AS datas FROM medidasHora WHERE (DATE_ADD(STR_TO_DATE((CONCAT(`ano`,',',`mes`,',',`dia`,' ',`hora`)),'%Y,%m,%d %H'), INTERVAL 1 HOUR))>=(DATE_SUB(NOW(), INTERVAL 15 DAY)) GROUP BY `dia`, `hora`";
//$query = "SELECT ROUND(SUM(potencia)) AS preco, concat(hora,':00') as hora, CONCAT(`dia`,'-',`mes`,'-',`ano`) AS datas FROM medidasHora where mes>08 and dia>07 and dia<24 group by `dia`, `hora`";
$result = $mysqli->query($query) or die(mysqli_error());
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

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

if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
//SELECT concat((hour(horario)),(day(horario)),(month(horario)),(year(horario))) as id, ROUND(SUM(potencia)/(3600000),2) AS kwh, HOUR(horario) as hora from medidas where hour(horario)=hour(now())-1 and curdate()=date(horario)
//$query = sprintf("SELECT concat(DAY(horario), '/', MONTH(horario)) as diaMes, ROUND(SUM(potencia/1000),2) AS pot, Day(horario) AS day FROM medidas GROUP BY day");
/*select concat((hour(horario)),(day(horario)),(month(horario)),(year(horario))) as id, ROUND(SUM(potencia)/(3600000)*0.6,2) as kwh, hour(horario), curdate()-1=date(horario)  from medidas where
(curdate()=date(horario) and hour(horario)=hour(now())-1) 
OR  
((curdate()-1)=date(horario) and hour(horario)='0'

 * )
 */
$query = sprintf("SELECT concat(DAY(horario), '/', MONTH(horario)) as diaMes, DAY(horario) as dia, ROUND(SUM(potencia/1000),2) AS pot, 
ROUND(SUM(potencia)/(3600000)*(0.62378769),2) as preco FROM medidas group by dia");


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

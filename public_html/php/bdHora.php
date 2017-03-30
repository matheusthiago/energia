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

// Check connection
if ($mysqli->connect_error) {
    die("Falha na conecao com o bd: " . $mysqli->connect_error);
}
$sql="select concat((hour(horario)),(day(horario)),(month(horario)),(year(horario))) as id,
    ROUND(SUM(potencia)/(3600000),2) as kwh
    from medidas 
    where(curdate()=date(horario) and hour(horario)=hour(now()))";
$result=$mysqli->query($sql);
if ($result ->num_rows>0){
    while($row=$result->$fetch_assoc()){
        echo "id:".$row["id"]." kwh".$row["kwh"];
    }
    }
else {
    echo "0 results";
}
    $mysqli->close();
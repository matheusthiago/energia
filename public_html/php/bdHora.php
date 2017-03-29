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

$row="select concat((hour(horario)),(day(horario)),(month(horario)),(year(horario))) as id,
    ROUND(SUM(potencia)/(3600000),2) as kwh,
    from medidas 
    where(curdate()=date(horario) and hour(horario)=hour(now()))";
//$result = $mysqli->query($query);
/*$data = array();
foreach ($result as $row) {
    $data[] = $row;
}
echo "sql".$data;
*/
//Array
       while ($row = mysql_fetch_array($result)) {
          echo $row[0];
          echo $row[1] ;
       }

 $hh=11;
 $dd=11;
$mm=11;
$yy=1171;
$pot=1200;
$id=$hh.$dd.$mm.$yy;
echo $id;
//$sql = "INSERT INTO medidasHora(id,potencia) VALUES ('$id','+$pot+')";

if ($mysqli->query($sql) === TRUE) {
    echo "Os dados foram salvos com sucesso";
} else {
    echo "Erro de salvamento no bd. Error: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
?>

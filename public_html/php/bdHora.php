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
$hh=00;
$dd=00;
$mm=00;
$yy=0000;
$pot=strval(1200);
$id.=strval(hh);
$id.=strval(dd);
$id.=strval(mm);
$id.=strval(yy);
$sql = "INSERT INTO medidasHora(id,potencia) VALUES ('"+$id+"','12000')";

if ($mysqli->query($sql) === TRUE) {
    echo "Os dados foram salvos com sucesso";
} else {
    echo "Erro de salvamento no bd. Error: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
?>

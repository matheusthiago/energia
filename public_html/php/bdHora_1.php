<?php

//setting header to json
//SELECT round(sum(potencia)*0.6,2) as tot, id as id, substring(id,3,2) from medidasHora group by substring(id,3,2)
header('Content-Type: application/json');

//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'r007');
define('DB_NAME', 'energy');

//Create connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
for($i=0;$i<=20;$i++){
$sql = "select (hour(horario)) as hora,(day(horario)) as dia,(month(horario)) as mes,(year(horario)) as ano,
             (SUM(potencia)/(3600000) AS kwh, HOUR(horario) as hora 
            from medidas where DATE(horario)=(DATE_ADD(CURDATE(), INTERVAL -1 DAY)) GROUP BY hora ASC";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dia = menorQue9($row["dia"]);
        $mes = menorQue9($row["mes"]);
        $hora = menorQue9($row["hora"]);
        $ano = menorQue9($row["ano"]);
        $id = $hora . $dia . $mes . $ano;
        $kwh = $row["kwh"];
        echo "id: " . $id . "kwh:" . $kwh . "<br>";
        $insert = "insert into medidasHora (id,potencia) values ('" . $id . "','" . $kwh . "')";

        if ($conn->query($insert) == TRUE) {
            echo "\n Salvo com Sucesso";
        } else {
            echo " Error" . $insert . $conn->error;
        }
    }
} else {
    echo "0 results";
}
$conn->close();

function menorQue9($valor) {
    return $valor < 10 ? '0' . $valor : $valor;
}
?>
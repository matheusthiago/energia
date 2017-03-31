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
$sql = "select (hour(horario)) as hora,"
        . "(day(horario)) as dia,"
        . "(month(horario)) as mes,"
        . "(year(horario)) as ano,"
        . "(SUM(potencia)/(3600000)) AS kwh,"
        . "HOUR(horario) as hora"
        . " from medidas "
        . "where date(horario) between '2017-02-20' and curdate() "
        . "group by hour(horario) , date(horario)";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hora = menorQue9($row["hora"]);
        $dia = menorQue9($row["dia"]);
        $mes = menorQue9($row["mes"]);
        $ano = menorQue9($row["ano"]);
        $id = $hora . $dia . $mes . $ano;
        $kwh = $row["kwh"];
        echo "id: " . $id . "kwh:" . $kwh . "<br>";
        $insert = "insert into medidasHora(id,potencia, hora, dia, mes, ano) values ('','" . $kwh . "','" . $hora . "','" . $dia . "','" . $mes . "','" . $ano . "')";

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
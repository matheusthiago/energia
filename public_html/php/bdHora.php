<?php

//setting header to json
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
if (date('H-i') == '00-00') {
    $sql = "select (hour(horario)) as hora,(day(horario)) as dia,(month(horario)) as mes,(year(horario)) as ano,
    (SUM(potencia)/(3600000)) as kwh
    from medidas 
    where(DATE_ADD(CURDATE(), INTERVAL -1 DAY)=date(horario) and hour(horario)=(hour(DATE_ADD((now()),INTERVAL -1 hour))))";
} else {
    $sql = "select (hour(horario)) as hora,(day(horario)) as dia,(month(horario)) as mes,(year(horario)) as ano,
    (SUM(potencia)/(3600000)) as kwh
    from medidas 
    where(curdate()=date(horario) and hour(horario)=(hour(DATE_ADD((now()),INTERVAL -1 hour))))";
}
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
    $dia = menorQue9($row["dia"]);
    $mes = menorQue9($row["mes"]);
    $hora = menorQue9($row["hora"]);
    $ano = menorQue9($row["ano"]);
    $id=$hora.$dia.$mes.$hora.$ano;
    $kwh = $row["kwh"];
    echo 'id:  '.$id.' potencia '.$kwh."','" . $hora . "','" . $dia . "','" . $mes . "','" . $ano . "'";
    $insert = "insert into medidasHora(id,potencia, hora, dia, mes, ano) values ('".$id."','". $kwh . "','" . $hora . "','" . $dia . "','" . $mes . "','" . $ano . "')";

    if ($conn->query($insert) == TRUE) {
        echo "\n Salvo com Sucesso";
    } else {
        echo " Error" . $insert . $conn->error;
    }
} else {
    echo "0 results";
}
$conn->close();
function menorQue9($valor) {
    return $valor < 10 ? '0' . $valor : $valor;
}

?>
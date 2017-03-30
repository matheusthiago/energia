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

$sql = "select (hour(horario)) as hora,(day(horario)) as dia,(month(horario)) as mes,(year(horario)) as ano,
    ROUND(SUM(potencia)/(3600000),2) as kwh
    from medidas 
    where(curdate()=date(horario) and hour(horario)=hour(now()))";
$result = $conn->query($sql);

function menorQue9($valor) {
    return $valor < 10 ? '0' . $valor : $valor;
}

if ($result->num_rows > 0) {

    // output data of each row
    $row = $result->fetch_assoc();
    $dia = menorQue9($row["dia"]);
    $mes = menorQue9($row["mes"]);
    $hora = menorQue9($row["hora"]);
    $ano = menorQue9($row["ano"]);
    $id = $hora . $dia . $mes . $ano;
    echo "id: " . $id . "kwh:" . $row["kwh"];
    $insert = "insert into medidasHora (id,potencia) values ('".$id . "','".$kwh."')";
  
    if ($conn->query($insert)==TRUE) {
        echo "Salvo com Sucesso";
    } else {
        echo " Error" . $insert . $conn->error;
    }
} else {
    echo "0 results";
}
$conn->close();
?>
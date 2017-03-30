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
echo "antes da conceccao";
$sql = "select concat((hour(horario)),(day(horario)),(month(horario)),(year(horario))) as id,
    ROUND(SUM(potencia)/(3600000),2) as kwh
    from medidas 
    where(curdate()=date(horario) and hour(horario)=hour(now()))";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]."kwh:".row["kwh"]."<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
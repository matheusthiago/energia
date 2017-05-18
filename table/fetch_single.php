<?php

include('db.php');
include('function.php');
if (isset($_POST["user_id"])) 
    {
    $output = array();
    $statement = $connection->prepare(
            "SELECT * FROM users 
		WHERE id = '" . $_POST["user_id"] . "' 
		LIMIT 1"
    );
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $output["nome"] = $row["nome"];
        $output["email"] = $row["email"];
        $output["nivel"] = $row["nivel"];
        $output["senha"] = $row["senha"];
    }
    echo json_encode($output);
}
?>
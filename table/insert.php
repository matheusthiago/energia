<?php
include('db.php');
include('function.php');
if (isset($_POST["operation"])) {
    if ($_POST["operation"] == "Add") {
        $statement = $connection->prepare("
			INSERT INTO users (nome, email, nivel, senha) 
			VALUES (:nome, :email, :nivel, :senha)
		");
        $result = $statement->execute(
                array(
                    ':nome' => $_POST["nome"],
                    ':email' => $_POST["email"],
                    ':nivel' => $_POST["nivel"],
                    ':senha' => $_POST["senha"]
                )
        );
        if (!empty($result)) 
            {
            echo 'Data Inserted';
        }
    }
    if ($_POST["operation"] == "Edit") 
        {
        $statement = $connection->prepare(
                "UPDATE users 
			SET nome = :nome, email = :email, nivel = :nivel, senha = :senha  
			WHERE id = :id
			"
        );
        $result = $statement->execute(
                array(
                    ':nome' => $_POST["nome"],
                    ':email' => $_POST["email"],
                    ':nivel' => $_POST["nivel"],
                    ':senha' => $_POST["senha"],
                    ':id' => $_POST["user_id"]
                )
        );
        if (!empty($result)) {
            echo 'Data Updated';
        }
    }
}
?>
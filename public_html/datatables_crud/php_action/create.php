<?php

require_once './db_connect.php'; // if form is submitted if ($_POST)
{
    $validator = array('success' => false, 'messages' => array());
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "INSERT INTO members (id,username, email, password, salt) values ('','$username','$email', '$password', '')";
    $query = $connect->query($sql);
    if ($query === TRUE) {
        $validator['success'] = true;
        $validator['messages'] = "Successfully Added";
    } else {
        $validator['success'] = false;
        $validator['messages'] = "Error while adding the member information";
    }

// close the database connection
    $connect->close();

    echo json_encode($validator);
}


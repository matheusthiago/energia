<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM users ";
if (isset($_POST["search"]["value"])) {
    $query .= 'WHERE nome LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR email LIKE "%' . $_POST["search"]["value"] . '%" ';
}
if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= 'ORDER BY id DESC ';
}
if ($_POST["length"] != -1) 
    {
    $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach ($result as $row) {
    $sub_array = array();
    $sub_array[] = $row["nome"];
    $sub_array[] = $row["email"];
    $sub_array[] = $row["nivel"];
    $sub_array[] = $row["senha"];
    $sub_array[] = '<button type="button" name="update" id="' . $row["id"] . '" class="btn btn-outline btn-default btn-xs update"><i class="fa fa-edit"></i>Update</button>'
            . '<button type="button" name="delete" id="' . $row["id"] . '" class="btn btn-default btn-xs delete"><i class="fa fa-times"></i> delete</button>';
    $data[] = $sub_array;
}
$output = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => $filtered_rows,
    "recordsFiltered" => get_total_all_records(),
    "data" => $data
);
echo json_encode($output);

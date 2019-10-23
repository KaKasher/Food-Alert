<?php
require_once "../login/connect.php";

// Create database connection 
$conn = new mysqli($host, $db_user, $db_password, $db_name);

$result = mysqli_query($conn, "SELECT * FROM markers");

$data = array();
while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
}

echo json_encode($data);
exit();

?>
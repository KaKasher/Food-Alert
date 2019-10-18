<?php
session_start();
require_once "../login/connect.php";

$conn = new mysqli($host, $db_user, $db_password, $db_name);

$product = $_POST['item'];
$comment = $_POST['comment'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$nick = $_SESSION['yournick'];
$address = $_POST['address'];
var_dump($product);
var_dump($comment);
var_dump($lat);
var_dump($lng);

$query = "INSERT INTO markers (id, product, comment, lat, lng, address, nick) VALUES (NULL, '{$product}', '{$comment}', '{$lat}', '{$lng}', '{$address}', '{$nick}')";
mysqli_query($conn, $query);
?>
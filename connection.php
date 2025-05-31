<?php
// $host = "localhost";
// $user = "root";
// $database_name = "everlane";
// $password = "";
// $conn = mysqli_connect($host, $user, $password, $database_name);
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }
$host = "sql100.infinityfree.com";
$user = "if0_37711788";
$database_name = "if0_37711788_everlane";
$password = "Sharif12345678";
$conn = mysqli_connect($host, $user, $password, $database_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

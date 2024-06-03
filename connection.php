<?php
$host = "localhost";
$user = "root";
$database_name = "everlane";
$password = "";
$conn = mysqli_connect($host, $user, $password, $database_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// $host = "sql208.infinityfree.com";
// $user = "if0_36240160";
// $database_name = "if0_36240160_everlane";
// $password = "Shar55501102002";
// $conn = mysqli_connect($host, $user, $password, $database_name);
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

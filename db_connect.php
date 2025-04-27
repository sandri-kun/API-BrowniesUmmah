<?php
$host = "mysql7.serv00.com";
$username = "m5329_admin";
$password = "MmBdW[hW60'VeM0eJdQDc3q+*JwH26";
$database = "m5329_admin";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
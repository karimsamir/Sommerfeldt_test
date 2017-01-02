<?php

$host = "localhost";
$username = "scott";
$password = "some_password";
$db_name = "Sommerfeldt_test";

$connect_db = new mysqli($host, $username, $password, $db_name);

if (mysqli_connect_errno()) {
    printf("Connection failed: %s", mysqli_connect_error());
    exit();
}
?>
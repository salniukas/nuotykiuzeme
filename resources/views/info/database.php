<?php
$conn = mysqli_connect("localhost", "root", "tM64wPt1", "Aleradas");

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$conn->query("SET NAMES utf8");

?>
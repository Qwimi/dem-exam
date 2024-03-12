<?php
try {
    $host = "localhost";
    $db_name = "nn_dem_m";
    $user_name = "root";
    $password = "";
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $user_name, $password);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage();
    die();
}
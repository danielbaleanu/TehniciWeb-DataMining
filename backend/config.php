<?php

$servername = "localhost";

$username = "root";

$password = "";

try {

    $connect = new PDO("mysql:host=$servername; dbname=loginSysTutorial", $username, $password);

    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Conectare cu succes";
} catch (PDOException $e) {

    echo "Conexiune eșuată " . $e->getMessage();
}

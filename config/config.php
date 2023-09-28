<?php

try {
    //host
    define("HOST", "localhost");

    //user
    define("USER", "root");

    //pass
    define("PASS", "");

    //dbname
    define("DBNAME", "hotel-booking");


    $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME . "", USER, PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $Exception) {

    echo $Exception->getMessage();
}

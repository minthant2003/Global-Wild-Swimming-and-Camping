<?php
    $uname = "L5DC";
    $pass = "L5DC";
    $host = "localhost:3307";

    try {
        $conn = new mysqli($host, $uname, $pass);

        $sql = "CREATE DATABASE GWSC";
        $conn->query($sql);

    } catch(Exception $e) {
        echo $e;
    } 

    $conn->close();
?>
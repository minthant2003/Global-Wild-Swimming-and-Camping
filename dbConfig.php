<?php 
    $uname = "L5DC";
    $pass = "L5DC";
    $host = "localhost:3307";
    $db = "GWSC";

    try {
        $conn = new mysqli($host, $uname, $pass, $db);

    } catch(Exception $e) {
        echo $e;
    }
?>
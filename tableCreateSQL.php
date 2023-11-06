<?php
    require 'dbConfig.php';

    try {
        $sql = "CREATE TABLE Customer(
            Customer_ID int AUTO_INCREMENT,
            Username varchar(20),
            First_name varchar(20),
            Last_name varchar(20),
            Password varchar(255),
            Email varchar(30),
            Phone varchar(30),
            PRIMARY KEY(Customer_ID)
            )";
        $conn->query($sql);

    } catch(Exception $e) {
        echo $e;
    }

    $conn->close();
?>
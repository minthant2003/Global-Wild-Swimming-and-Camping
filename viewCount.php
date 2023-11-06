<?php
    require 'dbConfig.php';

    try {        
        $sql = "SELECT * FROM viewcount WHERE viewcount_id = 1";
        $result = $conn->query($sql);
        $row = $result->fetch_object();

        $num = $row->viewcount_no;
        $num += 1;

        $sql = "UPDATE viewcount SET viewcount_no = " . $num . " WHERE viewcount_id = 1";
        $conn->query($sql);

        $sql = "SELECT * FROM viewcount WHERE viewcount_id = 1";
        $result = $conn->query($sql);
        $row = $result->fetch_object();

        $final = $row->viewcount_no;

        echo $final;

        $conn->close();

    } catch(Exception $e) {
        echo $e;
    }
?>
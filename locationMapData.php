<?php
    require 'dbConfig.php';

    header('Content-Type: application/json');

    try {
        $sql = "SELECT Name, Lat, Log FROM site";
        $result = $conn->query($sql);
        
        if($result->num_rows > 0) {
            while($row = $result->fetch_object()) {
                $data[] = $row;
            }

            $mapData = json_encode($data);
            echo $mapData;
        }

    } catch(Exception $e) {
        echo $e;
    }

    $conn->close();
?>
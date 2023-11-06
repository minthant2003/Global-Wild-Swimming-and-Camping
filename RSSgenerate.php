<?php
    require 'dbConfig.php';

    $sql = "SELECT Site_ID, Name, Category, Lat, Log FROM site";
    $result = $conn->query($sql);

    $str = "<?xml version='1.0' encoding='UTF-8'?>";
    $str .= "<rss version='2.0'>";
    $str .= "<GWSC>";

    while($obj = $result->fetch_object()) {
        $str .= "<Site>";
        $str .= "<ID>" . $obj->Site_ID . "</ID>";
        $str .= "<Name>" . $obj->Name . "</Name>";
        $str .= "<Category>" . $obj->Category . "</Category>";
        $str .= "<Lat>" . $obj->Lat . "</Lat>";
        $str .= "<Log>" . $obj->Log . "</Log>";
        $str .= "</Site>";
    }

    $str .= "</GWSC>";
    $str .= "</rss>";

    file_put_contents("RSSfeed.xml", $str);
    $conn->close();
?>
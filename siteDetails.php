<?php 
    session_start();
    require 'dbConfig.php';

    $id = $_GET['id'];
    try {
        $sql = "SELECT amenity.Description, site.Name, site.Lat, site.Log, site.Img_name, site.Category, site.Camping_type FROM amenity
                INNER JOIN site_amenity ON amenity.Amenity_ID = site_amenity.Amenity_ID
                INNER JOIN site ON site_amenity.Site_ID = site.Site_ID
                WHERE site.Site_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $amenResult = $stmt->get_result();
        $stmt->close();        

        $sql = "SELECT area.Name AS area_name, attraction.Name AS att_name FROM site
                INNER JOIN area ON site.Area_ID = area.Area_ID
                INNER JOIN attraction ON area.Area_ID = attraction.Area_ID
                WHERE site.Site_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $attResult = $stmt->get_result();        
        $stmt->close();        
        $conn->close();
        
        while($row = $amenResult->fetch_object()) {
            $amenities[] = $row->Description;
            $site_name = $row->Name;            
            echo "<script>";
            echo "var lat = " . $row->Lat;
            echo "</script>";            
            echo "<script>";
            echo "var log = " . $row->Log;
            echo "</script>";
            $img = $row->Img_name;
            $cat = $row->Category;
            $camp_type = $row->Camping_type;
        }                         
        while($row = $attResult->fetch_object()) {
            $attractions[] = $row->att_name;           
            $area = $row->area_name;
        }        
    } catch(Exception $e)  {
        echo $e;
    }    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Wild Swimming & Camping</title>

    <link rel="stylesheet" href="myStyle.css"/>
    <link rel="icon" href="uploads/logoTrans.png" type="image/icon type">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">    

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
            crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>    

    <!-- img start -->
    <div class="wrapper-white">
        <div class="container">
            <div class="row detail-row">
                <h2>Site Details of <?php echo $site_name; ?></h2>
            </div>
            <div class="row img-row">
                <img src="sites/<?php echo $img; ?>" alt="site-img" id="site-img">
                <div>
                    <div>
                        <p class="p-bold font-lger">Located in - <?php echo $area; ?></p>
                        <br/>
                        <p class="p-bold font-lger">Category - <?php echo $cat; ?></p>
                        <br/>
                        <?php if(isset($camp_type)) { ?>
                            <p class="p-bold font-lger">Camping type - <?php echo $camp_type; ?></p>
                            <br/>
                        <?php } ?>
                    </div>
                    <div class="weather-call">
                        <div class="row row-icon">
                            <img src="" alt="weather-icon" id="weather-icon">
                        </div>
                        <p id="description" class="font-lger"></p>
                        <p id="main" class="font-lger"></p>
                        <p id="max" class="font-lger"></p>
                        <p id="min" class="font-lger"></p>
                        <p id="wind" class="font-lger"></p>
                        <small id="info" class="p-red">Please wait for a moment for weather informations...</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- img end -->

    <!-- amenities and attractions start -->
    <div class="wrapper-grey">
        <div class="container">
            <div class="row img-row att-row">
                <div>
                    <h3 class="site-head">Amenities for <?php echo $site_name; ?></h3>
                    <ul class="font-lg site-info">
                        <?php foreach($amenities as $item) { ?>
                            <li><?php echo $item; ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <div>
                    <h3 class="site-head">Local Attractions near <?php echo $site_name; ?></h3>
                    <ul class="font-lg site-info">
                        <?php foreach($attractions as $item) { ?>
                            <li><?php echo $item; ?></li>
                        <?php } ?>
                    </ul>                    
                </div>
            </div>
        </div>
    </div>
    <!-- amenities and attractions end -->

    <!-- map start -->
    <div class="wrapper-white">
        <div class="container">
            <div class="row location-gwsc-title">
                <h2 class="p-black">Location of <?php echo $site_name; ?></h2>&nbsp;&nbsp;&nbsp;
                <i class="fa fa-location-arrow fa-2x p-black"></i>
            </div>
            <div class="row row-map">
                <div id="map"></div>
            </div>
        </div>
    </div>
    <!-- map end -->

    <?php include 'footer.php'; ?>
    
    <script>
        // weather service start
        fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${log}&appid=cacc30c0cd1c4e848e8310292927da90`)        
            .then(response => response.json())
            .then(data => {
                const icon = document.getElementById('weather-icon');                
                const desc = document.getElementById('description');
                const main = document.getElementById('main');
                const max = document.getElementById('max');
                const min = document.getElementById('min');
                const wind = document.getElementById('wind');
                const info = document.getElementById('info');
                
                icon.setAttribute('src', 'https://openweathermap.org/img/wn/' + data.weather[0].icon + '.png');
                desc.innerHTML = "Description: " + data.weather[0].description;
                main.innerHTML = "Main: " + data.weather[0].main;
                max.innerHTML = "Max Temp: " + data.main.temp_max + "*C";
                min.innerHTML = "Min Temp: " + data.main.temp_min + "*C";
                wind.innerHTML = "Wind speed: " + data.wind.speed;
                info.innerHTML = "";
            })
            .catch(err => console.log(err));
        // weather service end
  
        window.onload = () => {
            const view = document.getElementById('view');
            view.innerHTML += sessionStorage.getItem("count") + ".";
        }
    </script>
    <script src="currentPage.js"></script>
    <script src="logout.js"></script>
    <script src="locationMapLoad.js"></script>
</body>
</html>
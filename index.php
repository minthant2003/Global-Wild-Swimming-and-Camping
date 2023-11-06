<?php session_start(); ?>
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
    
    <?php include('header.php'); ?>
    <!-- search button start -->
    <div class="wrapper-white">
        <div class="container">
            <div class="row row-search">
                <div><i class="fa fa-search fa-2x p-green"></i></div>
                <form action="activitySites.php" method="GET" id="search-form">
                    <div><input type="search" placeholder="Eg. Swimming or Camping" name="search"></div>
                    <div>
                        <button type="submit" class="deco-none p-green p-bold font-lger search-btn">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- search button end -->

    <!-- slideshow start-->
    <div class="slider">
        <div class="slides">
            <input type="radio" name="slide-radio" id="radio1">
            <input type="radio" name="slide-radio" id="radio2">
            <input type="radio" name="slide-radio" id="radio3">
            <input type="radio" name="slide-radio" id="radio4">
            <div class="slide first">
                <img src="uploads/slideshow1.jpg" alt="slideshow-img">
            </div>
            <div class="slide">
                <img src="uploads/slideshow2.jpg" alt="slideshow-img">
            </div>
            <div class="slide">
                <img src="uploads/slideshow3.jpg" alt="slideshow-img">
            </div>
            <div class="slide">
                <img src="uploads/slideshow4.jpg" alt="slideshow-img">
            </div>
            <div class="slide-auto">
                <div class="auto-btn1"></div>
                <div class="auto-btn2"></div>
                <div class="auto-btn3"></div>
                <div class="auto-btn4"></div>
            </div>
        </div>
        <div class="slide-manual">
            <label for="radio1" class="manual-btn"></label>
            <label for="radio2" class="manual-btn"></label>
            <label for="radio3" class="manual-btn"></label>
            <label for="radio4" class="manual-btn"></label>
        </div>
    </div>
    <!-- slideshow end -->

    <!-- availability check start -->
    <div class="wrapper-grey">
        <div class="container">
            <div class="row check-title">
                <h2 class="">Pick desired duration & Check availability</h2>&nbsp;&nbsp;&nbsp;
                <i class="fa fa-check-circle fa-2x"></i>
            </div>
            <div class="row check-form-row">           
                <form action="availabilityCheck.php" method="GET" id="check-form">
                    <div>
                        <label for="checkIn" class="font-lg">Check in:</label>
                        <input type="date" id="checkIn" name="checkin" class="checkin">
                    </div>
                    <div>
                        <label for="checkOut" class="font-lg">Check out:</label>
                        <input type="date" id="checkOut" name="checkout" class="checkout">
                    </div>
                    <div>
                        <div class="swim-div">
                            <input type="radio" id="swimming" name="category" value="swimming" required>
                            <label for="swimming" class="font-lg">Swimming</label>
                        </div>
                        <div>
                            <input type="radio" id="camping" name="category" value="camping" required>
                            <label for="camping" class="font-lg">Camping</label>
                            <select name="camptype" id="check-select" class="font-lg">
                                <option value="">---Select Camping type---</option>
                                <option value="tent">Tent</option>
                                <option value="caravan">Caravan</option>
                                <option value="motorhome">Motorhome</option>
                            </select>
                        </div>
                    </div>
                    <div>   
                        <button id="check-btn" type="submit" class="font-lger" name="btn">Check availability</button>
                    </div>
                </form>           
            </div>
        </div>
    </div>
    <!-- availability check start -->

    <!-- gwsc activities start -->
    <div class="wrapper-white">
        <div class="container">
            <div class="row activity-title">
                <h2 class="p-green">GWSC Activities</h2>&nbsp;&nbsp;&nbsp;
                <i class="fa fa-tasks fa-2x p-green"></i>
            </div>
            <div class="row activity-row">            
                <div>
                    <img src="uploads/GWSCactivity1.jpg" alt="activity" class="activity-img">
                </div>
                <div>
                    <div class="d-flex">
                        <h2>Swimming</h2>&nbsp;&nbsp;&nbsp;<i class="bi bi-water fa-2x"></i>
                    </div>
                    <p class="activity-content font-lger">Wild swimming, also known as open water swimming, is a thrilling and liberating way to connect
                        with nature while getting some exercises. These gatherings celebrate the beauty of open water 
                        and the thrill of swimming.</p>
                </div>             
            </div>
            <div class="row activity-row">          
                <div>
                    <div class="d-flex">
                        <h2>Camping</h2>&nbsp;&nbsp;&nbsp;<i class="fa fa-fire fa-2x"></i>
                    </div>
                    <p class="activity-content font-lger">Explore a selection of our favorite camping destinations, from serene forest retreats to 
                        rugged mountain escapes. Get a taste of the stunning landscapes and pristine campsites that
                        await you.</p>
                </div>
                <div>
                    <img src="uploads/GWSCactivity2.jpg" alt="activity" class="activity-img">
                </div>            
            </div>
        </div>
    </div>
    <!-- gwsc activities end -->

    <!-- camping types start -->
    <div class="wrapper-grey">
        <div class="container">
            <div class="row tent-types-title">
                <h2>All available Camping types</h2>&nbsp;&nbsp;&nbsp;
                <i class="fa fa-list-alt fa-2x"></i>
            </div>
            <div class="row camping-type-row">
                <div>
                    <h3>Tent camping</h3>
                    <div>
                        <img src="uploads/campingType1.jpg" alt="camping-type" class="obj-fit">
                    </div>
                </div>
                <div>
                    <h3>Motorhome camping</h3>
                    <div>
                        <img src="uploads/campingType2.jpg" alt="camping-type" class="obj-fit">
                    </div>
                </div>
                <div>
                    <h3>Caravan camping</h3>
                    <div>
                        <img src="uploads/campingType3.jpg" alt="camping-type" class="obj-fit">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- camping types end -->

    <!-- location map of GWSC start -->
    <div class="wrapper-white">
        <div class="container">
            <div class="row location-gwsc-title">
                <h2 class="p-green">Location of GWSC in OpenStreetMap.org</h2>&nbsp;&nbsp;&nbsp;
                <i class="fa fa-location-arrow fa-2x p-green"></i>
            </div>
            <div class="row row-map">
                <div id="map"></div>
            </div>
        </div>
    </div>
    <!-- location map of GWSC end -->

    <?php include('footer.php'); ?>

    <script type="text/javascript">       
        var lat = 52.6294;
        var log = 1.2965;
    
        window.onload = async () => {
            // view count start
            if(sessionStorage.getItem("newUser") == null) {            
                await fetch('http://localhost/P00197013_MINTHANTWIN_DW_Winter2023/viewCount.php')
                            .then(response => response.text())
                            .then(data => {
                                sessionStorage.setItem("count", data);
                                sessionStorage.setItem("newUser", true);            
                            })
                            .catch(err => console.log(err));
            }    
            
            const view = document.getElementById('view');
            view.innerHTML += sessionStorage.getItem("count") + ".";
            // end

            // slideshow start
            var counter = 1;        
            document.getElementById('radio' + counter).checked = true;

            setInterval(() => {
                counter++;
                document.getElementById('radio' + counter).checked = true;            

                if(counter == 4) counter = 0;
            }, 5000);
            // end
        }
    </script>
    <script src="currentPage.js"></script>
    <script src="locationMapLoad.js"></script>
    <script src="logout.js"></script>    
    <script src="mindate.js"></script>
    <script src="checkSelectDisplay.js"></script>   
    <!-- <script src="barsClick.js"></script>  -->
    
</body>
</html>
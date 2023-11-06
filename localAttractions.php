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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    
    <?php include 'header.php'; ?>    
    
    <!-- local attractions start -->
    <div class="wrapper-white">
        <div class="container">
            <div class="row local-title">
                <h2>Local attractions near swimming & camping sites</h2>            
            </div>
        </div>
    </div>
    <div class="wrapper-grey">
        <div class="container">
            <div class="local-head">
                <h2>Attractions near England area</h2>
            </div>
            <div class="row local-row">                
                <div>
                    <p class="p-bold font-lger">Stonehenge</p>
                    <ul class="local-desc font-lg">
                        <li>3km from Campground Paradise</li>
                        <li>2min walk</li>
                    </ul>
                    <img src="uploads/england1.jpg" alt="england" class="local-img">
                </div>
                <div>
                    <p class="p-bold font-lger">The Lake District</p>
                    <ul class="local-desc font-lg">
                        <li>5km from Starry Nights Camp</li>
                        <li>4min walk</li>
                    </ul>
                    <img src="uploads/england2.jpg" alt="england" class="local-img">
                </div>                
            </div>
        </div>
    </div>
    <div class="wrapper-white">
        <div class="container">            
            <div class="local-head">
                <h2>Attractions near Scotland area</h2>
            </div>
            <div class="row local-row">                
                <div>
                    <p class="p-bold font-lger">Glasgow</p>
                    <ul class="local-desc font-lg">
                        <li>10km from Campground Paradise</li>
                        <li>10min walk</li>
                    </ul>
                    <img src="uploads/scotland1.jpg" alt="scotland" class="local-img">
                </div>
                <div>
                    <p class="p-bold font-lger">Blackpool</p>
                    <ul class="local-desc font-lg">
                        <li>20km from Starry Nights Camp</li>
                        <li>30min walk</li>
                    </ul>
                    <img src="uploads/scotland2.jpg" alt="scotland" class="local-img">
                </div>
                <div>
                    <p class="p-bold font-lger">Edinburgh Castle</p>
                    <ul class="local-desc font-lg">
                        <li>60km from Splash Oasis</li>
                        <li>1hr walk</li>
                    </ul>
                    <img src="uploads/scotland3.jpg" alt="scotland" class="local-img">
                </div>                
            </div>
        </div>
    </div>
    <div class="wrapper-grey">
        <div class="container">            
            <div class="local-head">
                <h2>Attractions near Wales area</h2>
            </div>
            <div class="row local-row">                
                <div>
                    <p class="p-bold font-lger">Loch Ness</p>
                    <ul class="local-desc font-lg">
                        <li>50km from Wavefront Waters</li>
                        <li>45min walk</li>
                    </ul>
                    <img src="uploads/wales1.jpg" alt="wales" class="local-img">
                </div>
                <div>
                    <p class="p-bold font-lger">York Minster</p>
                    <ul class="local-desc font-lg">
                        <li>15km from Adventure Basecamp</li>
                        <li>4min walk</li>
                    </ul>
                    <img src="uploads/wales2.jpg" alt="wales" class="local-img">
                </div>                
            </div>
        </div>
    </div>  
    <div class="wrapper-white">
        <div class="container">            
            <div class="local-head">
                <h2>Attractions near Northern Ireland area</h2>
            </div>
            <div class="row local-row">                
                <div>
                    <p class="p-bold font-lger">Dover Castle</p>
                    <ul class="local-desc font-lg">
                        <li>80km from Adventure Basecamp</li>
                        <li>1hr 5min walk</li>
                    </ul>
                    <img src="uploads/ireland1.jpg" alt="northern ireland" class="local-img">
                </div>                
            </div>
        </div>
    </div>
    <!-- local attractions end -->

    <?php include 'footer.php'; ?>

    <script>
        window.onload = () => {
            const view = document.getElementById('view');
            view.innerHTML += sessionStorage.getItem("count") + ".";
        }
    </script>
    <script src="currentPage.js"></script>
    <script src="logout.js"></script>

</body>
</html>
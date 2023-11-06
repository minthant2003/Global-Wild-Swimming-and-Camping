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

    <!-- amenities and wearable start -->
    <div class="wrapper-white">
        <div class="container">
            <div class="row activity-title">
                <h2 class="">GWSC Features</h2>&nbsp;&nbsp;&nbsp;
                <i class="fa fa-list fa-2x"></i>
            </div>
            <div class="row activity-row">            
                <div>
                    <img src="uploads/amenities.jpeg" alt="amenities" class="activity-img">
                </div>
                <div>
                    <div class="d-flex">
                        <h2>Amenities</h2>&nbsp;&nbsp;&nbsp;<i class="fa fa-list-alt fa-2x"></i>
                    </div>
                    <ul class="features-list font-lger p-bold">
                        <li>Freshwater source</li>
                        <li>Campfire ring or stove</li>
                        <li>Toilet facilities</li>
                        <li>Tents and sleeping gear</li>
                        <li>First aid kit</li>
                        <li>Maps and Information, etc.</li>
                    </ul>
                </div>             
            </div>
            <div class="row activity-row">          
                <div>
                    <div class="d-flex">
                        <h2>Wearable technologies</h2>&nbsp;&nbsp;&nbsp;<i class="fa fa-mobile fa-2x"></i>
                    </div>
                    <ul class="features-list font-lger p-bold">
                        <li>GPS Watch</li>
                        <li>Smartwatches</li>
                        <li>Activity Trackers</li>
                        <li>Health and Safety Sensors</li>
                        <li>Action Cameras</li>
                        <li>Communication Devices, etc.</li>
                    </ul>
                </div>
                <div>
                    <img src="uploads/wearable.jpg" alt="wearable" class="activity-img">
                </div>            
            </div>
        </div>
    </div>
    <!-- amenities and wearable end -->

    <!-- rules start -->
    <div class="wrapper-grey">
        <div class="container">
            <div class="row rule-row">
                <h2>Rules for Global Wild Swimming and Camping</h2><br/>
                <p class="font-lg">Welcome to GWSC, where adventure meets nature in its purest form.
                    To ensure a safe and respectful experience for all and to protect the environment, it's important to 
                    follow a set of rules and guidelines.<br/><br/>

                    <span class="p-bold">1. Know Before You Go:</span>
                    Research and understand the rules and regulations of the area you plan to visit. This includes camping permits, 
                    fire restrictions, and any specific guidelines for wild swimming and camping.<br/><br/>

                    <span class="p-bold">2. Leave No Trace:</span>
                    Our most crucial principle. Leave the environment as you found it. This means packing out all trash, food scraps, 
                    and litter, and avoiding any damage to the natural surroundings.<br/><br/>

                    <span class="p-bold">3. Campfire Safety:</span>
                    Follow local fire regulations. Use a camp stove for cooking whenever possible.
                    If fires are allowed, keep them small and contained.<br/><br/>

                    <span class="p-bold">4. Respect Wildlife:</span>
                    Observe animals from a distance, do not feed them, and securely store your food to avoid 
                    attracting wildlife to your campsite.<br/><br/>

                    <span class="p-bold">5. Practice Safe Swimming:</span>
                    Be aware of water conditions when wild swimming. Avoid swimming alone 
                    in remote areas, and always let someone know your plans.<br/><br/>

                    By following these rules, you'll ensure a safe and enjoyable experience for yourself and others. Together, we can 
                    enjoy the wonders of wild swimming and camping.
                </p>
            </div>
        </div>
    </div>
    <!-- rules end -->

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
<?php
    require 'dbConfig.php';

    session_start();

    try {           
        if($_SERVER['REQUEST_METHOD'] === 'POST') {     
            $err = array(
                "uname" => "",
                "topic" => "",
                "title" => "",
                "content" => ""
            );  
            $topic = $conn->real_escape_string($_POST['topic']);
            $title = $conn->real_escape_string($_POST['title']);
            $content = $conn->real_escape_string($_POST['content']);

            if(empty($_POST['uname'])) $err['uname'] = "Username must not be empty.";
            if(empty($_POST['topic'])) $err['topic'] = "Topic must not be empty.";
            if(empty($_POST['title'])) $err['title'] = "Title must not be empty.";
            if(empty($_POST['content'])) $err['content'] = "Content must not be empty.";
            
            if(empty($_SESSION['Customer_ID'])) {
                echo "<script>alert('Please register or login first to contact us.')</script>";                 
            } else {
                if(!array_filter($err)) {
                    $sql = "INSERT INTO contact(Topic, Title, Content, Customer_ID) VALUES(?,?,?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssi", $topic, $title, $content, $_SESSION['Customer_ID']);
                    $stmt->execute();
                    echo "<script>alert('Thank you for reaching us. We will process your contact soon.')</script>";

                    $stmt->close();
                    $conn->close();
                }
            }
        }    
    } catch(Exception $e) {
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

    <!-- contact us card start -->
    <div class="wrapper-grey">
        <div class="container">
            <div class="row contact-outter-row">
                <div class="row contact-card-row">
                    <h2>We're here to assist you 24/7. Please don't hesitate to get in touch with us.</h2>
                    <i class="fa fa-phone fa-2x"></i>
                </div>
            </div>
            <div class="row card-row">
                <div class="contact-inner">
                    <div class="row contact-card-row">
                        <h3>Phone number</h3>
                        <i class="fa fa-phone fa-lg"></i>
                    </div>
                    <p class="p-bold">+44 99 1111 3333</p>
                </div>
                <div class="contact-inner">
                    <div class="row contact-card-row">
                        <h3>Email address</h3>
                        <i class="fa fa-envelope fa-lg"></i>
                    </div>
                    <p class="p-bold">gwsc123@gmail.com</p>
                </div>
                <div class="contact-inner">
                    <div class="row contact-card-row">
                        <h3>Address</h3>
                        <i class="fa fa-building fa-lg"></i>     
                    </div>             
                    <p class="p-bold">GWSC Ltd, 09 Avenue Street,<br/> LONDON, EC1Y 8II,<br/> UNITED KINGDOM.</p>
                </div>
            </div>  
        </div>
    </div>
    <!-- contact us card end -->    

    <!-- contact us form start -->
    <div class="wrapper-white">
        <div class="container">
            <div class="row contact-form-row contact-title">
                <h2 class="">Contact form</h2>&nbsp;&nbsp;&nbsp;&nbsp;
                <i class="fa fa-quote-left"></i>&nbsp;&nbsp;&nbsp;
                <i class="fa fa-quote-right"></i>
            </div>
            <div class="row contact-form-row">
                <form action="contactUs.php" method="POST" class="row contact-form-row" id="contact-form">
                    <div class="inner-div">
                        <div>
                            <label for="username" class="p-bold font-lg">Username</label><br/><br/>
                            <input type="text" id="username" class="font-lg" name="uname" value="<?php if(isset($_SESSION['Username'])) echo $_SESSION['Username']; ?>"><br/>
                            <?php if(isset($err['uname'])) { ?>
                                <small class="p-red"><?php echo $err['uname']; ?></small>
                            <?php } ?>
                        </div>
                        <div>
                            <label for="topic" class="p-bold font-lg">Topic</label><br/><br/>
                            <select name="topic" id="topic" class="font-lg">
                                <option value="">---Please select the option---</option>
                                <option value="swimming">Swimming</option>
                                <option value="camping">Camping</option>
                                <option value="payment">Payment</option>
                                <option value="location">Location</option>
                                <option value="others">Others</option>
                            </select><br/>
                            <?php if(isset($err['topic'])) { ?>
                                <small class="p-red"><?php echo $err['topic']; ?></small>
                            <?php } ?>
                        </div>
                        <div>
                            <label for="title" class="p-bold font-lg">Title</label><br/><br/>
                            <input type="text" id="title" name="title" class="font-lg" value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>"><br/>
                            <?php if(isset($err['title'])) { ?>
                                <small class="p-red"><?php echo $err['title']; ?></small>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="inner-div">
                        <div>
                            <label for="content" class="p-bold font-lg">Content</label><br/><br/>
                            <textarea name="content" id="content" cols="30" rows="4" class="font-lg" placeholder="Please let us know..."></textarea><br/>
                            <?php if(isset($err['content'])) { ?>
                                <small class="p-red"><?php echo $err['content']; ?></small>
                            <?php } ?>
                        </div>
                        <button type="submit" class="p-bold font-lg" id="contact-btn" name="btn">Submit</button>
                    </div>
                </form>
            </div>
            <div class="row contact-form-row">
                <p class="p-green font-lg"><a href="aboutUs.php#privacy-policy" class="deco-none p-green font-lg">Privacy policy</a> | 
                    <a href="aboutUs.php#term-conditions" class="deco-none p-green font-lg">Terms & Conditions</a></p>
            </div>
        </div>
    </div>
    <!-- contact us form end -->    

    <!-- contact us map start -->
    <div class="wrapper-white">
        <div class="container">
            <div class="row location-gwsc-title">
                <h2 class="p-black">Location of GWSC in OpenStreetMap.org</h2>&nbsp;&nbsp;&nbsp;
                <i class="fa fa-location-arrow fa-2x p-black"></i>
            </div>
            <div class="row row-map">
                <div id="map"></div>
            </div>
        </div>
    </div>
    <!-- contact us map end -->          

    <?php include 'footer.php'; ?>

    <script>
        var lat = 52.6294;
        var log = 1.2965;

        window.onload = () => {
            const view = document.getElementById('view');
            view.innerHTML += sessionStorage.getItem("count") + ".";
        }
    </script>
    <script src="currentPage.js"></script>
    <script src="locationMapLoad.js"></script>
    <script src="logout.js"></script>

</body>
</html>
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

    <!-- who we are start -->
    <div class="wrapper-white">
        <div class="container">
            <div class="row activity-title">
                <h2 class="">About us</h2>&nbsp;&nbsp;&nbsp;
                <i class="fa fa-info-circle fa-2x"></i>
            </div>
            <div class="row activity-row">            
                <div>
                    <img src="uploads/aboutus.jpg" alt="aboutus" class="activity-img">
                </div>
                <div>
                    <div>
                        <div class="d-flex">
                            <h2>Who we are?</h2>&nbsp;&nbsp;&nbsp;<i class="fa fa-question-circle fa-2x"></i>
                        </div>
                        <p class="activity-content font-lger">We are passionate advocates of the great outdoors and all the natural 
                            beauty it has to offer. We are a collective of adventurers, nature 
                            enthusiasts who have come together to celebrate the beauty of our planet.</p>
                    </div><br/><br/><br/>
                    <div>
                        <div class="d-flex">
                            <h2>What we do?</h2>&nbsp;&nbsp;&nbsp;<i class="fa fa-bullseye fa-2x"></i>
                        </div>
                        <p class="activity-content font-lger">Our mission is to connect individuals from all
                            corners of the world who share our love for wild swimming and camping. We believe that immersing ourselves
                            in nature's wonders fosters a deep appreciation for the environment.</p>
                    </div>
                </div>             
            </div>
        </div>
    </div>
    <!-- who we are end -->

    <!-- privacy and conditions start -->
    <div class="wrapper-grey">
        <div class="container">
            <div class="row privacy-row">
                <h2 id="privacy-policy">Privacy Policy</h2><br/>
                <p class="font-lg">Global Wild Swimming and Camping is committed to protecting the 
                    privacy and personal information of our users. This Privacy Policy outlines how we collect, use, disclose,
                    and safeguard your personal data when you visit our website, use our services, or interact with our community.<br/><br/>

                    By accessing and using our website or services, you consent to the terms and practices described in this Privacy 
                    Policy. If you do not agree with our practices, please refrain from using our website or services.<br/><br/>

                    We may collect the following types of information:<br/><br/>

                    1. Personal Information<br/>
                    2. Usage Data<br/>
                    3. User-Generated Content<br/><br/>

                    We use the collected information for the following purposes:<br/><br/>

                    1. Providing Services<br/>
                    2. Communication<br/>
                    3. Research and Analytics
                </p><br/><br/>
                <h2 id="term-conditions">Terms & Conditions</h2><br/>
                <p class="font-lg">Please carefully read these Terms and Conditions before using the Website and related services operated by GWSC. 
                    By using our Website and Services, you agree to comply with and be bound by these Terms. If you do not agree with these 
                    Terms, please refrain from using our Website and Services.<br/><br/>
                    <span class="p-bold">Eligibility:</span> By using our Services, you represent that you are of legal age and have the legal capacity to enter into this agreement.<br/><br/>
                    <span class="p-bold">Account:</span> If you create an account, you are responsible for maintaining the confidentiality of your account information, including your password, and for any activity that occurs under your account.<br/><br/>
                    <span class="p-bold">Termination:</span> We reserve the right to terminate or suspend your access to our Website and Services at our discretion and without notice if you violate these Terms.<br/><br/>
                    If you have any questions or concerns about these Terms and Conditions, <a href="contactUs.php">please contact us</a>.
                </p>
            </div>
        </div>
    </div>
    <!-- privacy and conditions end -->

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
<!-- nav bar -->
<div class="wrapper-white header">
    <div class="container">
        <div class="row row-header">
            <div class="logo">
                <div class="row">
                    <a href="index.php" id="logo-img"><img id="logo" src="uploads/logo.png" alt="logo"></a>
                    <!-- <i class="fa fa-bars p-black fa-2x" id="bars"></i> -->
                </div>         
            </div>
            <div class="nav-bar">
                <nav>
                    <ul>
                        <li><a href="availabilityCheck.php">Availability</a></li>
                        <div class="dropdown">
                            <li>
                                <a href="activitySites.php">Activity Sites&nbsp;<i class="fa fa-angle-down fa-green"></i></a>                                
                            </li>
                            <ul class="dropdown-item">
                                <li><a href="activitySites.php?search=swimming">Swimming sites</a></li>
                                <li><a href="activitySites.php?search=camping">Camping pitches</a></li>
                            </ul>
                        </div>
                        <li><a href="reviews.php">Reviews</a></li>
                        <li><a href="features.php">Features</a></li>
                        <li><a href="localAttractions.php">Local Attractions</a></li>
                        <li><a href="contactUs.php">Contact us</a></li>
                        <li><a href="aboutUs.php">About us</a></li>
                    </ul>
                </nav>
            </div>
            <div class="navLogin">                
                <?php if(isset($_SESSION['Customer_ID'])) { ?>
                    <div class="dropdown">
                        <img src="uploads/profile.jpg" alt="profile" id="profile">
                        <ul class="dropdown-item">                            
                            <li><a href="javascript:void(0)" class="deco-none p-green p-bold font-lg" id="logout">Log out</a></li>
                        </ul>
                    </div>
                <?php } else { ?>
                    <a href="login.php" class="btnLogin deco-none">Log in</a>
                <?php } ?>                                
            </div>
        </div>
    </div>
</div>
<!-- nav-bar end -->
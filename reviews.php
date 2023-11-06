<?php 
    session_start(); 
    require 'dbConfig.php';

    try {
        if(isset($_GET['btn'])) {
            $filter = $_GET['filter'];            

            if($filter === "*") {
                $sql = "SELECT customer.Username, review.Description, site.Name FROM customer
                        INNER JOIN review ON customer.Customer_ID = review.Customer_ID
                        INNER JOIN site ON review.Site_ID = site.Site_ID";
            } else {
                $sql = "SELECT customer.Username, review.Description, site.Name FROM customer
                INNER JOIN review ON customer.Customer_ID = review.Customer_ID
                INNER JOIN site ON review.Site_ID = site.Site_ID
                WHERE site.Category = '" . $filter . "'";
            }            
            
            $result = $conn->query($sql);            
            $conn->close();                       
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    
    <?php include 'header.php'; ?>    

    <!-- review filter start -->
    <div class="wrapper-white">
        <div class="container">
            <div class="row review-head">
                <i class="fa fa-search fa-2x"></i>
                <h2>Search reviews</h2>
            </div>
            <div class="row filter-row">
                <form action="reviews.php" method="GET">                    
                    <select name="filter" id="filter" class="font-lger">
                        <option value="">---Please select an option---</option>
                        <option value="*">All</option>
                        <option value="swimming">Swimming</option>
                        <option value="camping">Camping</option>
                    </select>
                    <button type="submit" class="font-lger p-bold" id="filter-btn" name="btn">Search</button>
                </form>
            </div>
        </div>
    </div>
    <!-- review filter end -->

    <!-- filter result start -->
    <?php if(isset($result)) { ?>
        <div class="wrapper-grey">
            <div class="container filter-container">
                <div class="row">
                    <h2>Search results (<?php echo $result->num_rows; ?>)</h2>
                </div>
                <?php if($result->num_rows === 0) { ?>
                    <div class="row no-result-row">
                        <h2>No results found!</h2>&nbsp;&nbsp;
                        <i class="fa fa-frown-o fa-2x"></i>
                    </div>
                <?php }
                while($obj = $result->fetch_object()) { ?>
                    <div class="row result-row review-row">
                        <div class="profile-review">
                            <img src="uploads/profile.jpg" alt="profile" id="review-profile">
                        </div>
                        <div class="review-row-inner">                            
                            <div>
                                <h3>For <?php echo $obj->Name; ?></h3>
                                <h4>Reviewed by <?php echo $obj->Username; ?></h4> 
                            </div>                           
                            <div>
                                <p class="font-lger"><?php echo $obj->Description; ?></p>
                            </div>
                        </div>
                    </div>  
                <?php } ?>                
            </div>
        </div>    
    <?php } ?>
    <!-- filter result end -->

    <!-- for show start -->
    <?php if(!isset($_GET['btn'])) { ?>
        <div class="wrapper-grey">
            <div class="container">
                <div class="row no-result-row">
                    <h2>Search something!</h2>&nbsp;&nbsp;
                    <i class="fa fa-search fa-2x"></i>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- for show end -->

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
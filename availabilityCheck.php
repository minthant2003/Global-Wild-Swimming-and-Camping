<?php 
    session_start();
    require 'dbConfig.php';    

    try {               
        if(isset($_GET['btn'])) {  
            $checkin = date('Y-m-d', strtotime($_GET['checkin']));
            $checkout = date('Y-m-d', strtotime($_GET['checkout']));            
            $cat = $_GET['category'];
            $camptype = $_GET['camptype'];

            $sql = "SELECT DISTINCT site.Site_ID, site.Name, site.Category, site.Camping_type, site.Img_name FROM booking
                    RIGHT JOIN site ON booking.Site_ID = site.Site_ID
                    WHERE site.Name NOT IN(SELECT site.Name FROM booking
                    INNER JOIN site ON booking.Site_ID = site.Site_ID
                    WHERE (booking.Checkin>='$checkin' AND booking.Checkin<='$checkout') OR (booking.Checkin <= '$checkin' AND booking.Checkout >= '$checkout') OR (booking.Checkout>='$checkin' AND booking.Checkout<='$checkout'))
                    AND site.Category = '$cat' AND (site.Camping_type IS NULL OR site.Camping_type = '$camptype')
                    GROUP BY site.Site_ID ORDER BY site.Site_ID";
            $result = $conn->query($sql);

            $_SESSION['in'] = $checkin;
            $_SESSION['out'] = $checkout;
            $conn->close();
        }

        if(isset($_GET['btn-book'])) {
            if(empty($_SESSION['Customer_ID'])) {
                echo "<script>alert('Please sign up or login first.')</script>";
            } else {                
                $siteid = $_GET['id'];
                $in = $_SESSION['in'];
                $out = $_SESSION['out'];
                $customer_id = $_SESSION['Customer_ID']; 

                $sql = "INSERT INTO booking(Checkin,Checkout,Site_ID,Customer_ID) VALUES(?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssii", $in, $out, $siteid, $customer_id);
                $stmt->execute();
                $stmt->close();

                echo "<script>alert('Booking is successful.')</script>";
                unset($_SESSION['in']);
                unset($_SESSION['out']);
                
                $conn->close();                                
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    
    <?php include 'header.php'; ?>    

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

    <!-- result start -->
    <?php if(isset($result)) { ?>
        <div class="wrapper-grey">
            <div class="container filter-container">
                <div class="row">
                    <h2>Check results (<?php echo $result->num_rows; ?>)</h2>
                </div>
                <?php if($result->num_rows === 0) { ?>
                    <div class="row no-result-row">
                        <h2>There is no available site for your desired duration!</h2>&nbsp;&nbsp;
                        <i class="fa fa-frown-o fa-2x"></i>
                    </div>
                <?php }
                while($obj = $result->fetch_object()) { ?>
                    <div class="row result-row">
                        <div>
                            <div>
                                <img src="sites/<?php echo $obj->Img_name; ?>" alt="check-result" class="filter-img">
                            </div>
                            <div class="row see-row">
                                <a href="siteDetails.php?id=<?php echo $obj->Site_ID; ?>" class="deco-none p-green p-bold">See Details</a>
                            </div>
                        </div>
                        <div>
                            <p class="font-lger p-bold">Name -</p>
                            <p><?php echo $obj->Name; ?></p><br/>
                            <p class="font-lger p-bold">Category -</p> 
                            <p><?php echo $obj->Category; ?></p>
                            <?php if($obj->Category === "Camping") { ?>
                                <br/>
                                <p class="font-lger p-bold">Camping Type -</p> 
                                <p><?php echo $obj->Camping_type; ?></p>
                            <?php } ?>
                        </div>
                        <div>
                            <form action="availabilityCheck.php" method="GET" id="book-form">
                                <input type="hidden" name="id" value="<?php echo $obj->Site_ID; ?>">
                                <button type="submit" class="detail-btn p-bold font-lg deco-none p-green" name="btn-book">Take booking</button>
                            </form>                            
                        </div>
                    </div>  
                <?php } ?>                
            </div>
        </div>    
    <?php } ?>
    <!-- result end -->

    <!-- for show start -->
    <?php if(!isset($_GET['btn'])) { ?>
        <div class="wrapper-grey">
            <div class="container">
                <div class="row no-result-row">
                    <h2>Pick desired duration & Book!</h2>&nbsp;&nbsp;
                    <i class="fa fa-check-circle fa-2x"></i>
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
    <script src="mindate.js"></script>
    <script src="checkSelectDisplay.js"></script>    

</body>
</html>
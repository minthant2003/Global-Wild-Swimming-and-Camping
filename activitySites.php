<?php 
    session_start(); 
    require 'dbConfig.php';

    if(isset($_GET['search'])) {
        $search = $_GET['search'];    
    }

    try {
        if(!empty($search)) {
            $sql = "SELECT * FROM site WHERE Category = '" . $search . "'";
            $result = $conn->query($sql);        
            $conn->close(); 
        }

        if(isset($_GET['btn'])) {
            $filter = $_GET['filter'];            

            if($filter === "*") {
                $sql = "SELECT * FROM site";
            } else {
                $sql = "SELECT * FROM site WHERE Category = '" . $filter . "'";
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

    <!-- activity site filter form start -->
    <div class="wrapper-white">
        <div class="container">
            <div class="row filter-row">
                <form action="activitySites.php" method="GET">
                    <i class="fa fa-filter fa-2x"></i>
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
    <!-- activity site filter form end -->

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
                    <div class="row result-row">
                        <div>
                            <img src="sites/<?php echo $obj->Img_name; ?>" alt="filter-result" class="filter-img">
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
                            <a href="siteDetails.php?id=<?php echo $obj->Site_ID; ?>" class="detail-btn p-bold font-lg deco-none p-green">See Details</a>                    
                        </div>
                    </div>  
                <?php } ?>                
            </div>
        </div>    
    <?php } ?>
    <!-- filter result end -->

    <!-- for show start -->
    <?php if(!isset($_GET['btn']) && empty($search)) { ?>
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
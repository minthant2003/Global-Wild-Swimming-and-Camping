<?php
    require 'dbConfig.php';

    session_start();

    if(isset($_POST['btn'])) {
        try {
            $err = array(
                "uname" => "",
                "fname" => "",
                "lname" => "",
                "pass" => "",
                "conpass" => "",
                "email" => "",
                "phone" => ""
            );
            if(empty($_POST['uname'])) $err['uname'] = "Username is empty.";
            if(empty($_POST['fname'])) $err['fname'] = "First Name is empty.";
            if(empty($_POST['lname'])) $err['lname'] = "Last Name is empty.";
            if(empty($_POST['pass'])) $err['pass'] = "Password is empty.";
            if(empty($_POST['conpass'])) $err['conpass'] = "Password is empty.";
            if(empty($_POST['email'])) $err['email'] = "Email is empty.";
            if(empty($_POST['phone'])) $err['phone'] = "Phone Number is empty.";

            if(!array_filter($err)) {
                $uname = $conn->real_escape_string($_POST['uname']);
                $fname = $conn->real_escape_string($_POST['fname']);
                $lname = $conn->real_escape_string($_POST['lname']);
                $pass = $conn->real_escape_string($_POST['pass']);            
                $email = $conn->real_escape_string($_POST['email']);
                $phone = $conn->real_escape_string($_POST['phone']);

                $sql = "SELECT * FROM customer WHERE Username=?";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $uname);
                $stmt->execute();

                $result = $stmt->get_result();
                if($result->num_rows == 1) {
                    echo "<script>alert('Same username already exits in the system.')</script>";
                } else {
                    $passHash = password_hash($pass, PASSWORD_BCRYPT);

                    $sql = "INSERT INTO customer(Username,First_name,Last_name,Password,Email,Phone) VALUES(?,?,?,?,?,?)";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssssss", $uname, $fname, $lname, $passHash, $email, $phone);
                    $stmt->execute();    
                    $stmt->close();

                    $sql = "SELECT * FROM customer WHERE Username=?";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $uname);
                    $stmt->execute();

                    $result = $stmt->get_result();
                    $customer = $result->fetch_object();

                    $_SESSION['Customer_ID'] = $customer->Customer_ID;
                    $_SESSION['Username'] = $customer->Username;
                    $stmt->close();

                    header("Location: index.php");
                }                      
            }
        } catch(Exception $e) {
            echo $e;
        }
    }

    $conn->close();
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
</head>
<body>
    
    <div class="wrapper-grey wrapper-signup">
        <div class="inner-wrap-signup">
            <div id="signup-logo">
                <div id="signup-header" class="d-flex">
                    <a href="index.php"><img id="logo" class="logo-sign" src="uploads/logo.png" alt="logo"></a>
                    <p class="p-green p-bold font-lger title-sign">GWSC</p>
                </div>
                <p class="sign-head-text">Already have an account? <a href="login.php" class="p-blue">Log in here</a></p>
            </div>
            <form class="signup-form" action="signup.php" method="POST">
                <div>
                    <p class="font-lg">Sign Up to enjoy full services.</p>
                </div>
                <div>
                    <label for="name" class="">Username</label><br/>
                    <input id="name" type="text" name="uname" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>"/> 
                    <?php if(isset($err['uname'])) { ?>
                        <small class="p-red"><?php echo $err['uname']; ?></small>
                    <?php } ?>
                </div>
                <div>
                    <label for="fname" class="">First Name</label><br/>
                    <input id="fname" type="text" name="fname" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>"/> 
                    <?php if(isset($err['fname'])) { ?>
                        <small class="p-red"><?php echo $err['fname']; ?></small>
                    <?php } ?>
                </div>
                <div>
                    <label for="lname" class="">Last Name</label><br/>
                    <input id="lname" type="text" name="lname" value="<?php if(isset($_POST['lname'])) echo $_POST['lname']; ?>"/> 
                    <?php if(isset($err['lname'])) { ?>
                        <small class="p-red"><?php echo $err['lname']; ?></small>
                    <?php } ?>
                </div>
                <div>
                    <div class="pass-icon d-flex">
                        <label for="pass" class="">Password</label>
                        <i class="fa fa-eye-slash" onclick="togglePass(event)"></i>
                    </div>
                    <input id="pass" type="password" name="pass" value="<?php if(isset($_POST['pass'])) echo $_POST['pass']; ?>"/>
                    <small id="passOut" class="p-red"></small>
                    <?php if(isset($err['pass'])) { ?>
                        <small class="p-red"><?php echo $err['pass']; ?></small>
                    <?php } ?>
                </div>
                <div>
                    <div class="pass-icon d-flex">
                        <label for="conpass" class="">Re-enter Password</label>
                        <i class="fa fa-eye-slash" onclick="togglePass(event)"></i>
                    </div>
                    <input id="conpass" type="password" name="conpass" value="<?php if(isset($_POST['conpass'])) echo $_POST['conpass']; ?>"/>
                    <?php if(isset($err['conpass'])) { ?>
                        <small class="p-red"><?php echo $err['conpass']; ?></small>
                    <?php } ?>
                </div>
                <div>
                    <label for="email" class="">Email</label><br/>
                    <input id="email" type="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"/> 
                    <?php if(isset($err['email'])) { ?>
                        <small class="p-red"><?php echo $err['email']; ?></small>
                    <?php } ?>
                </div>
                <div>
                    <label for="phone" class="">Phone number</label><br/>
                    <input id="phone" type="text" name="phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>"/> 
                    <?php if(isset($err['phone'])) { ?>
                        <small class="p-red"><?php echo $err['phone']; ?></small>
                    <?php } ?>
                </div>
                <div>
                    <input id="privacy" type="checkbox" name="check" required <?php if(isset($_POST['check'])) echo "checked"; ?>/>
                    <label for="privacy">By creating the account, you agree to our <br/><a href="aboutUs.php#term-conditions" class="p-blue">Terms & Conditions</a> and <a href="aboutUs.php#privacy-policy" class="p-blue">Privacy Policy</a></label>
                </div>
                <button class="font-lg p-bold" type="submit" name="btn">Sign up</button>
            </form>  
        </div>
    </div>

    <script type="text/javascript">
        // password hide and show
        function togglePass(event) {
            var i = event.target;
            var text = event.target.parentElement.nextElementSibling;

            if(i.classList.contains('fa-eye-slash')) {
                i.classList.remove('fa-eye-slash');
                i.classList.add('fa-eye');

                text.type = 'text';
            } else {
                i.classList.remove('fa-eye');
                i.classList.add('fa-eye-slash');

                text.type = 'password';
            }
        }
    </script>
    <script src="passValidate.js"></script>

</body>
</html>
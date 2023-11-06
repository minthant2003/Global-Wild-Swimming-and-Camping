<?php    
    require 'dbConfig.php';   

    session_start();

    function chkTimes() {
        if(empty($_SESSION['times'])) {
            $_SESSION['times'] = 1;
        } else {
            $_SESSION['times'] += 1;
        }

        if($_SESSION['times'] === 3) {
            echo "<script>";
            echo "var times = " . $_SESSION['times'] . ";";
            echo "</script>";
            $_SESSION['times'] = 0;
        }
    }

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        try {
            $err = array(
                "uname" => "",
                "pass" => ""
            );

            if(empty($_POST['uname'])) $err['uname'] = "Username is empty.";
            if(empty($_POST['pass'])) $err['pass'] = "Username is empty.";

            if(!array_filter($err)) {
                $uname = $conn->real_escape_string($_POST['uname']);
                $pass = $conn->real_escape_string($_POST['pass']);                

                if($_POST['captcha'] !== $_SESSION['captcha']) {
                    echo "<script>alert('You might be a robot.')</script>";                    
                } else {
                    $sql = "SELECT * FROM customer WHERE Username=?";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $uname);
                    $stmt->execute();
    
                    $result = $stmt->get_result();
                    if($result->num_rows == 1) {
                        $obj = $result->fetch_object();
    
                        if(password_verify($pass, $obj->Password)) {
                            echo "<script>alert('Log-in successful.')</script>";
                            
                            $_SESSION['Customer_ID'] = $obj->Customer_ID;
                            $_SESSION['Username'] = $obj->Username;

                            $conn->close();
                            $stmt->close();

                            header("Location: index.php");
                        } else {
                            $err['pass'] = "Password is not correct.";
                            chkTimes();
                        }
                    } else {
                        echo "<script>alert('Username does not exit in the system.')</script>";                        
                        chkTimes();
                    }
                }             
            }
        } catch(Exception $e) {
            echo $e;
        }
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
</head>
<body>
    
    <div class="wrapper-grey wrapper-login">
        <div class="inner-wrap-login">
            <div id="login-logo">
                <div id="login-header" class="d-flex">
                    <a href="index.php"><img id="logo" class="logo-sign" src="uploads/logo.png" alt="logo"></a>
                    <p class="p-green p-bold font-lger title-sign">GWSC</p>
                </div>
                <p class="sign-head-text">New member? <a href="signup.php" class="p-blue">Sign up here</a></p>
            </div>
            <form class="login-form" action="login.php" method="POST">
                <div>
                    <p class="font-lg">Log in to stay connected.</p>
                </div>
                <div>
                    <label for="name" class="">Username</label><br/>
                    <input id="name" type="text" name="uname" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>"/> 
                    <?php if(isset($err['uname'])) { ?>
                        <small class="p-red"><?php echo $err['uname']; ?></small>
                    <?php } ?>
                </div>                
                <div>
                    <div class="pass-icon d-flex">
                        <label for="pass" class="">Password</label>
                        <i class="fa fa-eye-slash" onclick="togglePass(event)"></i>
                    </div>
                    <input id="pass" type="password" name="pass" value="<?php if(isset($_POST['pass'])) echo $_POST['pass']; ?>"/>
                    <?php if(isset($err['pass'])) { ?>
                        <small class="p-red"><?php echo $err['pass']; ?></small>
                    <?php } ?>
                </div>
                <div>
                    <label for="captcha">Enter the Captcha code below</label><br/>
                    <input id="captcha" type="text" name="captcha" required>
                </div>
                <div>
                    <img src="captcha.php" alt="captcha">
                </div>                
                <button id="btnLogin" class="font-lg p-bold" type="submit" name="btn">Log in</button>              
                <div>
                    <p id="times" class="p-red p-bold font-lg"></p>
                </div>
            </form>  
        </div>
    </div>

    <script type="text/javascript">
        // 10mins lock start     
        if(times == 3) {            
            const countdown = document.getElementById('times');
            const uname = document.getElementById('name');
            const pass = document.getElementById('pass');
            const btn = document.getElementById('btnLogin');

            function chgFormat(ms) {    
                let seconds = ms/1000;     

                const hours = parseInt(seconds/3600);
                seconds = seconds % 3600;

                const minutes = parseInt(seconds/60);
                seconds = seconds % 60;

                return hours+":"+minutes+":"+seconds;
            }

            uname.disabled = true;
            pass.disabled = true;
            btn.disabled = true;

            var millisec = 600000;
            countdown.innerHTML = "Currently unavailable for " + chgFormat(millisec) + ".";                

            var interval = setInterval(() => {
                millisec -= 1000;
                countdown.innerHTML = "Currently unavailable for " + chgFormat(millisec) + ".";

                if(millisec == 0) {
                    clearInterval(interval);
                    uname.disabled = false;
                    pass.disabled = false;
                    btn.disabled = false;
                    countdown.innerHTML = "";
                } 
            }, 1000);
        } 
      
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

</body>
</html>
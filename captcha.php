<?php
    session_start();
    function randText() {
        $rand = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $text = "";

        for($i = 1; $i <= 6; $i++) {
            $index = rand(0, strlen($rand)-1);
            $text .= $rand[$index];
        }
        return $text;        
    }

    $image = imagecreate(90, 30);

    $grey = imagecolorallocate($image, 232, 232, 232);
    $green = imagecolorallocate($image, 66, 104, 82);

    $code = randText();
    $_SESSION['captcha'] = $code;

    imagestring($image, 5, 17, 7, $code, $green);
    imagejpeg($image);

    header('Content-Type: image/jpeg');
    header("Cache-Control: no-store, no-cache, must-revalidate");

    imagedestroy($image);
?>
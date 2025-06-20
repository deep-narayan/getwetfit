<?php

use PHPMailer\PHPMailer\PHPMailer;
  require 'PHPMailer-master/src/PHPMailer.php';
  require 'PHPMailer-master/src/SMTP.php';
  require 'PHPMailer-master/src/Exception.php';



if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
    echo "PHPMailer is loaded!";
} else {
    echo "PHPMailer is NOT loaded!";
}

?>

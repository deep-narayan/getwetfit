<?php
require 'path/to/PHPMailer.php'; // or autoload.php if using Composer
require 'path/to/SMTP.php';
require 'path/to/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
    echo "PHPMailer is loaded!";
} else {
    echo "PHPMailer is NOT loaded!";
}

?>

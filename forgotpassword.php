
<?php
include("connection.php");
include("navbar.php");
// session_start();
?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $reset_token)
{
    require('PHPMailer/PHPMailer.php');
    require('PHPMailer/SMTP.php');
    require('PHPMailer/Exception.php');

    $mail = new PHPMailer(true);

    try {
        
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'mail.codewithamit.site';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'ak811@codewithamit.site';                     //SMTP username
        $mail->Password = 'Amitkumar811@';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('ak811@codewithamit.site', 'Library And Book Shop');
        $mail->addAddress($email);     //Add a recipient
        
        
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Password Reset Link From Library And Book Shop";
        $mail->Body = "We got a request from you to reset your password!
        Click the link below: <br>
        <a href='https://mail.codewithamit.site/updatepassword.php?email=$email&reset_token=$reset_token'>Reset Password</a>";


        $mail->send();
        return true;
    } catch (Exception $e) {
        return $mail->ErrorInfo; // Return detailed error message
    }
}
?>

<?php
if (isset($_POST['send-reset-link'])) {
    $query = "SELECT * FROM `student` WHERE `email`='$_POST[email]' ";
    $result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            // email found
            $reset_token = bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/kolkata');
            $date = date("Y-m-d");
            $query = "UPDATE `student` SET `resettoken`='$reset_token',`resettokenexpire`='$date' WHERE `email`='$_POST[email]' ";

            if (mysqli_query($db, $query) && sendMail($_POST['email'], $reset_token) === true) {
                echo "
                <script>
                alert('Password Reset Link Sent to Email');
                window.location.href='index.php';
                </script>
                ";
            } else {
                echo "
                <script>
                alert('Server down or email sending failed. Please try again later');
                window.location.href='index.php';
                </script>
                ";
            }

        } else {
            echo "
        <script>
        alert('Email Not Found');
        window.location.href='index.php';
        </script>
        ";
        }

    } else {
        echo "
        <script>
        alert('Cannot run query');
        window.location.href='index.php';
        </script>
        ";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>login</title>
    
    <style>
        body::-webkit-scrollbar{
            display: none;
        }
    </style>
</head>
<style>
    .box1 {
        height: 500px;
        width: 450px;
        background-color: black;
        margin: 70px auto;
        opacity: .8;
        color: white;
        padding: 20px;
    }
</style>

<body>





    <section>
        <form method="POST" action="">
            <div class="container">
                <div class="sec_img">
                    <br>
                    <div class="box">
                        <h1 class="text-warning" style="text-align: center; font-size: 35px;">Library Management
                            System
                        </h1><br>
                        <h3 class="text-danger" style="text-align: center;">User Password Reset</h3>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6 mx-auto">
                        <div class="card bg-primary-subtle">
                            <div class="card-body">

                                <br><br>

                                <div class="row">
                                    <div class="col">
                                        <label for="exampleInputEmail1">Email</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control mt-1" name="email" required
                                                placeholder="Enter Registered Email">
                                        </div>
                                        <div class="form-group mt-4">
                                            <button class="btn btn-warning btn-block" name="send-reset-link">SEND
                                                LINK</button>
                                        </div>



                                        <br><br>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="mt-2">
                            <a href="index.php" class="text-decoration-none">
                                << Back to Home</a><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
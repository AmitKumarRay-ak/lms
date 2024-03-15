<?php
include("connection.php");
include("navbar.php");
// session_start();
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

    <title>update password</title>
    <style>
    
    
        body::-webkit-scrollbar{
            display: none;
        }
        
        .container1 {
            background-color: #d399e8;
            height: 660px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .row {
            padding: 50px;
            background-color: #d3bcd6;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<?php
if(isset($_POST['submit']))
{
    $email = mysqli_real_escape_string($db,  $_POST['email']);

    $emailquery = "SELECT * FROM `admin` WHERE email='$email' ";
    $query = mysqli_query($db, $emailquery);

    $emailcount = mysqli_num_rows($query);

    if($emailcount){

        $userdata = mysqli_fetch_array($query);

        $username = $userdata['username'];
        $token = $userdata['token'];

        $subject = "Password Reset";
        $body = "Hi, $username. Click here to reset your password http://localhost/lms/admin/reset_password2.php?token=$token ";
        $sender_email = "FROM: amitkumar8340441436@gmail.com";

        if(mail($email, $subject, $body, $sender_email)){
            $_SESSION['msg'] = "check your mail to reset your password $email";
            header('location:admin_login.php');
        }
        else{
            echo "Email sending failed...";
        }
    }
}
?>




    <div class="container1">
        <div class="row">
            <h3 class="text-danger">Recover Your Password</h3>
            <hr>
            <div class="col">
                <form method="POST">

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example1">Email</label>
                        <input type="text" id="form2Example1" name="email" class="form-control"
                            placeholder="Enter Email Address" required />
                    </div>

                    <button data-mdb-ripple-init type="submit" name="submit"
                        class="btn btn-primary btn-block mb-4">Send Mail</button>

                </form>

            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>
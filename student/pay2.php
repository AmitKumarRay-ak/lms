<?php
include("connection.php");
include("navbar.php");

$bname = $_POST['bname'];
$bprice = $_POST['bprice'];

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$apiKey = "rzp_test_YwFYQeWYElEdt2";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <style>
        .razorpay-payment-button {
            display: none;
        }
    </style>
</head>

<body>

    <form action="https://www.example.com/payment/success/" method="POST">
        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $apiKey; ?>"
            data-amount="<?php echo $bprice * 100; ?>" data-currency="INR"
            data-id="<?php echo 'OID' . rand(10, 100) . 'END'; ?>" data-buttontext="Pay"
            data-name="Library Management System" data-description="Books Shop"
            data-image="https://www.codewithamit.site/images/books.png" data-prefill.name="<?php echo $name; ?>"
            data-prefill.email="<?php echo $email; ?>" data-prefill.contact="<?php echo $phone; ?>"
            data-theme.color="#F37254"></script>
        <input type="hidden" custom="Hidden Element" name="hidden" />
    </form>

    <script>
        $(document).ready(function () {
            $('.razorpay-payment-button').click();
        });
    </script>
</body>

</html>
<?php
include("connection.php");
include("navbar.php");






$bname = $_POST['bname'];
$bprice = $_POST['bprice'];

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous">
        </script>


    <style>
        .buynow {
            display: none;
        }
    </style>
</head>

<body>





    <a href="javascript:void(0)"  class="btn btn-primary buynow"></a>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>

        $(".buynow").click(function () {

            var options = {
                "key": "rzp_test_YwFYQeWYElEdt2", // Enter the Key ID generated from the Dashboard
                "amount": "50000", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "currency": "INR",
                "name": "Library Management System",
                "description": "Test Transaction",
                "image": "https://www.codewithamit.site/images/books.png",
                "handler": function (response) {
                    alert(response.razorpay_payment_id);
                    alert(response.razorpay_order_id);
                    alert(response.razorpay_signature)
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();

        });

    </script>











    <script>
        $(document).ready(function () {
            $('.buynow').click();
        });
    </script>
</body>

</html>
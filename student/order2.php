<?php
include("connection.php");
include("navbar.php");

// Initialize variables
$bname = $bprice = $bimage = "";

if (isset($_GET['bid'])) {
    $id = $_GET['bid'];
    $sql = "SELECT * FROM `books` WHERE `bid`='$id'";
    $result = mysqli_query($db, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $bname = $row['name'];
        $bprice = $row['price'];
        $bimage = $row['bimage'];
    } else {
        echo "No product found";
    }
} else {
    echo "No product found";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Include Razorpay checkout script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    <style>
        body::-webkit-scrollbar{
            display: none;
        }
    </style>
</head>

<body>
    <div class="container mt-4" style="background-color: #41ACA8; border-radius: 25px;">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5">
                <h2 class="text-center p-2 text-dark">Fill The Details To Complete Your Order</h2>
                <hr>
                <br>

                <h3>Product Details : </h3>
                <table class="table table-bordered" width="400px">
                    <tr>
                        <th>Product Name :</th>
                        <td><?php echo $bname; ?></td>
                    </tr>
                    <tr>
                        <th>Product Price :</th>
                        <td>Rs. <?php echo number_format($bprice); ?>/-</td>
                    </tr>
                    <!-- <tr>
                        <th>Delivery Charge :</th>
                        <td>Rs. <?php //echo number_format($del_charge); ?>/-</td>
                    </tr>
                    <tr>
                        <th>Total Price :</th>
                        <td>Rs. <?php //echo number_format($bprice); ?>/-</td>
                    </tr> -->
                </table>
                <br><br>
                <h4>Enter Your Details :</h4>

                <!-- Payment Form -->
                <form id="paymentForm" action="" method="POST" accept-charset="utf-8">
                    <input type="hidden" name="bname" value="<?php echo $bname; ?>">
                    <input type="hidden" name="bprice" value="<?php echo $bprice; ?>">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Enter Your Email" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="tel" name="phone" class="form-control" placeholder="Enter Your Mobile No." required>
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger" id="rzp-button1">Click To Pay : Rs. <?php echo number_format($bprice); ?>/-</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Razorpay configuration
        var options = {
            "key": "rzp_test_LC2zYOHIXfEq1t", // Replace with your actual Razorpay API key
            "amount": "<?php echo $bprice * 100; ?>", // Amount is in currency subunits. Convert rupees to paise.
            "currency": "INR",
            "name": "Library Management System",
            "description": "Book Shop",
            "image": "https://example.com/your_logo",
            "handler": function(response) {
                alert(response.razorpay_payment_id);
                alert(response.razorpay_order_id);
                alert(response.razorpay_signature)
            },
            "prefill": {
                // Prefill customer details based on form input
                "name": "<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>",
                "email": "<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>",
                "contact": "<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>"
            },
            "notes": {
                "address": "Razorpay Corporate Office"
            },
            "theme": {
                "color": "#3399cc"
            }
        };

        // Create a new Razorpay instance
        var rzp1 = new Razorpay(options);

        // Open Razorpay payment modal on button click
        document.getElementById('rzp-button1').onclick = function(e) {
            rzp1.open();
            e.preventDefault();
        }
    </script>
</body>

</html>

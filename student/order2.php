<?php
include("connection.php");
include("navbar.php");






if (isset($_GET['bid'])) {
    $id = $_GET['bid'];
    $sql = "SELECT * FROM `books` WHERE `bid`='$id'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);

    $bname = $row['name'];
    $bprice = $row['price'];
    // $del_charge = 50;
    // $total_price = $bprice + $del_charge;
    $bimage = $row['bimage'];
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
                        <td>
                            <?php echo $bname; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Product Price :</th>
                        <td>Rs.
                            <?php echo number_format($bprice); ?>/-
                        </td>
                    </tr>
                    <tr>
                        <th>Delivery Charge :</th>
                        <td>Rs.
                            <?php echo number_format($del_charge); ?>/-
                        </td>
                    </tr>
                    <tr>
                        <th>Total Price :</th>
                        <td>Rs.
                            <?php echo number_format($bprice); ?>/-
                        </td>
                    </tr>
                </table>
                <br><br>
                <h4>Enter Your Details :</h4>


                <form action="pay2.php" method="POST" accept-charset="utf-8">
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
                        <input type="tel" name="phone" class="form-control" placeholder="Enter Your Mobile No."
                            required>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-danger"
                            value="Click To Pay : Rs. <?php echo number_format($bprice); ?>/-">
                    </div>
                </form>


            </div>
        </div>
    </div>




    

</body>

</html>
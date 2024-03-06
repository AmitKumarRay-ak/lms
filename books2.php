<?php
include("connection.php");
include("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Inventory</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-A7lRDzWYr5lO1cR+xr8RPAUC8p6bZD8+NmY1wGPTUzr3AnlnL6vNkji9+gPHJN2Z" crossorigin="anonymous">
</head>

<body>
    <?php
    $sql = "SELECT * FROM `books` ";
    $result = mysqli_query($db, $sql);
    ?>

    <center>
        <h2>List of Books</h2>
    </center>
    <hr>

    <!-- Search Bar -->
    <div class="d-flex justify-content-end mt-3" style="margin-right:85px">
        <form action="" method="POST" class="navbar-form" name="form1">
            <div class="form-outline" data-mdb-input-init>
                <input class="rounded-pill border border-danger p-2" type="text" name="search"
                    placeholder="Search books by name ..." required>
                <button type="submit" name="submit" class="btn btn-default border border-success me-4">
                    <i class="fas fa-search" style="color: #63E6BE;"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Request Book Search Bar -->
    <div class="d-flex justify-content-end mt-3">
        <form action="" method="POST" class="navbar-form" name="form2">
            <div class="form-outline" data-mdb-input-init>
                <input class="rounded-pill border-bottom border-danger p-2" type="text" name="bid"
                    placeholder="Enter Book ID ...">
                <button type="submit" name="submit1" class="btn btn-default border border-success me-4">Request
                    Book</button>
            </div>
        </form>
    </div>

    <!-- PHP Code for Book Search -->
    <?php
    if (isset($_POST['submit'])) {
        $search_query = $_POST['search'];
        $query = "SELECT * FROM `books` WHERE name LIKE '%$search_query%'";
        $q = mysqli_query($db, $query);

        if (mysqli_num_rows($q) == 0) {
            echo "Sorry! No Books Found. Try searching for another book.";
        } else {
            echo "<div class='container'><div class='row'>";
            while ($row = mysqli_fetch_assoc($q)) {
                ?>
                <div class="col-lg-4 mt-3 mb-3">
                    <div class="card-deck">
                        <div class="card border-info p-2">
                            <img src="admin/<?php echo $row['bimage']; ?>" class="card-img-top" height="320">
                            <h5>Book ID:
                                <?php echo $row['bid']; ?>
                            </h5>
                            <h5 class="card-title">Book Name:
                                <?php echo $row['name']; ?>
                            </h5>
                            <h3>Price:
                                <?php echo number_format($row['price']); ?>/-
                            </h3>
                            <a href="order.php?id=<?php echo $row['bid']; ?>" class="btn btn-danger btn-block btn-lg">Buy Now</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            echo "</div></div>";
        }
    } else {
        echo "<div class='container'><div class='row'>";
        $query = "SELECT * FROM `books`";
        $result = mysqli_query($db, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-lg-4 mt-3 mb-3">
                <div class="card-deck">
                    <div class="card border-info p-2">
                        <img src="admin/<?php echo $row['bimage']; ?>" class="card-img-top" height="320">
                        <h5>Book ID:
                            <?php echo $row['bid']; ?>
                        </h5>
                        <h5 class="card-title">Book Name:
                            <?php echo $row['name']; ?>
                        </h5>
                        <h3>Price:
                            <?php echo number_format($row['price']); ?>/-
                        </h3>
                        <a href="order.php?id=<?php echo $row['bid']; ?>" class="btn btn-danger btn-block btn-lg">Buy Now</a>
                    </div>
                </div>
            </div>
            <?php
        }
        echo "</div></div>";
    }
    ?>


    <!-- PHP Code for Book Request -->
    <?php
    if (isset($_POST['submit1'])) {
        if (isset($_SESSION['login_user'])) {
            $sql1 = mysqli_query($db, "SELECT * FROM `books` WHERE bid='$_POST[bid]' ");
            $row1 = mysqli_fetch_assoc($sql1);
            $count1 = mysqli_num_rows($sql1);
            if ($count1 != 0) {
                mysqli_query($db, "INSERT INTO `issue_book`(`username`, `bid`, `approv`, `issue`, `return`) VALUES ('$_SESSION[login_user]','$_POST[bid]','','','')");
                echo "<script>window.location = 'request.php';</script>";
            } else {
                echo "<script>alert('Book does not exist in the library.');</script>";
            }
        } else {
            echo "<script>alert('You need to login first to request a book.');</script>";
        }
    }
    ?>
</body>

</html>
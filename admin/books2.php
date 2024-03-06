<?php
include("connection.php");
include("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>book2</title>
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

    <!-------------------- searchbar -------------------->
    <div class="d-flex justify-content-end mt-3" style="margin-right:85px">
        <form action="" method="POST" class="navbar-form" name="form1">
            <div class="form-outline" data-mdb-input-init>
                <input class="rounded-pill border border-danger p-2" type="text" name="search"
                    placeholder="search books name ..." required>
                <button type="submit" name="submit" class="btn btn-default border border-success me-4">
                    <i class="fa-solid fa-magnifying-glass fa-beat" style="color: #63E6BE;"></i>
                </button>
            </div>
        </form>
    </div>

    



    <?php
    if (isset($_POST['submit'])) {
        $search_query = $_POST['search'];
        $query = "SELECT * FROM `books` WHERE name LIKE '%$search_query%'";
        $q = mysqli_query($db, $query);

        if (mysqli_num_rows($q) == 0) {
            echo "Sorry! No Books Found. Try Searching Other Book";
        } else {
?>
            <div class="container">
                <div class="row">
                    <?php
                        while ($row = mysqli_fetch_assoc($q)) {
                    ?>
                        <div class="col-lg-4 mt-3 mb-3">
                            <div class="card-deck">
                                <div class="card border-info p-2">
                                    <img src="<?php echo $row['bimage']; ?>" class="card-img-top" height="320">
                                    <h3>Book ID: <?php echo $row['bid']; ?></h3>
                                    <h5 class="card-title">Book Name: <?php echo $row['name']; ?></h5>
                                    <h3>Price: <?php echo number_format($row['price']); ?>/-</h3>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
<?php
        }
    } else {
?>
        <div class="container">
            <div class="row">
                <?php
                    $query = "SELECT * FROM `books`";
                    $result = mysqli_query($db, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="col-lg-4 mt-3 mb-3">
                        <div class="card-deck">
                            <div class="card border-info p-2">
                                <img src="<?php echo $row['bimage']; ?>" class="card-img-top" height="320">
                                <h5>Book ID: <?php echo $row['bid']; ?></h5>
                                <h5 class="card-title">Book Name: <?php echo $row['name']; ?></h5>
                                <h3>Price: <?php echo number_format($row['price']); ?>/-</h3>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
<?php
    }
?>




</body>

</html>
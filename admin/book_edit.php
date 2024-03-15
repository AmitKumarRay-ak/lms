<?php
include("connection.php");
include("navbar.php");
?>



<?php
include("connection.php");

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    $query = "SELECT * FROM `books` WHERE bid = $book_id";
    $result = mysqli_query($db, $query);
    $book_data = mysqli_fetch_assoc($result);

    if (!$book_data) {
        echo "Book not found.";
        exit;
    }
}

// If form is submitted for updating the book
if (isset($_POST['update'])) {
    $book_id = $_POST['bid'];
    $book_name = $_POST['name'];
    $author_name = $_POST['authors'];
    $edition = $_POST['edition'];
    $status = $_POST['status'];
    $quantity = $_POST['quantity'];
    $department = $_POST['department'];
    $price = $_POST['price'];

    // Update the book details in the database
    $update_query = "UPDATE `books` SET 
                    name = '$book_name',
                    authors = '$author_name',
                    edition = '$edition',
                    status = '$status',
                    quantity = '$quantity',
                    department = '$department',
                    price = '$price'
                    WHERE bid = $book_id";

    $update_result = mysqli_query($db, $update_query);

    if ($update_result) {
        // echo "Book details updated successfully.";
        ?>
        <script>
            window.location = "books.php";
        </script>
        <?php
    } else {
        echo "Error updating book details.";
    }
}
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    
        body::-webkit-scrollbar{
            display: none;
        }

        .sidenav {
            height: 100%;
            margin-top: 60px;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #333032;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .side_nav_button a {
            color: white;
        }

        .side_nav_button:hover {
            color: white;
            width: 300px;
            height: 50px;
            background-color: #acc3e8;
        }


        /* form css */
        .container {
            width: 100%;
            max-width: 400px;
        }

        .card {
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            padding: 3px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease-in-out;
            outline: none;
            color: #333;
        }

        input:focus {
            border-color: #ff4500;
        }

        button {
            background-color: #ff4500;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        button:hover {
            background-color: #e63900;
        }

        /* form css end */

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }
    </style>
</head>

<body class="bg-warning-subtle">

    <h4 class="text"></h4>

    <form class="" action="" method="POST" enctype="multipart/form-data">
        <h2 class="text-danger">Edit Books Details</h2>
        <div class="container">
            <div class="card bg-warning-subtle">

                <input class="rounded-pill ps-3" type="hidden" name="bid" value="<?php echo $book_data['bid']; ?>" placeholder="Book ID"><br>
                <input class="rounded-pill ps-3" type="text" name="name" value="<?php echo $book_data['name']; ?>" placeholder="Book name"><br>
                <input class="rounded-pill ps-3" value="<?php echo $book_data['authors']; ?>" type="text" id="" name="authors" placeholder="Book Author"
                    required><br>
                <input class="rounded-pill ps-3" value="<?php echo $book_data['edition']; ?>" type="text" id="" name="edition" placeholder="Edition" required><br>
                <input class="rounded-pill ps-3" value="<?php echo $book_data['status']; ?>" type="text" id="" name="status" placeholder="Status" required><br>
                <input class="rounded-pill ps-3" value="<?php echo $book_data['quantity']; ?>" type="text" id="" name="quantity" placeholder="Book Quantity"
                    required><br>
                <input class="rounded-pill ps-3" value="<?php echo $book_data['department']; ?>" type="text" id="" name="department" placeholder="Book Department"
                    required><br>
                <input class="rounded-pill ps-3" value="<?php echo $book_data['price']; ?>" type="text" id="" name="price" placeholder="Price" required><br>
                <input class="btn btn-success" type="submit" name="update" value="Update">

            </div>
        </div>
    </form>


</body>

</html>
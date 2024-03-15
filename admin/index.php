<?php
include("connection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        body::-webkit-scrollbar{
            display: none;
        }
    </style>
</head>

<body>
    <div class="">


        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">
                        <img src="images/books.png" alt="Alternate Text" width="40" height="40" />
                        E-Library
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <?php
                        if (isset($_SESSION['login_user'])) {
                            // echo "Welcome : ".$_SESSION['login_user'];
                            ?>
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="align-items: right;">

                                <li class="btn nav-item">
                                    <a class="text-decoration-none text-success" href="profile.php">
                                        <?php
                                        // echo "Welcome : " . $_SESSION['login_user'];
                                        echo "<img class='rounded-circle img-circle profile_img' style='height:30px; width:30px;' src='images/" . $_SESSION['pic'] . " '>";
                                        echo " " . $_SESSION['login_user'];
                                        ?>
                                    </a>
                                </li>
                                <li class="btn nav-item"><a class="badge rounded-pill text-bg-danger text-decoration-none"
                                        href="profile.php">PROFILE</a></li>
                                <li class="btn nav-item"><a class="text-decoration-none" href="index.php">HOME</a></li>
                                <li class="btn nav-item"><a class="text-decoration-none" href="books.php">BOOKS</a>
                                </li>
                                <li class="btn nav-item"><a class="text-decoration-none" href="logout.php">LOGOUT</a>
                                </li>
                                <li class="btn nav-item"><a class="text-decoration-none" href="feedback.php">FEEDBACK</a>
                                </li>
                            </ul>
                            <?php
                        } else {
                            ?>
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="align-items: right;">
                                <li class="btn nav-item"><a class="text-decoration-none" href="index.php">HOME</a></li>
                                <li class="btn nav-item"><a class="text-decoration-none" href="books.php">BOOKS</a>
                                </li>
                                <li class="btn nav-item"><a class="text-decoration-none" href="admin_login.php">LOGIN</a>
                                </li>
                                <li class="btn nav-item"><a class="text-decoration-none" href="feedback.php">FEEDBACK</a>
                                </li>
                            </ul>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </nav>
        </header>



        <section>
            <div class="sec_img">
                <br>
                <div class="box">
                    <h1 style="text-align: center; font-size: 35px;">Welcome to Library</h1><br>
                </div>
            </div>






            <div class="row m-2">
                <div class="col-md-4">
                    <center>
                        <img width="150px" src="images/digital-inventory.png" />
                        <h4>Digital Book Inventory</h4>
                        <p class="text-justify">
                            The Digital Book Inventory Management System is a comprehensive
                            solution designed to efficiently manage and track digital book
                            collections. Whether you're a digital library, publishing house,
                            or an individual with a vast e-book collection, this system
                            offers a user-friendly interface combined with robust
                            functionalities to streamline your inventory processes.
                        </p>
                    </center>
                </div>

                <div class="col-md-4">
                    <center>
                        <img width="150px" src="images/search-online.png" />
                        <h4>Digital Book Searching</h4>
                        <p class="text-justify">
                            In the expansive realm of digital literature, finding the right
                            book can often feel like searching for a needle in a haystack.
                            The Digital Book Search Engine emerges as a beacon, offering
                            users an intuitive platform to explore, discover, and access a
                            vast array of digital books. Tailored with advanced search
                            algorithms and user-centric features, this tool transforms the
                            way readers connect with their next literary adventure.
                        </p>
                    </center>
                </div>

                <div class="col-md-4">
                    <center>
                        <img width="150px" src="images/defaulters-list.png" />
                        <h4>Digital Book Defaulter</h4>
                        <p class="text-justify">
                            It appears there might be some confusion regarding the term
                            "digital book defaulter," as this phrase is not commonly used in
                            the context of digital books or e-publishing. Typically, the
                            term "defaulter" refers to someone who fails to fulfill a
                            financial obligation or meet a deadline. If you are referring to
                            a specific concept or scenario related to digital books, please
                            provide more context or clarify the term, and I would be happy
                            to assist you further. Alternatively, if you have a different
                            topic or request in mind, please let me know, and I'll do my
                            best to help.
                        </p>
                    </center>
                </div>
            </div>




            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <center>
                            <h2>Our Process</h2>
                            <p><b>We have a Simple 3 Step Process</b></p>
                        </center>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <center>
                            <img width="150px" src="images/sign-up.png" />
                            <h4>Sign Up</h4>
                            <p class="text-justify">
                                Signup is the initial step that unlocks a world of personalized
                                experiences tailored to your preferences and needs. Whether
                                you're joining a new platform, accessing exclusive content, or
                                becoming part of a community, the signup process is designed to
                                create a seamless and secure connection between you and the
                                digital environment you wish to explore.
                            </p>
                        </center>
                    </div>

                    <div class="col-md-4">
                        <center>
                            <img width="150px" src="images/search-online.png" />
                            <h4>Digital Book Inventory</h4>
                            <p class="text-justify">
                                In the expansive realm of digital literature, finding the right
                                book can often feel like searching for a needle in a haystack.
                                The Digital Book Search Engine emerges as a beacon, offering
                                users an intuitive platform to explore, discover, and access a
                                vast array of digital books. Tailored with advanced search
                                algorithms and user-centric features, this tool transforms the
                                way readers connect with their next literary adventure.
                            </p>
                        </center>
                    </div>

                    <div class="col-md-4">
                        <center>
                            <img width="150px" src="images/library.png" />
                            <h4>Visit Us</h4>
                            <p class="text-justify">
                                Embarking on a journey to [Company/Organization Name] offers an
                                immersive experience, where innovation, passion, and dedication
                                converge to shape remarkable narratives. Whether you're a
                                curious visitor, a prospective partner, or a valued stakeholder,
                                our doors are open to welcome you into our world, unveiling the
                                stories, innovations, and values that define who we are and what
                                we stand for.
                            </p>
                        </center>
                    </div>
                </div>
            </div>






    </div>
    </section>


    <?php
    include("footer.php");
    ?>
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
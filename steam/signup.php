<?php
$showAlert = false;
$showError = false;
$exists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Include file which makes the
    // Database Connection.
    include 'db.php';

    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];


    $sql = "Select * from users where username='$username'";

    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);


    // Этот sql-запрос используется для проверки
    // имя пользователя уже присутствует
    // или нет в нашей базе данных
    if ($num == 0) {
        if (($password == $cpassword) && $exists == false) {

            $hash = password_hash(
                $password,
                PASSWORD_DEFAULT
            );
            $today = date("Y-m-d H:i:s");

            // Password Hashing is used here. 
            $sql = "INSERT INTO `users` ( `username`, 
                `password`,`cpassword`) VALUES ('$username', 
                '$hash','$hash')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                $showAlert = true;
            }
        } else {
            $showError = "Passwords do not match";
        }
    }

    if ($num > 0) {
        $exists = "Username not available";
    }
} //end if   

?>

<!doctype html>

<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, 
        shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="header">
        <img src="/image/image 1.png" alt="#">
        <p>STORE</p>
        <p>COMMUNITY</p>
        <p><a href="/library.php" type="text"> LIBRARY </a></p>
        <p>SUPPORT</p>
        <div>login | Language</div>
    </header>

    <?php

    if ($showAlert) {

        echo ' <div class="alert alert-success 
            alert-dismissible fade show" role="alert">
    
            <strong>Success!</strong> Your account is 
            now created and you can login. 
            <button type="button" class="close"
                data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">×</span> 
            </button> 
        </div> ';
    }

    if ($showError) {

        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert"> 
        <strong>Error!</strong> ' . $showError . '
    
       <button type="button" class="close" 
            data-dismiss="alert aria-label="Close">
            <span aria-hidden="true">×</span> 
       </button> 
     </div> ';
    }

    if ($exists) {
        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert">
    
        <strong>Error!</strong> ' . $exists . '
        <button type="button" class="close" 
            data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> 
        </button>
       </div> ';
    }

    ?>

    <div class="container my-4 ">

        <h1 class="text-center">CREATE YOUR ACCAUNT</h1>
        <form action="signup.php" method="post">

            <div class="form-group">
                <label for="username" class="User__name">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
                <label for="password" class="text-center">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="cpassword" class="text-center">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">

                <small id="emailHelp" class="form-text text-muted">
                    Make sure to type the same password
                </small>
            </div>

            <button type="submit" class="btn btn-primary">
                SignUp
            </button>
        </form>
    </div>
    <footer class="footer">
        <section class="footer-flex">
            <div class="foot-text">
                <a href="/auth.php" type="text" class="join_steam">Join Steam and discover<br>thousands of games to play.<br>Learn More</a>
            </div>
            <img src="/image/image 16.png" alt="#">
            <p><a href="/auth.php" type="text" class="join_steam">Join Steam <br> it's free and easy yo use. </a></p>
            <div class="lino"></div>
        </section>
        <div class="line"></div>
        <section class="flex-img">
            <img src="/image/image 15.png" alt="">
            <p>© 2022 Valve Corporation. All rights reserved. All trademarks are property of their respective owners in the US and other countries.<br>
                VAT included in all prices where applicable. Privacy Policy | Legal | Steam Subscriber Agreement | Refunds | Cookies
            </p>
            <img src="image/image 1.png" alt="">
        </section>
        <div class="line"></div>
        <section class="footer_flex">About Valve | Jobs | Steamworks | Steam Distribution | Support | Gift Cards | Steam | @steam</section>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="
https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="
sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script src="
https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <script src="
https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

</body>

</html>
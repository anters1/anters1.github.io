<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/librarycss.css">
    <title>library</title>
</head>

<body>
    <?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include('db.php');
    $result = mysqli_query($conn, "select * from `games`");
    ?>
    <header class="header">
        <img src="/image/image 1.png" alt="#">
        <p>STORE</p>
        <p>COMMUNITY</p>
        <p><a href="library.php" type="text"> LIBRARY </a></p>
        <p><a href="adminpanel.php" type="text">  SUPPORT</a></p>
        <div>login | Language</div>
    </header>


    <section class="flex_shop">
        <div class="product-item">
            <form method="POST" action="function.php"></form>
            <?php
            include('db.php');
            $result = mysqli_query($conn, "select * from `games`");

            while ($row = mysqli_fetch_array($result)) {


            ?>
                <img src="image/<? echo $row['4']; ?>" alt="">
                <? ?>
                <a href="infogame.php">
                    <div class="product-list">
                        <h3>
                            <?php echo $row[1]; ?>
                        </h3>
                        <span class="price"> <? echo $row['3']; ?>₽
                        <?php
                    } ?>

                        </span>
                        <a href="download.php" class="button">Выиграть</a>
                    </div>
        </div>
        
      
        
    </section>
    <footer class="footer">
        <section class="footer-flex">
            <div class="foot-text">
                <a href="auth.php" type="text" class="join_steam">Join Steam and discover<br>thousands of games to play.<br>Learn More</a>
            </div>
            <img src="/image/image 16.png" alt="#">
            <p><a href="auth.php" type="text" class="join_steam">Join Steam <br> it's free and easy yo use. </a></p>
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
</body>

</html>
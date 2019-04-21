
<?php
include "includes/dbh.inc.php";

$itemID = mysqli_real_escape_string($conn,$_GET['item']);

$sql01 = "SELECT * FROM `items`,`user` WHERE items.user_id= user.user_id AND items.item_id= '$itemID'";
$result01 = mysqli_query($conn,$sql01);
$row01 = mysqli_fetch_assoc($result01);


$sql02 = "SELECT * FROM `images` WHERE `item_id`= '$itemID'";
$result02 = mysqli_query($conn,$sql02);

$total = mysqli_num_rows($result02)+1;
$total01 = mysqli_num_rows($result02);

$sql03 = "SELECT * FROM `images` WHERE `item_id`= '$itemID'";
$result03 = mysqli_query($conn,$sql03);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Item View</title>
    <!---->
    <!--Add CSS links-->
    <link rel="stylesheet" href="assets/CSS/style.css">
    <link rel="stylesheet" href="assets/CSS/unsemantic-grid-responsive-tablet.css">

</head>
<body>
<header>
    <a href="index.php" style="float: left;"><h1>Hand</h1></a>
    <?php
    session_start();
    if (isset($_SESSION['u_id'])){
        ?>
        <a href="profilepg.php"><?php echo $_SESSION['u_username'];?></a><p style="color: white; float: right; margin-right: 10px; margin-top: 3px;">Welcome</p><br><br>
        <form action="includes/logout.inc.php" method="POST" style=" margin-right: 20px; margin-top: 4px;">
            <input type="submit" name="logout" value="Log-Out" style="float: right; color: red; ">
        </form>
        <?php
    }else{
        ?>
        <a href="Registration.php">Login/Register</a><br><br>
        <?php
    }
    ?>
</header>
<main class="grid-container">
<section class="grid-66">
    <br>
    <p><b>Title:</b> <?php echo $row01['item_name'];?></p><br>
    <p><b>Suburb:</b> <?php echo $row01['suburb'].", ".$row01['city'];?></p>
    <p><b>Price:</b> $<?php echo $row01['price'];?></p>

    <div class="container">
    <?php
    $_SESSION['count'] = 1;
    for ($i=1 ; $i < $total;  $i++){
        while ($row = mysqli_fetch_assoc($result02)){
?>
            <div class="mySlides">
                <div class="numbertext"><?php echo $_SESSION['count'];?> / <?php echo $total01;?></div>
                <img src="assets/uploads/<?php echo $row['image_name']; ?>" style="width:300px; height: 300px;">

            </div>
            <?php
            $_SESSION['count']++;
        }
    }
    $_SESSION['count'] = 1;
?>
        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>

        <div class="row">

            <?php
            $_SESSION['count2'] = 1;
            for ($i=1 ; $i < $total;  $i++){
            while ($row = mysqli_fetch_assoc($result03)){
?>
                <div class="column">
                    <img class="demo cursor" src="assets/uploads/<?php echo $row['image_name']; ?>" style="width:40%" onclick="currentSlide(<?php echo $_SESSION['count2'];?>)">
                </div>

                <?php
                $_SESSION['count2']++;
            }
            }
            $_SESSION['count2'] = 1;
            ?>
        </div>
    </div>

    <br><br>
    <p><b>Category:</b> <?php echo $row01['category'];?></p><br>
    <p><b>Description:</b></p>
    <p><?php echo $row01['item_disc'];?></p><br><br>
</section>
<aside class="grid-44">
    <div class="contact" style=" height: 80px; ">
    <br><p><b>Seller <?php echo $row01['username'];?> contact:</b></p><br>
    <p><b>mob:</b> <?php echo $row01['mob'];?></p>
    <p><b>email:</b> <?php echo $row01['email'];?></p><br>
    </div>
</aside>
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
            captionText.innerHTML = dots[slideIndex-1].alt;
        }
    </script>


</main>
</body>
</html>
<!DOCTYPE html>
<html lang="en">






<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
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


<main>
    <br>
    <!--
    <section>
        <div id="searchBox" class="CsearchBox">
            <div>
            <form action="#" method="POST">
                <div>
                <input type="text" name="productItem" placeholder="Item...">
                </div>
                <div>
                <p>in</p>
                </div>
                <div>
                <select>
                    <option>Postcode or location</option>
                </select>
                </div>
                <div>
                    <button type="submit">GO</button>
                </div>
            </form>
            </div>
        </div>
        <br>
        <center>
        <div id="categories" class="Ccategories">
            <nav>
                <form action="#" method="POST">
                    <button type="submit">MOTORS</button>
                    <button type="submit">FOR SALE</button>
                    <button type="submit">PROPERTY</button>
                    <button type="submit">JOBS</button>
                    <button type="submit">SERVICES</button>
                    <button type="submit" style="padding-left: 1px; padding-right: 1px">COMMUNITY</button>
                    <button type="submit">ANIMALS</button>
                </form>
            </nav>
        </div>
        </center>
    </section>
    -->
    <center>
        <div id="adLocation" class="CadLocation">
            <section >
                <img src="assets/images/cytonn-photography-604681-unsplash.jpg" style="height: 300px; width: 80%">
            </section>
        </div>
    </center>
    <br><br>
    <center>
    <section>
        <div>
            <table>

                    <?php
                    include "includes/dbh.inc.php";



                    $sql = "SELECT * FROM `items`,`images` WHERE items.item_id= images.item_id AND images.main= '1'";
                    $result = mysqli_query($conn,$sql);

                    $drafty = mysqli_num_rows($result)/3;
                    $y = ceil($drafty);

                    for($i = 0 ; $i < $y;  $i++){
                        echo "<tr>";
                        for ($a = 0; $a < 3; $a++){
                            $row = mysqli_fetch_assoc($result);
                            if (isset($row['item_name'])) {
                                ?>
                                <td><a href="itemViewpg.php?item=<?php echo $row['item_id']; ?>">
                                        <article class="show"><img
                                                    src="assets/uploads/<?php echo $row['image_name']; ?>" style="width: 220px; height: 220px;">
                                            <p><?php echo $row['item_name']; ?></p>
                                            <p>$<?php echo $row['price']; ?></p></article>
                                    </a></td>
                                <?php
                            }else{

                                echo "<td></td>";
                            }
                        }
                        echo "</tr>";
                    }

                    ?>


        </div>
    </section><br><br>
    </center>

</main>


</body>






</html>
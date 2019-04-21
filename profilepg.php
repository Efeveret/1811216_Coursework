<?php
session_start();

if (isset($_SESSION['u_admin'])){
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin</title>
        <!---->
        <!--Add CSS links-->
        <link rel="stylesheet" href="assets/CSS/style.css">
        <link rel="stylesheet" href="assets/CSS/unsemantic-grid-responsive-tablet.css">

    </head>
    <body>
    <header>
        <a href="index.php" style="float: left;"><h1>Hand</h1></a>
        <a href="profilepg.php"><?php echo $_SESSION['u_username'];?></a><p style="color: white; float: right; margin-right: 10px; margin-top: 3px;">Welcome</p><br><br>
        <form action="includes/logout.inc.php" method="POST" style=" margin-right: 20px; margin-top: 4px;">
            <input type="submit" name="logout" value="Log-Out" style="float: right; color: red; ">
        </form>
    </header>
    <main>
        <center>
            <br><h1>ADMIN PANEL</h1><br>
        </center>
        <section>
            <br><h2>Current Admins</h2>

            <table style="width: 100%">
                <tr>
                    <th>First Name</th>
                    <th>Username</th>
                </tr>
                <tr>
                    <?php
                    include "includes/dbh.inc.php";

                    $uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);

                    $sql = "SELECT * FROM `user` WHERE `admin`= '1' AND user_id NOT IN ('$uid')";
                    $result = mysqli_query($conn,$sql);

                    for ($i = 0 ; $i < mysqli_num_rows($result);  $i++){
                        while ($row = mysqli_fetch_assoc($result)){
                            //$abc = $row["Project_ID"];


                            echo "<td>".$row["fname"]."</td>";
                            echo "<td>".$row["username"]."</td>";
                        }
                    }
                    ?>
                </tr>
            </table>
        </section>
        <section>
            <br><h2>Register Admin</h2>
            <div>
                <form action="includes/admin.php" method="POST">
                    <p>*Given Name:</p>
                    <input type="text" name="first" style="width:236px;" required><br><br>
                    <p>*Family Name:</p>
                    <input type="text" name="last" style="width:236px; " required><br><br>
                    <p>*User ID:</p>
                    <input type="text" name="uid" style="width:236px; " required><br><br>
                    <p>*Password:</p>
                    <input type="password" name="pwd" style="width:236px; " required><br><br>
                    <p>*Email:</p>
                    <input type="text" name="email" style="width:236px;" required><br><br>
                    <p>*Suburb:</p>
                    <input type="text" name="sub" style="width:236px;" required><br><br>
                    <p>*City:</p>
                    <input type="text" name="city" style="width:236px;" required><br><br>
                    <p>*Mobile:</p>
                    <input type="number" name="mob" max="999999999" style="width:236px;" required><br><br>
                    <br>
                    <button type="submit" name="submit01">Register</button>
                    <br>
                    <br>
                    <span class="PSTEXT">* Required Information</span>
                </form>
            </div>
        </section>
        <section>
            <br><h2>Delete Admin</h2><br>
            <form action="includes/admin.php" method="POST">
            <select name="adminSel">
                <?php

                $sql01 = "SELECT * FROM `user` WHERE `admin`= '1' AND user_id NOT IN ('$uid')";
                $result01 = mysqli_query($conn,$sql01);
                for ($i = 0 ; $i < mysqli_num_rows($result01);  $i++){
                    while ($row = mysqli_fetch_assoc($result01)){

                        echo "<option>".$row["username"]."</option><br>";

                    }
                }
                ?>
            </select><br>
            <button type="submit" name="delete">Delete</button>
            </form>
        </section><br>

    </main>

    </body>
    </html>
    <?php
}elseif (isset($_SESSION['u_id'])) {
?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Seller Page</title>
        <!---->
        <!--Add CSS links-->
        <link rel="stylesheet" href="assets/CSS/style.css">
        <link rel="stylesheet" href="assets/CSS/unsemantic-grid-responsive-tablet.css">

    </head>
    <body>
    <header>
        <a href="index.php" style="float: left;"><h1>Hand</h1></a>
        <a href="profilepg.php"><?php echo $_SESSION['u_username'];?></a><p style="color: white; float: right; margin-right: 10px; margin-top: 3px;">Welcome</p><br><br>
        <form action="includes/logout.inc.php" method="POST" style=" margin-right: 20px; margin-top: 4px;">
            <input type="submit" name="logout" value="Log-Out" style="float: right; color: red; ">
        </form>
    </header>
    <main>
        <section>
            <form action="includes/profileLinks.php" method="POST">
                <input type="submit" name="regitem" value="Post New Ad"
                       style="float: right; color: red; margin-right: 10px ">
            </form>
            <!--
            <form action="#" method="POST">
                <input type="submit" name="logout" value="editUserDetails"
                       style="float: right; color: red; margin-right: 10px ">
            </form>-->
        </section>
        <br>
        <section>
            <div>
                <br><h2>Live Posts</h2><br>
                <form action="includes/profileLinks.php" method="POST">
                <table>
                    <tr>
                        <th>User Posts </th>
                        <th> Actions</th>
                    </tr>

                        <?php
                        include "includes/dbh.inc.php";

                        $uid = mysqli_real_escape_string($conn,$_SESSION['u_id']);

                        $sql = "SELECT * FROM `items`,`images` WHERE items.item_id= images.item_id AND items.user_id= '$uid' AND images.main= '1'";
                        $result = mysqli_query($conn,$sql);

                        for ($i = 0 ; $i < mysqli_num_rows($result);  $i++){
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                <td>
                                    <article><img src="assets/uploads/<?php echo $row['image_name']; ?>" style="height: 200px; width: 200px">
                                        <p><?php echo $row['item_name']; ?></p></article>
                                </td>
                                <td>
                                    <button type="submit" name="update" value="<?php echo $row['item_id'];?>">Update</button>
                                    <button type="submit" name="del" value="<?php echo $row['item_id'];?>">Delete</button>
                                </td>
                                    <tr>
                                <?php
                            }}
                        ?>


                </table>
                </form>
            </div>
            <br>
        </section>
    </main>
    </body>
    </html>
    <?php
}
    ?>
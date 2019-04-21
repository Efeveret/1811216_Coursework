<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Item Page</title>
    <!---->
    <!--Add CSS links-->
    <link rel="stylesheet" href="assets/CSS/style.css">
    <link rel="stylesheet" href="assets/CSS/unsemantic-grid-responsive-tablet.css">
    <style>
        body{
            background: url("assets/images/istockphoto-988730014-2048x2048.jpg");
        }
    </style>
</head>
<body>
<header>
    <a href="index.php" style="float: left;"><h1>Hand</h1></a>
</header>
<main>
    <form action="includes/regitemACT.php" method="POST" enctype="multipart/form-data">
            <br>
        <h2>Create Post</h2><br><br>
        <p>Title:</p><input type="text" name="title" ><br><br>
        <p>Price:</p><input type="text" name="price" ><br><br>
        <p>Categories:</p>
        <select name="selected">
            <option>MOTORS</option>
            <option>FOR SALE</option>
            <option>PROPERTY</option>
            <option>JOBS</option>
            <option>SERVICES</option>
            <option>COMMUNITY</option>
            <option>PETS</option>
        </select><br><br>
        <p>Description:</p>
            <textarea rows="4" cols="50" name="desc"></textarea><br><br>
        <p>Upload Image:</p><input type="file" name="file"><button type="submit" name="submit">Upload</button><br><br><br>
<br><br>
        <?php
        session_start();
        include 'includes/dbh.inc.php';//connection file

        $itemID = mysqli_real_escape_string($conn,$_SESSION['item_id']);

        $sql = "SELECT * FROM `images` WHERE `item_id`= '$itemID'";
        $result = mysqli_query($conn,$sql);

        for ($i = 0 ; $i < mysqli_num_rows($result);  $i++){
            while ($row = mysqli_fetch_assoc($result)){
                //$abc = $row["Project_ID"];
                echo "<p>".$row["image_name"]."</p><br>";

            }
        }
        ?>
            <center>
            <button type="submit" name="submit02">Post Ad</button><button type="submit" name="submit03">Cancel</button><br><br>
            </center>
    </form>

</main>
</body>
</html>
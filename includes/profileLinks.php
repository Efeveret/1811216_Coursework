<?php
session_start();
if (isset($_POST['regitem'])){

    include_once 'dbh.inc.php';

    $uid = mysqli_real_escape_string($conn,$_SESSION['u_id']);

    $sql = "INSERT INTO `items`(`user_id`) VALUES ('$uid')";
    $result = mysqli_query($conn,$sql);
    $resultID = mysqli_insert_id($conn);

    $_SESSION['item_id'] = $resultID;


    header("Location: ../regItempg.php?success");
    exit();

}elseif (isset($_POST['update'])){
    $_SESSION['item_id'] = $_POST['update'];

    header("Location: ../regItempg.php?success");
    exit();

}elseif (isset($_POST['del'])){
    include 'dbh.inc.php';

    $itid = mysqli_real_escape_string($conn,$_POST['del']);


    $sql = "DELETE FROM `items` WHERE `item_id`= '$itid'";
    $result = mysqli_query($conn,$sql);

    $sql1 = "DELETE FROM `images` WHERE `item_id`= '$itid'";
    $result1 = mysqli_query($conn,$sql1);

    header("Location: ../profilepg.php?success");
    exit();


}else{
    header("Location: ../index.php");
    exit();
}

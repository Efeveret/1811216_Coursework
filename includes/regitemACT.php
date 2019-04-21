<?php
if (isset($_POST['submit03'])){
    session_start();
    include 'dbh.inc.php';

    $itemID = mysqli_real_escape_string($conn,$_SESSION['item_id']);

    $sql = "DELETE FROM `items` WHERE `item_id`= '$itemID'";
    $result = mysqli_query($conn,$sql);

    $sql02 = "DELETE FROM `images` WHERE `item_id`= '$itemID'";
    $result02 = mysqli_query($conn,$sql02);

    unset($_SESSION['item_id']);

    header("Location: ../profilepg.php?deleted");
    exit();

}elseif (isset($_POST['submit'])){
    session_start();
    include 'dbh.inc.php';
    $statusMsg = '';

    $targetDir = "C:/inetpub/wwwroot/1811216/1811216_Coursework/assets/uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){

        $itemID = mysqli_real_escape_string($conn,$_SESSION['item_id']);

        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                // Insert image file name into database

                $sql01 = "SELECT * FROM `images` WHERE `item_id`= '$itemID' AND `main`= 1";
                $result =  mysqli_query($conn,$sql01);
                $resultCheck = mysqli_num_rows($result);
                $insert;

                if ($resultCheck < 1){
                    $sql = "INSERT INTO `images`(`image_name`, `item_id`, `main`) VALUES ('".$fileName."','$itemID','1')";
                    $insert =  mysqli_query($conn,$sql);
                }else{
                    $sql = "INSERT INTO `images`(`image_name`, `item_id`) VALUES ('".$fileName."','$itemID')";
                    $insert =  mysqli_query($conn,$sql);
                }

                if($insert){
                    $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                }else{
                    $statusMsg = "File upload failed, please try again.";
                }
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }else{
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
        $_SESSION['u_pic'] = $fileName;
        header("Location: ../regItempg.php");
        exit();
    }
}elseif (isset($_POST['submit02'])){
    session_start();
    include 'dbh.inc.php';

    $uid = mysqli_real_escape_string($conn,$_SESSION['u_id']);
    $itemID = mysqli_real_escape_string($conn,$_SESSION['item_id']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $price = mysqli_real_escape_string($conn,$_POST['price']);
    $category = mysqli_real_escape_string($conn,$_POST['selected']);
    $desc = mysqli_real_escape_string($conn,$_POST['desc']);

    $sql = "UPDATE `items` SET `item_name`= '$title',`item_disc`= '$desc',`category`= '$category', `price`= '$price' WHERE `item_id` = '$itemID'";
    $insert =  mysqli_query($conn,$sql);


    header("Location: ../itemViewpg.php?item=".$itemID);
    exit();
}else{
    header("Location: ../index.php");
    exit();
}
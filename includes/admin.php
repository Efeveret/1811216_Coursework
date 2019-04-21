<?php
include_once 'dbh.inc.php';

if (isset($_POST['submit01'])) {

    $first = mysqli_real_escape_string($conn,$_POST['first']);//first is the name of the textbox
    $last = mysqli_real_escape_string($conn,$_POST['last']);
    $username = mysqli_real_escape_string($conn,$_POST['uid']);
    $pass = mysqli_real_escape_string($conn,$_POST['pwd']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $sub = mysqli_real_escape_string($conn,$_POST['sub']);
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $mob = mysqli_real_escape_string($conn,$_POST['mob']);

    if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){

        header("Location: ../profilepg.php?invallid_names");
        exit();
    } else{
        //Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){

            header("Location: ../profilepg.php?invallid_emails");
            exit();
        } else{
            //Check the database if there is a similar user
            $sql = "SELECT * FROM `user` WHERE `username`= '$username'";
            $result = mysqli_query($conn,$sql);
            $resultCheck = mysqli_num_rows($result);
            echo "hello3";
            if ($resultCheck > 0){

                header("Location: ../profilepg.php?userexists");
                exit();
            } else{
                //Hashing the password
                $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);

                //Inserting the user into the database
                $sql = "INSERT INTO `user`(`fname`, `lname`, `username`, `pass`, `suburb`, `city`, `admin`, `email`, `mob`) VALUES ('$first','$last','$username','$hashedPwd','$sub','$city','1','$email','$mob')";
                $result = mysqli_query($conn,$sql);

                header("Location: ../profilepg.php?success");
                exit();
            }
        }
    }
}elseif (isset($_POST['delete'])){
    $username = mysqli_real_escape_string($conn,$_POST['adminSel']);

    $sql = "DELETE FROM `user` WHERE `username`= '$username'";
    $result = mysqli_query($conn,$sql);

    header("Location: ../profilepg.php?success");
    exit();
}


<?php

if (isset($_POST['submit01'])) {

    include_once 'dbh.inc.php';

    $first = mysqli_real_escape_string($conn,$_POST['first']);//first is the name of the textbox
    $last = mysqli_real_escape_string($conn,$_POST['last']);
    $username = mysqli_real_escape_string($conn,$_POST['uid']);
    $pass = mysqli_real_escape_string($conn,$_POST['pwd']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $sub = mysqli_real_escape_string($conn,$_POST['sub']);
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $mob = mysqli_real_escape_string($conn,$_POST['mob']);

    //Error Handlers
        //Check if input characters are valid
        //Check if names have numbers in them
        if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){

            header("Location: ../Registration.php?Name_must_not_have_numbers01");
            exit();
        } else{
            //Check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){

                header("Location: ../Registration.php?Invalid_email01");
                exit();
            } else{
                //Check the database if there is a similar user
                $sql = "SELECT * FROM `user` WHERE `username`= '$username'";
                $result = mysqli_query($conn,$sql);
                $resultCheck = mysqli_num_rows($result);
                echo "hello3";
                if ($resultCheck > 0){

                    header("Location: ../Registration.php?User_exists01");
                    exit();
                } else{
                    //Hashing the password
                    $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);

                    //Inserting the user into the database
                    $sql = "INSERT INTO `user`(`fname`, `lname`, `username`, `pass`, `suburb`, `city`, `email`, `mob`) VALUES ('$first','$last','$username','$hashedPwd','$sub','$city','$email','$mob')";
                    $result = mysqli_query($conn,$sql);

                    header("Location: ../Registration.php?Success01");
                    exit();
                }
            }
        }

} elseif (isset($_POST['submit'])){
    session_start();
    include 'dbh.inc.php';//connection file

    //retrieve username/email and password through Post method
    $uid = mysqli_real_escape_string($conn, $_POST['userid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);






    //a select statement is done to the PHPMyAdmin to retrieve the information of the user...
    //...based on the first posted input
        $sql = "SELECT * FROM user WHERE username='$uid' OR email='$uid'  ";
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);

    //use of if statement to check if above query is not returning any results...
    //...aka no such user exists by that username or email
        if ($resultCheck < 1){
            header("Location: ../Registration.php?Login_Failed02");
            exit();

        //if the user exists, proceed on to the else statement to retrieve confirm password
        }else{
            if($row = mysqli_fetch_assoc($result)){
                //De-hashing password then compare with inputted password
                $hashedPWDCheck = password_verify($pwd,$row['pass']);

                //if password is not-correct, go through the if statement
                if ($hashedPWDCheck == false){
                    header("Location: ../Registration.php?Login_Failed02");
                    exit();

                    //if password is correct, go through elseif
                }elseif ($hashedPWDCheck == true){

                    //using the query that got the password from the database, get the
                    //...'admin' column (data-type: boolean) to check if (admin user), else (regular user)
                    if ($row['admin'] == 1){
                        $_SESSION['u_id'] = $row['user_id'];
                        $_SESSION['u_first'] = $row['fname'];
                        $_SESSION['u_last'] = $row['lname'];
                        $_SESSION['u_username'] = $row['username'];
                        $_SESSION['u_pwd'] = $row['pass'];
                        $_SESSION['u_email'] = $row['email'];
                        $_SESSION['u_sub'] = $row['suburb'];
                        $_SESSION['u_city'] = $row['city'];
                        $_SESSION['u_mob'] = $row['mob'];
                        $_SESSION['u_admin'] = $row['admin'];
                        header("Location: ../profilepg.php?admin");
                        exit();
                    }else{
                        $_SESSION['u_id'] = $row['user_id'];
                        $_SESSION['u_first'] = $row['fname'];
                        $_SESSION['u_last'] = $row['lname'];
                        $_SESSION['u_username'] = $row['username'];
                        $_SESSION['u_pwd'] = $row['pass'];
                        $_SESSION['u_email'] = $row['email'];
                        $_SESSION['u_sub'] = $row['suburb'];
                        $_SESSION['u_city'] = $row['city'];
                        $_SESSION['u_mob'] = $row['mob'];

                        header("Location: ../profilepg.php?regular");
                        exit();
                    }

                }
            }
        }


} else{
    header("Location: ../index.php");
    exit();
}
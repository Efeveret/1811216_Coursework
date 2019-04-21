
<!DOCTYPE html>
<html lang="en">






<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <!---->
    <!--Add CSS links-->
    <link rel="stylesheet" href="assets/CSS/style.css">
    <link rel="stylesheet" href="assets/CSS/unsemantic-grid-responsive-tablet.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $( function() {
            $( "#tabs" ).tabs();
        } );
    </script>
</head>



<body>


<header>
    <a href="index.php" style="float: left;"><h1>Hand</h1></a>
</header>


<main>
<br>
    <div id="tabs" class="Ctabs">
        <ul >
            <li><a href="#tabs-1">Login</a></li>
            <li><a href="#tabs-2">Register</a></li>
        </ul>
        <div id="tabs-1">
            <div>
                <form class="signin-form" action="includes/logReg.php" method="POST">
                    <h2>Sign-in</h2>
                    <input type="text" name="userid" placeholder="User ID" required>
                    <br>
                    <br>
                    <input type="password" name="pwd" placeholder="Password" required>
                    <br>
                    <br>
                    <button id="sub" type="submit" class="signin_bu" name="submit">Login</button>
                    <br><br>
                    <p id="er01"></p>
                    <br>
                </form>
            </div>
        </div>
        <div id="tabs-2">
            <div>
                <form class="signup-form" action="includes/logReg.php" method="POST">
                    <h2>Registration</h2><br><br>
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
                    <br>
                    <button type="submit" name="submit01">Register</button>
                    <br>
                    <br>
                    <span class="PSTEXT">* Required Information</span><br><br>
                    <p id="er02"></p>
                    <br>
                </form>
            </div>
        </div>
    </div>
<br>
<script>
var er = location.search.substr(1).replace(/_/g," ");
var sep = er.split(/0/g);

if (er){
    if(sep[1] == 1) {

            if(sep[0] == "Success"){
                 document.getElementById("er02").innerHTML = sep[0];
                 document.getElementById("er02").style.color= "white";
                 document.getElementById("er02").style.backgroundColor = "green";
                 document.getElementById("er02").style.textAlign = "center";
            } else{
                 document.getElementById("er02").innerHTML = sep[0];
                 document.getElementById("er02").style.color= "white";
                 document.getElementById("er02").style.backgroundColor = "tomato";
                 document.getElementById("er02").style.textAlign = "center";
            }
    } else {
                 document.getElementById("er01").innerHTML = sep[0];
                 document.getElementById("er01").style.color= "white";
                 document.getElementById("er01").style.backgroundColor = "tomato";
                 document.getElementById("er01").style.textAlign = "center";
            }


}
</script>
</main>


</body>






</html>
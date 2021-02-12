<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit profile</title>
    <meta charset="utf-8">
    <meta name="viewport"content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylePravite.css">
    <link rel="stylesheet" href="TopBottom.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src=""></script>
</head>

<body style="background-color: #003049;">
    <header class="navbar" style="background-color:rgb(172, 13, 13);text-align:center; ">
        <a id="logo" class="col-sm-4 " href="home.html" alt="Home "><span class="glyphicon glyphicon-leaf "></span><b> E-SHOP</b></a>
        <nav class="col-sm-4" style="color:rgb(7, 7, 6);padding: 20px;font-size:large; ">
            <div class="navbar-header " style="color: mintcream; ">
                <a id="nav" href="home.html">Home</a> |
                <a id="nav" href=" ">Shop</a> |
                <a id="nav" href="Contact_us.html">Contact us</a> |
                <a id="nav" href="Help.html">Help</a>
            </div>
        </nav>
        <div class="col-sm-4 " style="padding: 19px;font-size: 20px; ">
            <div class="col-sm-6 ">
                <a id="nav" href="login.html"> <span class="glyphicon glyphicon-log-in "></span><b> Log in</b></a>
            </div>
            <div class="col-sm-6 ">
                <a id="nav" href="shoppingCart.html"> <span class="glyphicon glyphicon-shopping-cart "></span><b> Basket</b></a>
            </div>
        </div>
    </header>
    <hr>
    
    <div  id="background">
        <div class="row">
            <div id="part2" class="col-sm-4  ">
                <ul>
    
                    <li><img src="icons\iconfinder_SEO_cogwheels_setting_969265.png" alt="settings"style="float:left;width: 30px;height: 30px"><H2>My account</H2></li>
                    <hr style="color: black;size: 10px;">
                    <li><img src="icons\iconfinder_icons_user_1564534.png" alt="profile" style="height:40px;width:40px;float: left;"><a href="Edit_profile.php">Edit profile</a></li><br>
                    <li><img src="icons\18221.png" alt="paymant" style="height:40px;width:40px;float: left;"><a href="Edit_payment.php">Edit payment informations</a></li><br>
                    <li><img src="icons\iconfinder_key-password-passcode-access_2205205.png" alt="password" style="height:40px;width:40px;float: left;"><a href="Change_password.php">Change password</a></li><br>
                    <li><img src="icons\iconfinder_log-out_3324993.png" alt="log ou" style="float: left;height: 40px;width: 40px;"><a href="">Log out</a></li><br>
                </ul>
            </div>
    
            <div id="part" class="col-sm-8">
                <main id=main class="center">
                    <h1>Edit profile</h1> <hr color="black">
                <p>Edit your account information and apply changes</p>
                <form action="Edit_profile.php" method="post">
                    <div class="col-sm-4">
                        
                            <label for="fname">First name: </label><br>
                            <input type="text" id="fname" name="fname" ><br>
                            <label for="fuser">Username:</label><br>
                            <input type="text" name="fuser" id="fuser"><br>
                            <label for="fadress">Adress:</label><br>
                            <input type="text" name="fadress" id="fadress"><br>
                            <label for="fphone">Phone number:</label><br>
                            <input type="text" name="fphone" id="fphone" ><br>


        
                    </div>
                    <div class="col-sm-4">
                        
                            <label for="flname">Last name:</label><br>
                            <input type="text" name="flname" id="flname" ><br>
                            <label for="femail">Email adress:</label><br>
                            <input type="email" name="femail" id="femail" ><br>
                            <label for="fzip">Zipcode:</label><br>
                            <input type="text" name="fzip" id="fzip" ><br>
                            <label for="fmobile">Mobile number:</label><br>
                            <input type="text" name="fmobile" id="fmobile"><br>
                        
                        
                        
                    </div><br>
                    <hr>
        
                    
                        <input type="submit" value="Apply changes" name="fsubmit"  style="border: 5px solid black;">
                </form>
                <?php
                if(!empty($_POST["fuser"]) && !empty($_POST["fadress"]) && !empty($_POST["fphone"]) && !empty($_POST["femail"]) && !empty($_POST["fzip"]) && !empty($_POST["fmobile"])){
                    $servername="localhost";
                    $dbname = "ecommdb (2)";
                    $username="root";
                    $password="";
                    
                    

                    $username1=$_POST["fuser"];
                    $adress=$_POST["fadress"];
                    $phone=$_POST["fphone"];
                    $email=$_POST["femail"];
                    $zip=$_POST["fzip"];
                    

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                        $sql = "UPDATE users SET username='$username1', address='$adress', contact='$phone', email='$email', zipcode='$zip' WHERE username='user1'";
                    
                        // Prepare statement
                        $stmt = $conn->prepare($sql);
                    
                        // execute the query
                        $stmt->execute();
                        //echo "the Password is changed";
                        //header("location:Change_password.html");
                    
                        // echo a message to say the UPDATE succeeded
                        echo $stmt->rowCount() ."your profile UPDATED successfully";
                    } catch(PDOException $e) {
                        echo $sql . "<br>" . $e->getMessage();
                    }
                    
                    $conn = null;


            }
                
                

?>     
                </main>
                
                
                

                        
                        

        
                
                
                
                
            </div>

        </div>
       

    </div>


    <footer class="container" style="background-color:rgb(172, 13, 13);width:100%;border-top: snow solid 3px;">
        <div class="col-sm-6 ">
            <a id="nav" href=" "><b> Our group<br>Learn more about us</b></a>
        </div>
        <div class="col-sm-6 ">
            <h4 style="text-decoration-line: underline;color: snow; "><b>Find us</b></h4>
            <li>
                <a id="nav" href=""><img src="img/icons/Twitter.png " height="25 " width="25 "><b> Twitter</b></a>
            </li>
            <li>
                <a id="nav" href=""><img src="img/icons/facebook.png " height="25 " width="25 " alt=" "><b>Facebook</b></a>
            </li>
            <li>
                <a id="nav" href=""><img src="img/icons/instagram.png " height="25 " width="25 " alt=" "><b>Instagram</b></a>
            </li>

        </div>
    </footer>
</body>

</html>
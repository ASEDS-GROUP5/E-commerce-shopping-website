<?php
session_start();
if(!isset($_COOKIE['username'])){
    header('Refresh:0; url:login.html');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>My Orders</title>
</head>
<style>
    a {
        color: black;
    }
    
    a#logo:link,
    a#logo:visited {
        background-color: rgb(14, 12, 12);
        color: aliceblue;
        width: 20%;
        padding: 10px;
        margin-top: 10px;
        margin-left: 50px;
        font-size: 19px;
        text-decoration: none;
        border-radius: 5px 5px 5px 5px;
    }
    
    a#logo:hover,
    a#logo:active {
        color: rgb(10, 9, 9);
        background-color: snow;
        transition: 0.5s;
    }
    
    a#nav:hover,
    a#nav:active {
        color: lightgrey;
        transition: 0.3s;
    }
    
    a#nav {
        text-decoration: none;
    }
    
    img#P {
        width: 50px;
        height: 50px;
        border-radius: 5px 5px 5px 5px;
    }
</style>


<body style="background-image:url(img/signUp-background.jpeg);">
    <header class="navbar" style="background-color:rgb(172, 13, 13);text-align:center;">
        <a id="logo" class="col-sm-3" href="home.html" alt="Home"><span class="glyphicon glyphicon-leaf"></span><b> E-SHOP</b></a>
        <nav class="col-sm-4" style="color:rgb(7, 7, 6);padding: 20px;font-size:large;">
            <div class="navbar-header" style="color: mintcream;">
                <a id="nav" href="home.html">Home</a> |
                <a id="nav" href="">Shop</a> |
                <a id="nav" href="group5/Contact_us.html">Contact us</a> |
                <a id="nav" href="group5/Help.html">Help</a>
            </div>
        </nav>
        <div class="col-sm-5" style="padding: 19px;font-size: 20px;">
            <div class="col-sm-4">
                <p style="color: rgb(243, 242, 242);margin-left: 0px;">✔️Connected</p>
            </div>
            <div class="col-sm-4">
                <a id="nav" href="logout.php?deconnexion=true"> <span class="glyphicon glyphicon-log-out"></span><b>Log out</b></a>
            </div>
            <div class="col-sm-4">
                <a id="nav" href="shoppingCart.php"> <span class="glyphicon glyphicon-shopping-cart"></span><b>Basket</b></a>
            </div>
        </div>
    </header>
    <h1 style="text-align: left;margin-left: 20px;color: snow;"><b> MY ORDERS</b></h1>
    <hr>
    <div class="container" style="width: 80%;">
        
        <?php
            include 'database.php';
            global $db;
            $qt=$db->prepare("SELECT commande_id,photo,product_name,status from details_commande where username='".$_COOKIE['username']."' ");
            $qt1=$db->prepare("SELECT commande_id,photo,product_name,status from details_commande where username='".$_COOKIE['username']."' ");
            $qt->execute();
            $qt1->execute();
            $count=$qt->rowCount();
            if($count==0){
                echo "<h2 class='text-danger'>NOTE : You have no orders yet !</h2> ";
            }else{
                $result=$qt->fetch();
                $order_id=$result['commande_id'];
                echo "
                <div class='panel panel-default'>
                <div class='panel-heading' style='background-color: orange;'>
                    <b>Order ID : ".$order_id."</b>
                    <form method='POST' action='removeorr.php?idorder=".$order_id."'>
                       <button type='submit' id=".$order_id." name='removeorr' class='btn btn-danger'>
                               <span class='glyphicon glyphicon-remove'></span>Cancel the order
                       </button>
                    </form>
                </div>
                <div class='panel-body '>
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>Picture</th>
                                <th>Label</th>
                                <th>Quantity</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                    ";
               while($results=$qt1->fetch()){
                  
                   if($results['commande_id']!=$order_id){
                       echo "
                                   </tbody>
                               </table>
                           </div>
                       </div>
                       <div class='panel panel-default'>
                           <div class='panel-heading' style='background-color: orange;'>
                               <b>Order ID : ".$results['commande_id']."</b>
                               <form method='POST' action='removeorr.php?idorder=".$results['commande_id']."'>
                                   <button type='submit' id=".$results['commande_id']." name='removeorr' class='btn btn-danger'>
                                           <span class='glyphicon glyphicon-remove'></span>Cancel the order
                                   </button>
                               </form>
                           </div>
                           <div class='panel-body '>
                               <table class='table'>
                                   <thead>
                                       <tr>
                                           <th>Picture</th>
                                           <th>Label</th>
                                           <th>Quantity</th>
                                           <th>Status</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                           ";
                       $order_id=$results['commande_id'];
                   }else{
                       $photo=$results['photo'];
                       $pname=$results['product_name'];
                       $status=$results['status'];
                       echo "      
                       <tr>
                           <td><img id='P' src='img/icons/".$photo."' alt=''></td>
                           <td>".$pname."</td>
                           <td><var>2</var></td>
                           <td>".$status."</td>
                       </tr>
                       ";
                   }
               }
                           
            }
            
        ?>
                    </tbody>
                </table>
            </div>
    </div>
    <br>
    <br>
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
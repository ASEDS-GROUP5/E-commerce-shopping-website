<?php

    if(isset($_POST["buy"])){
        if(!isset($_COOKIE["username"])){
            header('Location:login.html');
        }else{
            include 'database.php';
            global $db;
            try{
                $user=$db->prepare("SELECT user_id FROM users where username='".$_COOKIE['username']."'");
                $user->execute();
                $id=$user->fetch();
                $orderid=random_int(60000000,80000000);
                $date=date("Y-n-j-g:i a"); 
                $orders=$db->prepare("INSERT INTO commande(commande_id,user_id,date_commande)
                                VALUES (:orderid,:userid,:orderdate)");
                $orders->bindParam(':orderid',$orderid);
                $orders->bindParam(':userid',$id['user_id']);
                $orders->bindParam(':orderdate',$date);
                $orders->execute();

                    $q=$db->prepare("SELECT photo,product_name,price FROM panier;");
                    $q->execute();
                    foreach($q as $row){
                        $photo=$row['photo'];
                        $pname=$row['product_name'];
                        $product=$db->prepare("SELECT product_id from products where product_name='".$pname."'");
                        $product->execute();
                        $p=$product->fetch();
                        // $squantity=$_POST['quantity'];
                        $order=$db->prepare("INSERT INTO details_commande(commande_id,product_id,product_name,photo,username)
                            VALUES (:orderid,:pid,:pname,:photo,:username)") ;
                        $order->bindParam(':orderid',$orderid);
                        $order->bindParam(':pid',$p['product_id']);
                        $order->bindParam(':pname',$pname);
                        $order->bindParam(':photo',$photo);
                        $order->bindParam(':username',$_COOKIE['username']);
                        // $order->bindParam(':quantity',$squantity);
                        $order->execute();

                    }
                header('Refresh:0; url=orders.php');

                
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }



?>
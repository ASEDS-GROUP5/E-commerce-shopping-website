<?php
    include 'database.php';
    global $db;
    if(isset($_POST['remove'])){
        try {
           
           $remove=$db->prepare("DELETE FROM panier where panier_id=".$_GET['idbutton']."");
           $remove->execute();
           header('Refresh:0; url=shoppingCart.php');
        } catch (PDOException $e) {
           echo $e->getMessage();
        }
    }
   
?>
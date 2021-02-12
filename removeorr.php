<?php
    include 'database.php';
    global $db;
     if(isset($_POST['removeorr'])){
        try {
           $removeorr=$db->prepare("DELETE FROM commande where commande_id=".$_GET['idorder']."");
           $removeorr=$db->prepare("DELETE FROM details_commande where commande_id=".$_GET['idorder']."");
           $removeorr->execute();
           header('Refresh:0; url=orders.php');
        } catch (PDOException $e) {
           echo $e->getMessage();
        }
    }


?>
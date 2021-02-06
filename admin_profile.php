<?php

    $servername = "localhost";
    $dbname = "ecommdb";
    $user = "admin";
    $pass = "admin";
    
    $username = valid_donnees($_POST["username"]);
    $email = valid_donnees($_POST["email"]);
    $passw = valid_donnees($_POST["pass"]);
    
    
    function valid_donnees($donnees){
      $donnees = trim($donnees);
      $donnees = stripslashes($donnees);
      $donnees = htmlspecialchars($donnees);
      return $donnees;
  }

 try{
                $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if($username !== "" && $passw !== "" && $email !=""){
    
                  //On prépare la requête et on l'exécute
                  $sth = $dbco->prepare("
                    UPDATE users 
                    SET email='$email', password = '$passw' , firstname='$username' 
                    WHERE user_id=1
                  ");
                  $sth->execute();
                  
                  //On affiche le nombre d'entrées mise à jour
                  header("Location:admin_profile.html");
                } else{
                  header('Location: admin_profile.html');
                }
		
            }
                  
            catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }
?>
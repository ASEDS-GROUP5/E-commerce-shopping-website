<?php
                $serveur = "localhost";
                $dbname = "ecommdb (2)";
                $user = "root";
                $pass = "";
                
                $prenom = $_POST["fname"];
                $mail = $_POST["femail"];
                $text = $_POST["ftext"];
                
                try{
                    //On se connecte à la BDD
                    $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
                    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                    //On insère les données reçues
                    $sth = $dbco->prepare("
                        INSERT INTO messages(username, email, message)
                        VALUES(:prenom, :mail, :text)");
                    $sth->bindParam(':prenom',$prenom);
                    $sth->bindParam(':mail',$mail);
                    $sth->bindParam(':text',$text);
                    $sth->execute();
                    
                    //On renvoie l'utilisateur vers la page de 
                    header("location:Contact_us.html");
                   

                    
                }
                catch(PDOException $e){
                    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
                }
                ?>
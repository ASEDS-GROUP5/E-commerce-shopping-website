<?php
if(isset($_POST['login'])){
    include 'database.php';
    global $db;
    $msg="";
    $username=$_POST["username"];
    $password=$_POST["password"];
    try{
        if(!empty($username) && !empty($password)){
            
            $q="SELECT * FROM users where username = :username AND password = :password";
            $user=$db->prepare($q);
            $user->execute(array( ':username' => $_POST["username"] , ':password' => $_POST["password"] ));
            $count=$user->rowCount();
            $userarr=$user->fetch();
           
            if($count!=0) {
                if($userarr['privilege']!='admin'){
                    setcookie('username',$username,time()+600);
                    header('Location: home.php');
                }else{
                    setcookie('username',$username,time()+180);
                    header('Location: admin_dashboard.php');
                }
            }else{
            $msg='<label>incorrect password or username</label>'; // utilisateur ou mot de passe incorrect
            }
           
            
        }else{
            $msg='<label>Field is required</label>'; // utilisateur ou mot de passe vide
        }
    }catch(PDOException $e){
        echo $e->getMessage;
    }
}

if(isset($msg)){
    echo '<label class="text-danger">'.$msg.'</label>';
}
?>
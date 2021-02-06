<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Categories</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel='stylesheet' type='text/css' media='screen' href='./admin_main.css'>
    <script src='main.js'></script>
</head>
<body>
    <header class="navbar" style="background-color:rgb(172, 13, 13);text-align:center;">
        <a id="logo" class="col-sm-3" href="home.html" alt="Home"><span class="glyphicon glyphicon-leaf"></span><b> E-SHOP</b></a>
        <nav class="col-sm-4" style="color:rgb(7, 7, 6);padding: 20px;font-size:large;">
            <div class="navbar-header" style="color: mintcream;">
                <a id="nav" href="home.html"><b>Home</b></a>
                <a id="nav" href="./admin_addproduct.html"><span><img src="./img/icons/icons8-plus-50.png" style="height: 30px; width: 30px; "></img></span><b>Add product</b></a> |
            </div>
        </nav>
        <div class="col-sm-5" style="padding: 19px;font-size: 20px;">
            <div class="col-sm-4">
                <a id="nav" href="login.html"> <span class="glyphicon glyphicon-log-out"></span><b>Log out</b></a>
            </div>
        </div>
    </header>
    <div class="adminpanel">
        <h2>Admin panel</h2>
    </div>
    <div class="countainer">
        <div class="column menu">
            <div class="dashb">
                <h3>Dashboard</h3>
            </div>
            <ul>
                <li><a href="./admin_categories.html">Categories</a></li>
                <li><a href="./adminStatistics.html">Statistics</a></li>
                <li><a href="./admin_allusers.html">User</a></li>
                <li><a href="./admin_messages.html">Messages</a></li>
                <li><a href="./admin_profile.html">Profile</a></li>
            </ul>
        </div>
        <div class="column content">
            <div class="dashtitle">
                <h3>Categories</h3>
            </div>
            <div class="table">
                <table> 
                    <tr style="background-color: coral;">
                        <th>category_id</th>
                        <th>category name</th>
                        
                        <th>edite</th>
                        <th>delete</th>
                    </tr>
                    <?php
                        $servername = "localhost"; $dbname = "ecommdb"; $user = "admin"; $pass = "admin";
            
                        try{
                            $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
                            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            /*Sélectionne toutes les valeurs dans la table category*/
                            $sth = $dbco->prepare("SELECT * FROM category");
                            $sth->execute();
                            foreach($sth as $row){
                                echo "
                                    <tr>
                                        <td>".$row['category_id']."</td>
                                        <td>".$row['name']."</td>
                                        <td><button type='button' onclick=''><img src='./img/icons/icons8-support-50.png' style='width: 20px; height: 20px;' ></button></td>
                                        <td><button type='button' onclick=''><img src='./img/icons/icons8-cancel-50.png' style='width: 20px; height: 20px;'></button></td>
                                    </tr>
                                ";
                            }    
                        }
                  
                        catch(PDOException $e){
                            echo "Erreur : " . $e->getMessage();
                }
                    ?>   
                </table>
            </div>
        </div>
    
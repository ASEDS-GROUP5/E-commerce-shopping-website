<?php
    if(isset($_GET['deconnexion'])){
            session_unset();
            header('Refresh:0; url:login.html');
    }


?>
<?php
    if(empty($_SESSION['usr']))
    {
    header('Location:LoginLogout/LG_login.php');
    }
?>
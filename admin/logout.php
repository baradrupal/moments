<?php
   session_start();
   unset($_SESSION["login_user"]);
   header('Refresh: 0; URL = index.php');
?>
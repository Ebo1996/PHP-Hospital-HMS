<?php
if(empty($_SESSION['login'])||empty($_SESSION['role'])||$_SESSION['role']!=='doctor'){
    session_unset(); session_destroy();
    header('location:index.php'); exit();
}
?>

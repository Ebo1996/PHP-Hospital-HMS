<?php
// Admin auth guard — include at top of every page
if(empty($_SESSION['login'])||empty($_SESSION['role'])||$_SESSION['role']!=='admin'){
    session_unset(); session_destroy();
    header('location:index.php'); exit();
}
?>

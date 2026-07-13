<?php
function check_login() {
    // Fix: was strlen($_SESSION['login']==0) — boolean bug. Correct check:
    if (empty($_SESSION['login']) || empty($_SESSION['role']) || $_SESSION['role'] !== 'patient') {
        session_unset();
        session_destroy();
        header("Location: user-login.php");
        exit();
    }
}
?>

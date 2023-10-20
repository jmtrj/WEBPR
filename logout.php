<?php
    session_start();
    unset($_SESSION['Username']);
    session_destroy();
    header('location: index.php');
?>
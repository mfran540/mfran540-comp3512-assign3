<?php
session_start();
function redirectToLogin($pageName) {
        if(!isset($_SESSION['UserName'])) {
            header('Location: login.php?location=' . urlencode($_SERVER['REQUEST_URI']));//. $pageName);
            exit();
        }  
    }
?>
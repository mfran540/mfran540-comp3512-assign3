<?php
session_start();

//Redirects from login page to whatever page was attempted to access before login
function redirectToLogin($pageName) {
        if(!isset($_SESSION['UserName'])) {
            header('Location: login.php?location=' . urlencode($_SERVER['REQUEST_URI']));//. $pageName);
            exit();
        }  
    }
?>
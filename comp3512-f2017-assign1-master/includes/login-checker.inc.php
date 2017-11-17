<?php

function redirectToLogin($pageName) {
        if(!isset($_SESSION['UserName'])) {
            header('Location: login.php?page=' . $pageName);
        }  
    }
?>
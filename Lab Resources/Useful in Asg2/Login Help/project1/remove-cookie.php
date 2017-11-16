<?php

    if ( isset($_COOKIE['THEME']) ) {
        unset($_COOKIE['THEME']);
    
        setcookie('THEME', '', time()-3600);
    }
    
    if ( isset($_COOKIE['PHILOSOPHER']) ) {
        unset($_COOKIE['PHILOSOPHER']);
    
        setcookie('PHILOSOPHER', '', time()-3600);
    }
    header("Location: chapter16-project1.php");
?>
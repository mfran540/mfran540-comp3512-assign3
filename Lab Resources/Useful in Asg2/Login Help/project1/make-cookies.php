<?php

    if( isset($_POST['theme']) && isset($_POST['philosopher']) ) {
        $expiryTime = time()+60*60*24;
        setcookie('THEME', $_POST['theme'], $expiryTime);
        setcookie('PHILOSOPHER', $_POST['philosopher'], 0);
    }
    
    header("Location: chapter16-project1.php");

?>
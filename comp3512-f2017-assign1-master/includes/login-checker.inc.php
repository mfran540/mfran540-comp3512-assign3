<?php

function redirectToLogin($pageName) {
        if(!isset($_SESSION['UserName'])) {
            header('Location: login.php?location=' . urlencode($_SERVER['REQUEST_URI']));//. $pageName);
        }  
    }

//  login-check.php
session_start();

//  our url is now stored as $_POST['location'] (posted from login.php). If it's blank, let's ignore it. Otherwise, let's do something with it.
/*$redirect = NULL;
if($_POST['location'] != '') {
    $redirect = $_POST['location'];
}

//If there is no one logged in yet
if(!isset($_SESSION['UserName'])) {
    $url = 'login.php?p=1';
    // if we have a redirect URL, pass it back to login.php so we don't forget it
    if(isset($redirect)) {
        $url .= '&location=' . urlencode($redirect);
    }
   header("Location: " . $url);
   exit();
}
else if (!isset($_SESSION['UserName'])) {
    $url = 'login.php?p=2';
    if(isset($redirect)) {
        $url .= '&location=' . urlencode($redirect);
    }
   header("Location:" . $url);
   exit();
}
elseif(isset($_SESSION['UserName'])) {
    // if login is successful and there is a redirect address, send the user directly there
    if($redirect)) {
        header("Location:". $redirect);
    } else {
        header("Location:login.php?p=3");
    }
    exit();
}*/

/*
echo '<input type="hidden" name="location" value="';
if(isset($_GET['page'])) {
    echo htmlspecialchars($_GET['page']);
}
echo '" />';*/
?>
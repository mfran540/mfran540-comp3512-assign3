<?php
include 'includes/login-checker.inc.php';
require_once('includes/db-config.inc.php');

//connections to each gateway class (ie. table in Database)
$usersDB = new UsersGateway($connection );
$row = $usersDB->updateInfo($_SESSION['userId'],$_GET['lastname'],$_GET['email'],$_GET['city'],$_GET['country'],$_GET['firstname'],$_GET['address'],$_GET['region'],$_GET['postal'],$_GET['phone']);
?>

<script>
    //Redirects back to index page after logout
     window.location.href="user-profile.php";
</script>
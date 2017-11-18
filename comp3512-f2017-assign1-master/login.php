<?php
session_start();
//https://stackoverflow.com/questions/14523468/redirecting-to-previous-page-after-login-php

require_once('includes/db-config.inc.php');

$usersDB = new UsersLoginGateway($connection ); 
validLogin($usersDB);
/*   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       if(validLogin()) {
           echo "welcome " . $_POST['username'];
           //$loggedIn = true;
           $expiryTime = time()+60*60*24;
           $_SESSION['UserName']=$_POST['username'];
           $_SESSION['Password']=$_POST['pword'];
       }
       else {
           echo "login unsuccessful";
       }
     //echo "Login attempted";
   }
   if(isset($_SESSION['Username'])) {
       echo "Welcome " . $_SESSION['Username'];
   }
   else{
     echo "No Post detected";
   }*/


function validLogin($usersDB) {
    //$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    //$sql = "SELECT * FROM UsersLogin WHERE Username=:user and Password=:pass";
    //$statement = $pdo->prepare($sql);
    //$statement->bindvalue(':user',$_POST['username']);
    //$statement->bindValue(':pass',$_POST['pword']);
    //$statement->execute();
    if(isset($_POST['username'])){
    $result = $usersDB->userExists($_POST['username'], $_POST['pword']);
    if ($result == true) {
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
       //if(validLogin()) {
           echo "welcome " . $_POST['username'];
           //$loggedIn = true;
           $expiryTime = time()+60*60*24;
           $_SESSION['UserName']=$_POST['username'];
           $_SESSION['Password']=$_POST['pword'];
       }
       else {
           echo "login unsuccessful";
       }
     //echo "Login attempted";
   }
   if(isset($_SESSION['Username'])) {
       echo "Welcome " . $_SESSION['Username'];
   }
   else{
     echo "No Post detected";
   }
    //return $result; 
}
}
    


function getLoginForm(){
   echo "<form action='' method='post' role='form'>
            <div class ='form-group'>
                <input type='text' name='username' placeholder='Username' class='form-control'/>
            </div>
            <div class ='form-group'>
                <input type='password' name='pword' placeholder='Password' class='form-control'/>
            </div>
            <input type='submit' value='Login' class='form-control' />
        </form>";
        if(isset($_GET['page'])) {
            echo htmlspecialchars($_GET['page']);
        }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">

    <link rel="stylesheet" href="css/styles.css">
    
    
    <script   src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
       
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    
    
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
    
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>            
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content login">
            
            <div class="mdl-grid">
                
                <!-- Login mdl-cell + mdl-card -->
                  <div class="mdl-cell mdl-cell--5-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--orange">
                      <h2 class="mdl-card__title-text">
                          <i class="material-icons" role="presentation">security</i>&nbsp;<strong>Login</strong>
                        </h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <!--<strong>Please enter your username and password.</strong><br>-->
                        <?php 
                            if (!isset($_SESSION['UserName'])) {
                                getLoginForm();
                            }
                            
                            echo "<a href='logOut.php'>Log out</a>";
                            
                        ?>
                    </div>
                    
                    
                    
                    
                    
                </div>  <!-- / Login mdl-cell + mdl-card -->
                
                
            </div>  <!-- / mdl-grid -->

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
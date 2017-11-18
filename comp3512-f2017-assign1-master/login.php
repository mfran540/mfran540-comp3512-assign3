<?php
/*
    NOTE: Failed login attempts should show red boxes and will dissapear
    when text is changed, but some chrome extensions sometimes block that
    functionality from working.
*/

session_start();
require_once('includes/db-config.inc.php');

$usersDB = new UsersLoginGateway($connection ); 
validLogin($usersDB);

/*
    Checks if what was input to the login form was valid. If so,
    redirects to whatever page was previously selected.
*/
function validLogin($usersDB) {
    $javascript;
    $redirect = NULL;
    if(isset($_GET['location'])) {
        if($_GET['location'] != '') {
            $redirect = $_GET['location'];
        }
    }

    if(isset($_POST['username'])){
        $result = $usersDB->userExists($_POST['username'], $_POST['pword']);
        if ($result == true) {
           if ($_SERVER["REQUEST_METHOD"] == "POST") {
               $expiryTime = time()+60*60*24;
               $_SESSION['UserName']=$_POST['username'];
               $_SESSION['Password']=$_POST['pword'];  
           }
       }
       else {
            echo "<h4 style='background-color:red;color:white; margin:auto;'>Login unsuccessful, please try again.</h4>";
           $_SESSION['failedLogin'] = true;
       }
       
        if($redirect) {
            $redirect = htmlspecialchars($redirect);
            header("Location:". $redirect);
        }
    }
}
    
/*
    Prints the login form, differs depending if it was a failed login or not
*/
function getLoginForm(){
    if (!isset($_SESSION['failedLogin'])) {
        echo "<form action='' method='post' role='form' id='mainForm'>
            <div class ='form-group'>
                <input type='text' name='username' placeholder='Username' class='form-control'/>
            </div>
            <div class ='form-group'>
                <input type='password' name='pword' placeholder='Password' class='form-control'/>
            </div>
            <input type='submit' value='Login' class='form-control' />
        </form>";
        
    }
    else {
        echo "<form action='' method='post' role='form' id='mainForm'>
            <div class ='form-group'>
                
                <input type='text' name='username' placeholder='Username' class='form-control error'/>
            </div>
            <div class ='form-group'>
                <input type='password' name='pword' placeholder='Password' class='form-control error'/>
            </div>
            <input type='submit' value='Login' class='form-control' />
            <h5 style='color:red;'>Login unsuccessful, please try again.</h5>
        </form>";
    }
}//End function

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
    <script src="js/loginerror.js"></script>
    
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
                        <?php 
                            if (!isset($_SESSION['UserName'])) {
                                getLoginForm();
                            }
                            else {
                                echo "<a href='logOut.php'><h5>Log out</h5></a>";
                            }
                        ?>
                    </div>
                </div>  <!-- / Login mdl-cell + mdl-card -->
            </div>  <!-- / mdl-grid -->
        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
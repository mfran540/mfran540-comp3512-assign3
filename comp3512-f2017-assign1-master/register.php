<?php

session_start();
require_once('includes/db-config.inc.php');

$usersDB = new UsersGateway($connection ); 
$usersLoginDB = new UsersLoginGateway($connection ); 


function checkUserInfo($usersDB,$usersLoginDB){
    global $matchingPasswords;
    global $existingUser;
    
    $usersDB = $usersDB;
    $usersLoginDB = $usersLoginDB;
    
    if(isset($_POST['password']) && isset($_POST['password2'])){
        if($_POST['password']!=$_POST['password2']){
            echo "<p style='background-color:red;color:white; margin:auto;'>Password's do not match, Please try again</p>";
            $matchingPasswords = false;
        }
        else{
            $matchingPasswords = true;
        }
    }
    
    if(isset($_POST['email'])){
        $row = $usersLoginDB->findByID($_POST['email']);
        
        if($row['UserName']==$_POST['email']){
            $existingUser = true;
            echo "<p style='background-color:red;color:white; margin:auto;'>Email is already in use.</p>";
        }
        else{
            $existingUser = false;
        }
    }
    
    if($matchingPasswords == true && $existingUser == false){
        $salt = md5(microtime());
        $password = md5($_POST['password'].$salt);
        $date = date("Ymd");
        $usersLoginDB->createUserLogin($_POST['email'], $password, $salt, '1', $date, $date);
        $row = $usersLoginDB->findByID($_POST['email']);
        
        $usersDB->createUser($row['UserID'],$_POST['firstname'], $_POST['lastname'], $_POST['address'], $_POST['city'], $_POST['region'], $_POST['country'], $_POST['postal'], $_POST['phone'], $_POST['email']);
        echo "<p style='background-color:green;color:white; margin:auto;'>Account has been created! You may now login.</p>";
    }
}

checkUserInfo($usersDB,$usersLoginDB);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">

    <link rel="stylesheet" href="css/styles.css">
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        window.jQuery ||
        document.write('<script src="js/jquery-3.1.1.min.js"><\/script>');
    </script>
    
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    

<script>

        function highlight (e){
           if(e.type == "focus"){
              e.target.classList.add("highlight");
           }
           else if (e.type == "blur"){
              e.target.classList.remove("highlight");
              checkerror();
           }
        }
        
        function checkerror (e){
        var requiredfields = document.querySelectorAll(".required");
        
        for(var i = 0; i<requiredfields.length; i++){
                if(requiredfields[i].value == null || requiredfields[i].value == ""){
                        e.preventDefault();
                        requiredfields[i].classList.add("error");
                }
                else if (requiredfields[i].classList.contains("error")){
                        requiredfields[i].classList.remove("error");
                }
            }
        }
        
        function checkPass (e){
            var password1 = document.querySelectorAll(".pass1");
            var password2 = document.querySelectorAll(".pass2");
            var pass1 = password1.value;
            var pass2 = password2.value;
            
            if(pass1 == pass2){
                password1.appendChild("<p>Password's match!</p>");
            }
            else{
                password1.appendChild("<p>Password's do not match!</p>");
            }
        }

        window.addEventListener("load", function(){
                var highlightedbox = document.querySelectorAll(".hilightable");
                for (var i=0; i<highlightedbox.length; i++) {
                    highlightedbox[i].addEventListener("focus", highlight);
                    highlightedbox[i].addEventListener("blur", highlight);
                }
        
                document.getElementById("mainForm").addEventListener("submit", checkerror); 
                document.querySelectorAll(".pass2").addEventListener("keyup", checkPass);
        });
</script>
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
    
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>            
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content login">
            
            <div class="mdl-grid">
                
                <!-- Register mdl-cell + mdl-card -->
                  <div class="mdl-cell mdl-cell--5-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--orange">
                      <h2 class="mdl-card__title-text">
                          <i class="material-icons" role="presentation">security</i>&nbsp;<strong>Create a new account</strong>
                        </h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <form method="POST" action="register.php" id="mainForm" >
                            <div class="mdl-textfield mdl-js-textfield">First Name: 
                            <input class="hilightable mdl-textfield__input" type="text" name="firstname">
                            </div>  
                            
                            <div class="mdl-textfield mdl-js-textfield">Last Name: 
                            <input class="required hilightable mdl-textfield__input" type="text" name="lastname">
                            </div>

                            <div class="mdl-textfield mdl-js-textfield">Address: 
                            <input class="required hilightable mdl-textfield__input" type="text" name="address">
                            </div>
                            
                            <div class="mdl-textfield mdl-js-textfield">City: 
                            <input class="required hilightable mdl-textfield__input" type="text" name="city">
                            </div>               

                            <div class="mdl-textfield mdl-js-textfield">Region: 
                            <input class="required hilightable mdl-textfield__input" type="text" name="region">
                            </div>
                            
                            <div class="mdl-textfield mdl-js-textfield">Country: 
                            <input class="required hilightable mdl-textfield__input" type="text" name="country">
                            </div>  

                            <div class="mdl-textfield mdl-js-textfield">Postal Code: 
                            <input class="required hilightable mdl-textfield__input" type="text" name="postal">
                            </div>

                            <div class="mdl-textfield mdl-js-textfield">Phone: 
                            <input class="required hilightable mdl-textfield__input" type="text" name="phone">
                            </div>
                            
                            <!--I googled the right pattern for an email "https://stackoverflow.com/questions/5601647/html5-email-input-pattern-attribute" -->
                            <div class="mdl-textfield mdl-js-textfield">Email: 
                            <input class="required hilightable mdl-textfield__input" type="text" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" name="email">
                            </div>
                            
                            <div class="mdl-textfield mdl-js-textfield">Password: 
                            <input class="pass1 required hilightable mdl-textfield__input" type="password" name="password">
                            </div>

                            <div class="mdl-textfield mdl-js-textfield">Re-enter Password: 
                            <input class="pass2 required hilightable mdl-textfield__input" type="password" name="password2">
                            </div>
                            
                            <div>
                            <input type="Submit" name="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect"/>
                            </div>
                        </form>
                    </div>
                </div>  <!-- / register mdl-cell + mdl-card -->
            </div>  <!-- / mdl-grid -->
        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
</body>
</html>
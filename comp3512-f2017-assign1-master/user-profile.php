<?php
include 'includes/login-checker.inc.php';
require_once('includes/db-config.inc.php');

//connections to each gateway class (ie. table in Database)
$usersDB = new UsersGateway($connection ); 
$lastname ="";
$email="";
$city="";
$country="";
/*
    Prints the information of the user who is logged in
*/
function printUserInfo($id,$usersDB)
{
    $row = $usersDB->findById($id);
        echo "<h4>" . $row['FirstName'] . " " . $row["LastName"] . "</h4>";
        echo $row['Address'] . '<br>';
        echo $row['City'] . ', ' . $row['Region'] . '<br>';
        echo $row['Country'] . ', ' . $row['Postal'] . '<br>';
        echo $row['Email'];
        
        global $lastname;
        global $email;
        global $city;
        global $country;
        $lastname = $row["LastName"];
        $email = $row['Email'];
         $city = $row['City'];
          $country = $row['Country'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php redirectToLogin('user-profile.php'); ?>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">

    <link rel="stylesheet" href="css/styles.css">
    
    
    <script src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
    <script src="js/jquery-3.2.1.min.js"></script>
       
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content userprofile">
            
            <div class="mdl-grid">
                <div class="mdl-card mdl-cell mdl-cell--4-col mdl-cell--3-col-tablet mdl-shadow--2dp" id="profilecard" >
                    
                    <figure id="singleImage" class="mdl-card__media"><img  src="images/GenericUserOnline.png"/>
                    </figure>
                    <div class="mdl-card__title">
                        
                    </div>
                    <div class="mdl-card__supporting-text">
                        
                        <?php 
                        
                        printUserInfo($_SESSION['userId'],$usersDB);
                        
                        //closing PDO connection
                        $connection = null;
                        ?>
                        <!-- Flat button with ripple -->
                       
                    </div>
                    <button   class="mdl-button mdl-js-button mdl-js-ripple-effect" id="formUpdate">
                      Edit 
                    </button>
                     <form method="GET" action="update.php" id="mainForm" >
                       
                         
        <div class="mdl-textfield mdl-js-textfield">Last Name: 
   <input class="mdl-textfield__input" type="text" name="lastname" value= <?php echo '"'.$lastname.'"'; ?> disabled="disabled" class="required hilightable">
    
  </div>
    <div class="mdl-textfield mdl-js-textfield">City:
    <input class="mdl-textfield__input" type="text" name="city" value=<?php echo '"'.$city.'"'; ?> disabled="disabled" class="required hilightable">
    
  </div>
  
  <div class="mdl-textfield mdl-js-textfield">Country: 
    <input class="mdl-textfield__input" type="text" name="country" value=<?php echo '"'.$country.'"'; ?> disabled="disabled" class="required hilightable">
    
  </div>
  <div class="mdl-textfield mdl-js-textfield">Email: 
      <!--I googled the right pattern for an email "https://stackoverflow.com/questions/5601647/html5-email-input-pattern-attribute" -->
    <input class="mdl-textfield__input" type="text" name="email" value= <?php echo '"'.$email.'"';?>disabled="disabled" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" class="required hilightable">
    
  </div>
  <div>
  <input type="Submit" name="submit" disabled="disabled" class="mdl-button mdl-js-button mdl-js-ripple-effect"/>
  </div>
</form>


                </div>
            </div>
        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
<script>
    
function init() {
    document.getElementById("formUpdate").addEventListener("click", function(){
    
         var fields = document.querySelectorAll("form input");
         
    for (var i=0; i<fields.length; i++) {
       
            fields[i].removeAttribute("disabled");
            fields[i].style.color = "black";
        
    }
        
        
    });
}

window.addEventListener("load", init);

function checkForEmptyFields(e){
    var fields = document.querySelectorAll(".required");
    for (var i=0; i<fields.length; i++) {
        if (fields[i].value == null || fields[i].value =='') {
            e.preventDefault();
            fields[i].classList.add("error");
        }
    }
}
    
</script> 
          
</body>
</html>
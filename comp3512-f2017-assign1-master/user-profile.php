<?php
include 'includes/login-checker.inc.php';
require_once('includes/db-config.inc.php');

//connections to each gateway class (ie. table in Database)
$usersDB = new UsersGateway($connection ); 
$lastname ="";
$email="";
$city="";
$country="";
$firstname="";
$address="";
$region="";
$postal="";
$phone;

/*
    grabs the information of the user who is logged in
*/
function printUserInfo($id,$usersDB)
{
    $row = $usersDB->findById($id);
       /* echo "<h4>" . $row['FirstName'] . " " . $row["LastName"] . "</h4>";
        echo $row['Address'] . '<br>';
        echo $row['City'] . ', ' . $row['Region'] . '<br>';
        echo $row['Country'] . ', ' . $row['Postal'] . '<br>';
        echo $row['Email'];
        echo $row['Phone'];
        */
        global $lastname;
        global $email;
        global $city;
        global $country;
        global $firstname;
        global $address;
        global $region;
        global $postal;
        global $phone;
        $lastname = $row["LastName"];
        $email = $row['Email'];
         $city = $row['City'];
          $country = $row['Country'];
          $firstname = $row['FirstName'];
          $address = $row['Address'];
          $region = $row['Region'];
          $phone= $row['Phone'];
          $postal = $row['Postal'];
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
                    <div class="mdl-card__title mdl-color--orange mdl-color-text--black">
                        <h2 class="mdl-card__title-text">
                            <i class="material-icons" role="presentation">account_circle</i>&nbsp;User Information
                        </h2>
                    </div>
                    
                    <figure id="singleImage" class="mdl-card__media"><img  src="images/GenericUserOnline.png"/>
                    </figure>
                    <div class="mdl-card__title">
                        <?php 
                        
                        printUserInfo($_SESSION['userId'],$usersDB);
                        
                        //closing PDO connection
                        $connection = null;
                        ?>
                    </div>
                    
                    <button   class="mdl-button mdl-js-button mdl-js-ripple-effect" id="formUpdate">
                      Edit 
                    </button>
                    <button   class="mdl-button mdl-js-button mdl-js-ripple-effect" disabled="disabled" id="cancelUpdate">
                      Cancel
                    </button>
                     <form method="GET" action="update.php" id="mainForm" >
                       
             <!-- i google a regex pattern that requires this field to start with a character https://stackoverflow.com/questions/576196/regular-expression-allow-letters-numbers-and-spaces-with-at-least-one-letter -->
         <div class="mdl-textfield mdl-js-textfield">First Name:
    <input class="mdl-textfield__input" type="text" name="firstname" value=<?php echo '"'.$firstname.'"'; ?> disabled="disabled"  class="required hilightable">
    
  </div>
        <div class="mdl-textfield mdl-js-textfield">*Last Name: 
   <input class="mdl-textfield__input" type="text" name="lastname" value= <?php echo '"'.$lastname.'"'; ?> disabled="disabled" required="required" pattern="^[A-Za-z0-9\W _]*[A-Za-z0-9][A-Za-z0-9 _]*$" class="required hilightable">
   <span class="mdl-textfield__error">This field cannot be empty, please enter a Last Name</span>
    <!-- i found out about the pattern property in regards to the input through mdl https://getmdl.io/components/#textfields-section -->
  </div>
  <div class="mdl-textfield mdl-js-textfield">Address:
    <input class="mdl-textfield__input" type="text" name="address" value=<?php echo '"'.$address.'"'; ?> disabled="disabled"  class="required hilightable">
    
  </div>
  
    <div class="mdl-textfield mdl-js-textfield">*City:
    <input class="mdl-textfield__input" type="text" name="city" value=<?php echo '"'.$city.'"'; ?> disabled="disabled" required="required" pattern="^[A-Za-z0-9\W _]*[A-Za-z0-9\W][A-Za-z0-9\W _]*$" class="required hilightable">
    <span class="mdl-textfield__error">This field cannot be empty, please enter a City</span>
  </div>
  
  <div class="mdl-textfield mdl-js-textfield">Region:
    <input class="mdl-textfield__input" type="text" name="region" value=<?php echo '"'.$region.'"'; ?> disabled="disabled"  class="required hilightable">
    
  </div>
   
  
  
  <div class="mdl-textfield mdl-js-textfield">*Country: 
    <input class="mdl-textfield__input" type="text" name="country" value=<?php echo '"'.$country.'"'; ?> disabled="disabled" required="required" pattern="^[A-Za-z0-9\W _]*[A-Za-z0-9\W][A-Za-z0-9\W _]*$" class="required hilightable">
    <span class="mdl-textfield__error">This field cannot be empty, please enter a Country</span>
  </div>
  <div class="mdl-textfield mdl-js-textfield">Postal Code:
    <input class="mdl-textfield__input" type="text" name="postal" value=<?php echo '"'.$postal.'"'; ?> disabled="disabled"  class="required hilightable">
    
  </div>
  <div class="mdl-textfield mdl-js-textfield">Phone:
    <input class="mdl-textfield__input" type="text" name="phone" value=<?php echo '"'.$phone.'"'; ?> disabled="disabled"  class="required hilightable">
    
  </div>
  <div class="mdl-textfield mdl-js-textfield">*Email: 
      <!--I googled the right pattern for an email "https://stackoverflow.com/questions/5601647/html5-email-input-pattern-attribute" -->
    <input class="mdl-textfield__input" type="text" name="email" value= <?php echo '"'.$email.'"';?>disabled="disabled" required="required" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" class="required hilightable">
    <span class="mdl-textfield__error">Please enter a valid Email!!</span>
    
  </div>
  <div>
  <input type="Submit" name="submit" disabled="disabled" class="mdl-button mdl-js-button mdl-js-ripple-effect" id="update"/>
  </div>
</form>



                </div>
            </div>
        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
<script>
    // this function is called once the page starts and it basically add a onclick listener for the edit button the enables the user to edit the form if clicked. it also adds the user info onto an array. it also adds an onclick for the cancel button that disables the editing and displays the user info that is initially grabbed from the DB.
function init() {
    document.getElementById("formUpdate").addEventListener("click", function(){
    
         var fields = document.querySelectorAll("form input");
         var values=["a"];
    for (var i=0; i<fields.length; i++) {
       
            fields[i].removeAttribute("disabled");
            fields[i].style.color = "black";
            var x = fields[i].defaultValue; 
           values.push(x);
        
    }
    
    var cancelUpdate = document.getElementById("cancelUpdate");
    cancelUpdate.removeAttribute("disabled");
    cancelUpdate.addEventListener("click", function() {
        var att = document.createAttribute("disabled");
        att.value ="disabled"; 
        cancelUpdate.setAttributeNode(att);
         for (var i=0; i<fields.length; i++) {
        var att2 = document.createAttribute("disabled");
        att2.value ="disabled"; 
            fields[i].setAttributeNode(att2);
            fields[i].style.color = "DarkGray";
           // var y = 
            fields[i].value = values[i+1];
            document.getElementById("update").color = "DarkGray";
            
    }
     document.getElementById("update").removeAttribute("value"); 
        
    });
        
        
    });
    
    
}

window.addEventListener("load", init);

    
</script> 
          
</body>
</html>
<?php
require_once('includes/db-config.inc.php');

//connections to each gateway class (ie. table in Database)
$usersDB = new UsersGateway($connection ); 

function printUserInfo($id,$usersDB)
{
    $row = $usersDB->findById($id);
        echo "<h4>" . $row['FirstName'] . " " . $row["LastName"] . "</h4>";
        echo $row['Address'] . '<br>';
        echo $row['City'] . ', ' . $row['Region'] . '<br>';
        echo $row['Country'] . ', ' . $row['Postal'] . '<br>';
        echo $row['Email'];
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
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
        <section class="page-content userprofile">
            
            <div class="mdl-grid">
                <div class="mdl-card mdl-cell mdl-cell--4-col mdl-cell--3-col-tablet mdl-shadow--2dp" id="profilecard" >
                    
                    <figure id="singleImage" class="mdl-card__media"><img src="images/Marc.jpg"/>
                    </figure>
                    <div class="mdl-card__title">
                        
                    </div>
                    <div class="mdl-card__supporting-text">
                        
                        <?php 
                        
                        printUserInfo(1,$usersDB);
                        
                        //closing PDO connection
                        $connection = null;
                        ?>
                    </div>
                </div>
    
                
            </div>
        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
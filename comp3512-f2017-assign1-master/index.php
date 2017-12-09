<?php

include 'includes/login-checker.inc.php';
    
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
    
    
    <script   src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
       
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">
            
            <!-- Square card -->
            <a href='browse-universities.php'>
            <div class="mdl-card card-lesson mdl-shadow--2dp demo-card-square unicard">
               <div class="mdl-card__title mdl-card--expand">
                  <h2 class="mdl-card__title-text dash">Browse Universities</h2>
                </div>
            </div>
            </a>
            
            <!-- Square card -->
            <a href='browse-books.php'>
            <div class="mdl-card card-lesson mdl-shadow--2dp demo-card-square bookcard">
               <div class="mdl-card__title mdl-card--expand">
                  <h2 class="mdl-card__title-text dash">Browse Books</h2>
                </div>
            </div>
            </a>
            
            <!-- Square card -->
            <a href='browse-employees.php'>
            <div class="mdl-card card-lesson mdl-shadow--2dp demo-card-square empcard">
               <div class="mdl-card__title mdl-card--expand">
                  <h2 class="mdl-card__title-text dash">Browse Employees</h2>
                </div>
            </div>
            </a>
            
            <!-- Square card -->
            <a href='aboutus.php'>
            <div class="mdl-card card-lesson mdl-shadow--2dp demo-card-square aboutcard">
               <div class="mdl-card__title mdl-card--expand">
                  <h2 class="mdl-card__title-text dash">About</h2>
                </div>
            </div>
            </a> 
            
            <!-- Square card -->
            <a href='user-profile.php'>
            <div class="mdl-card card-lesson mdl-shadow--2dp demo-card-square userprofilecard">
               <div class="mdl-card__title mdl-card--expand">
                  <h2 class="mdl-card__title-text dash">User Profile</h2>
                </div>
            </div>
            </a> 
            
            <!-- Square card -->
            <a href='analytics.php'>
            <div class="mdl-card card-lesson mdl-shadow--2dp demo-card-square analyticscard">
               <div class="mdl-card__title mdl-card--expand">
                  <h2 class="mdl-card__title-text dash">Analytics</h2>
                </div>
            </div>
            </a> 
            
            <!-- Square card -->
            <a href='login.php'>
            <div class="mdl-card card-lesson mdl-shadow--2dp demo-card-square logincard">
               <div class="mdl-card__title mdl-card--expand">
                  <h2 class="mdl-card__title-text dash">Login</h2>
                </div>
            </div>
            </a> 

            
            
        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
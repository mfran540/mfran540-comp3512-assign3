<?php

require_once('includes/db-config.inc.php');
$visitsDB = new BookVisitsGateway($connection);

/*
First table SQL:
SELECT BookVisits.CountryCode, Countries.CountryName, COUNT(BookVisits.CountryCode) AS Visits
FROM BookVisits
INNER JOIN Countries ON BookVisits.CountryCode = Countries.CountryCode
GROUP BY BookVisits.CountryCode
ORDER BY Visits DESC
LIMIT 0,15

*/

function printTopFifteen($visitsDB) {
    $result = $visitsDB->findAllSortedLimited(false, 15);
    $num = 1;
    foreach ($result as $row) {
        echo '<tr><td>' . $num . '. ' . $row['CountryName']. '</td><td>' . $row['Visits'] . '</td></tr>';
        $num = $num+1;
    }
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
        <section class="page-content">
            
            <div class="mdl-grid">
                
                <!-- Dashboard mdl-cell + mdl-card -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--orange">
                      <h2 class="mdl-card__title-text">Admin Dashboard</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <strong>Information about website analytics</strong>
                    </div>
                </div>  <!-- / Dashboard mdl-cell + mdl-card -->
                
                <!-- mdl-cell + mdl-card -->
                <div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                        <h2 class="mdl-card__title-text">Top 15 Countries by Visits</h2>
                    </div>
                    <table id="topfifteen">
                        <tr>
                            <th>Country</th>
                            <th>Number of Visits</th>
                        </tr>
                        <?php printTopFifteen($visitsDB); ?>
                    </table>
                    
                    
                </div>  <!-- / mdl-cell + mdl-card -->
                
                
                <!-- mdl-cell + mdl-card -->
                <div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                        <h2 class="mdl-card__title-text">June Statistics</h2>
                        
                    </div>
                </div>  <!-- / mdl-cell + mdl-card -->
                    
                  
                
            </div>  <!-- / mdl-grid -->

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
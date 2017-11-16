<?php

require_once('includes/db-config.inc.php');
$visitsDB = new BookVisitsGateway($connection);
$todosDB = new EmployeesToDoGateway($connection);
$messagesDB = new MessagesGateway($connection);
$adoptionsDB = new AdoptionsAnalyticsGateway($connection);

function printTopFifteen($visitsDB) {
    $result = $visitsDB->findAllSortedLimitedGrouped(false, 15);
    $num = 1;
    foreach ($result as $row) {
        echo '<tr><td>' . $num . '. ' . $row['CountryName']. '</td><td>' . $row['Visits'] . '</td></tr>';
        $num = $num+1;
    }
}

function totalVisits($visitsDB) {
    $result = $visitsDB->findAll();
    foreach ($result as $row) {
        echo $row['Visits'];
    }
}

function totalUniqueCountries($visitDB) {
    $result = $visitDB->findAllGrouped();
    $count = 0;
    foreach ($result as $row) {
        $count++;
    }
    echo $count;
}

function printTotalTodos($todosDB) {
    $result = $todosDB->customWhere("DateBy BETWEEN '2017-06-01 00:00:00' AND '2017-06-30 00:00:00'");
    $count = 0;
    foreach ($result as $row) {
        $count++;
    }
    echo $count;
}

function printTotalMessages($messagesDB) {
    $result = $messagesDB->customWhere("MessageDate BETWEEN '2017-06-01 00:00:00' AND '2017-06-30 00:00:00'");
    $count = 0;
    foreach ($result as $row) {
        $count++;
    }
    echo $count;
}

function printTopBooks($adoptionsDB) {
    $result = $adoptionsDB->findAllSortedLimitedGrouped(false, 10);
    foreach($result as $row) {
        echo '<tr><td><img src="./book-images/tinysquare/' . $row['ISBN10'] . '.jpg"> ' . 
        '<a href="single-book.php?isbn10=' . $row['ISBN10'] . '">' . 
        $row['Title'] . '</a></td><td>' . $row['Quantity'] . '</td></tr>';
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
        <section class="page-content analytics">
            
            <div class="mdl-grid">
                
                <!-- Dashboard mdl-cell + mdl-card -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--orange">
                      <h2 class="mdl-card__title-text">
                          <i class="material-icons" role="presentation">security</i>&nbsp;<strong>Admin Dashboard</strong>
                        </h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <strong>Website analytics for June 2017.</strong>
                    </div>
                </div>  <!-- / Dashboard mdl-cell + mdl-card -->
                
                <!-- mdl-cell + mdl-card -->
                <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-tablet mdl-cell--2-col-phone card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                        <h2 class="mdl-card__title-text">
                            <i class="material-icons" role="presentation">account_circle</i>&nbsp;Total Books Page Visitors
                        </h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <h4><?php totalVisits($visitsDB); ?></h4>
                    </div>
                </div>
                
                <!-- mdl-cell + mdl-card -->
                <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-tablet mdl-cell--2-col-phone card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                        <h2 class="mdl-card__title-text">
                            <i class="material-icons" role="presentation">language</i>&nbsp;Total Unique Country Visitors
                        </h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <h4><?php totalUniqueCountries($visitsDB); ?></h4>
                    </div>
                </div>
                
                <!-- mdl-cell + mdl-card -->
                <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-tablet mdl-cell--2-col-phone card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                        <h2 class="mdl-card__title-text">
                            <i class="material-icons" role="presentation">check_box</i>&nbsp;Total Employee Todos
                        </h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <h4><?php printTotalTodos($todosDB); ?></h4>
                    </div>
                </div>
                
                <!-- mdl-cell + mdl-card -->
                <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-tablet mdl-cell--2-col-phone card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                        <h2 class="mdl-card__title-text">
                            <i class="material-icons" role="presentation">message</i>&nbsp;Total Employee Messages
                        </h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <h4><?php printTotalMessages($messagesDB); ?></h4>
                    </div>
                </div>
                
                
                <!-- mdl-cell + mdl-card -->
                <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--9-col-phone card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--indigo mdl-color-text--white">
                        <h2 class="mdl-card__title-text">
                            <i class="material-icons" role="presentation">equalizer</i>&nbsp;Top 15 Countries by Visits
                        </h2>
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
                <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--indigo mdl-color-text--white">
                        <h2 class="mdl-card__title-text">
                            <i class="material-icons" role="presentation">book</i>&nbsp;Top 10 Adopted Books
                        </h2>
                    </div>
                    <table id="topten" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                        <tr>
                            <th>Book</th>
                            <th>Quantity</th>
                        </tr>
                        <?php printTopBooks($adoptionsDB); ?>
                    </table>
                </div>  <!-- / mdl-cell + mdl-card -->
                    
                
                
            </div>  <!-- / mdl-grid -->

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
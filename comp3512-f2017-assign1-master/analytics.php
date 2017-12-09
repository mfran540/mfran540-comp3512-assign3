<?php
//include 'webservices/service-topCountries.php';
include 'includes/login-checker.inc.php';

//Create and instantiate database gateways
require_once('includes/db-config.inc.php');
//$visitsDB = new BookVisitsGateway($connection);
//$todosDB = new EmployeesToDoGateway($connection);
//$messagesDB = new MessagesGateway($connection);
$adoptionsDB = new AdoptionsAnalyticsGateway($connection);

/*
    Creates the top 15 countries list
*/

/*function printTopFifteen($visitsDB) {
    $result = $visitsDB->findAllSortedLimitedGrouped(false, 15);
    $num = 1;
    foreach ($result as $row) {
        echo '<tr><td>' . $num . '. ' . $row['CountryName']. '</td><td>' . $row['Visits'] . '</td></tr>';
        $num = $num+1;
    }
}*/





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php redirectToLogin('analytics.php'); ?>
    <title>Admin Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">

    <link rel="stylesheet" href="css/styles.css">
    
    
    <script   src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
       
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <script>
    
    
        
        
    $(function() {
        var url = 'service-topCountries.php';
        $.get(url)
            .done(function(data) {
                $("#fifteen").append("<option>Select a country</option>");
                for (var i = 0; i < data.length; i++) {
                    var option = '<option value=' + data[i].CountryCode + '>' + data[i].CountryName + '</option>';
                    $("#fifteen").append(option);
                }
        })
        .fail(function(jqXHR) {
            alert(jqXHR.status);
        })
        .always(function() {
            //Do nothing
        });
        
       $("#fifteen").on('change', function() {
            var url2 = 'service-countryVisits.php';
            var param = "countryCode=" + $('#fifteen').val();
            $.get(url2, param)
                .done(function(data) {
                    $("#topfifteen").html("<h4>" + data["CountryName"] + ": " + data['Visits'] + " visits</h4>");
                })
                .fail(function(jqXHR) {
                    alert(jqXHR.status);
                })
                .always(function() {
            //Do nothing
            });
            
        });
    });
    
    </script>
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
                        <h4 id='totalVisits'></h4>
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
                        <h4 id="totalCountries"></h4>
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
                        <h4 id="totalTodos"></h4>
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
                        <h4 id="totalMessages"></h4>
                    </div>
                </div>
                
                
                <!-- mdl-cell + mdl-card -->
                <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--9-col-phone card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--indigo mdl-color-text--white">
                        <h2 class="mdl-card__title-text">
                            <i class="material-icons" role="presentation">equalizer</i>&nbsp;Top 15 Countries by Visits
                        </h2>
                    </div>
                    <form action="analytics.php" method='get'>
                        <select id="fifteen" name="country" >
                            
                        </select>
                    </form>
                    <table id="topfifteen">
                        <tr>
                            <th>Country</th>
                            <th>Number of Visits</th>
                        </tr>

                        <?php //printTopFifteen($visitsDB); ?>
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
                        <?php// printTopBooks($adoptionsDB); ?>
                    </table>
                </div>  <!-- / mdl-cell + mdl-card -->
                    
            </div>  <!-- / mdl-grid -->
        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>

<script>
    //Grabs numbers to fill in first four boxes (purple boxes)
    $.get('service-totals.php')
        .done(function(data) {
            $("#totalVisits").text(data['totalVisits']);
            $("#totalCountries").text(data['totalCountries']);
            $("#totalTodos").text(data['totalTodos']);
            $("#totalMessages").text(data['totalMessages']);
        })
        .fail(function(jqXHR) {
            alert(jqXHR.status);
        })
        .always(function() {
            //Do nothing
        });
    
    //Gets book information from web service and displays it in table
    $.get('service-topAdoptedBooks.php')
        .done(function(data) {
            for(var i = 0; i<data.length; i++) {
                var row = $("<tr><td><img src='./book-images/tinysquare/" + data[i].ISBN10 
                + ".jpg'> <a href='single-book.php?isbn10=" + data[i].ISBN10 + "'>" +
                data[i].Title + "</a></td><td>" + data[i].Quantity + "</td></tr>");
                $("#topten").append(row);
            }
        });
</script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyA0KMuUs2e7A8q-WRE3J7yxWOZpsZ35HVE'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Popularity'],
          ['Germany', 200],
          ['United States', 300],
          ['Brazil', 400],
          ['Canada', 500],
          ['France', 600],
          ['RU', 700]
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }

</html>
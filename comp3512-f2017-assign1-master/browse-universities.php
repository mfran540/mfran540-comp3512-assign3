
<?php
include 'includes/login-checker.inc.php';
require_once('includes/db-config.inc.php');
$universitiesDB = new UniversitiesGateway($connection);
$statesDB = new StatesGateway($connection);

/*
    Prints the list of universities as links
*/
function printUniversities($universitiesDB) {
    if (!isset($_GET['state']) || strpos($_GET['state'], 'none') !== false ){
        $result1 = $universitiesDB->findAllSorted(true);
    	foreach ($result1 as $row) {
    		echo '<li><a href="?university='. $row['UniversityID'] . '"><h6>' . $row['Name'] . '</h6></a></li>';							
        }
    }
    else {
        $result2 = $universitiesDB->findListByName($_GET['state']);
        foreach ($result2 as $row) {
    		echo '<li><a href="?university='. $row['UniversityID'] . '"><h6>' . $row['Name'] . '</h6></a></li>';							
        }
    }
}

/*
    Prints an error if query string is not there or if incorrect
*/
function printError($universitiesDB) {
    #$isCorrect = true;
    if (!isset($_GET['university']) ) {
        echo '<h4>Please select a university.</h4>';
        #$isCorrect = false;
    }
    else {
        $testQuery = $universitiesDB->findUniversityById($_GET['university']);
        if ($testQuery == null) {
            echo '<h4>Did not understand request. Try clicking on a university from the list.</h4>';
            #$isCorrect = false;
        }
    }
}

/*
    Creates dropdown menu of states to filter by
*/
function stateOptions($statesDB) {
    $result = $statesDB->findAllSorted(true);
    echo "<option value='none'>None</option>";
    foreach ($result as $row) {
        echo '<option value="' . $row['StateName'] . '">' . $row['StateName'] . '</option>';
    }
}

/*
    Prints university information once one is selected properly
    Now includes Google Map
*/
function printUniversityInfo ($universitiesDB) {
    if (isset($_GET['university'])) {
    $row = $universitiesDB->findUniversityById($_GET['university']);
    
        echo "<h4>" . $row['Name'] . "</h4>";
        echo $row['Address'] . '<br>';
        echo $row['City'] . ', ';
        echo $row['State'] . '   ';
        echo $row['Zip'] . '<br>';
        echo "<a href='http://" . $row['Website'] . "'>" . $row['Website'] . '</a><br>';
        echo "
        <h3>Google Maps </h3>
                        <div id=map></div>
                        <script>
                            function initMap() {
                                var uluru = {lat: " . $row['Latitude'] . ", "  . "lng: " . $row['Longitude'] ."};
                                var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 15,
                                center: uluru
                                });
                                var marker = new google.maps.Marker({
                                position: uluru,
                                map: map
                                });
                            }
                        </script>
                        <script async defer
                        src=https://maps.googleapis.com/maps/api/js?key=AIzaSyA0KMuUs2e7A8q-WRE3J7yxWOZpsZ35HVE&callback=initMap>
                        </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php redirectToLogin('browse-universities.php'); ?>
    <title>Universities</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">

    <link rel="stylesheet" href="css/styles.css">
    
    
    <script   src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
       
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
    
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">
            
            <div class="mdl-grid">

              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet mdl-cell--4-col-phone card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Universities</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">
                        
                    <h4>Filter State</h4>
                    
                    <form action="browse-universities.php" method='get'>
                        <select name="state">
                            <?php stateOptions($statesDB); ?>
                        </select>
                        <input type='submit' value='Filter'>
                    </form>
                    
                         <?php  
                              printUniversities($universitiesDB);
                         ?>            

                    </ul>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->
              
              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--9-col mdl-cell--5-col-tablet mdl-cell--4-col-phone card-lesson mdl-card  mdl-shadow--2dp">

                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">University Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <?php printError($universitiesDB); ?>
                        
                    </div>
                    
                    <div style="padding-left:2em;">
                        <?php 
                            printUniversityInfo($universitiesDB); 
                            $connection = null;
                        ?>
                    </div>
                 
              </div>  <!-- / mdl-cell + mdl-card -->   
            </div>  <!-- / mdl-grid --> 
            

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
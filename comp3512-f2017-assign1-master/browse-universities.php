
<?php
//require_once('config.php');
require_once('includes/db-config.inc.php');
$universitiesDB = new UniversitiesGateway($connection);
$statesDB = new StatesGateway($connection);

/*function createPDO() {
    try {
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
    return $pdo;
    $pdo = null;
}

function callDB($sql) {
    $pdo = createPDO();
    $name = $_GET['state'];
    $result = $pdo->prepare($sql);
    $result->bindValue(':name', $name);
    $result->execute();
    return $result;
    $pdo = null;
}

function callDB2($sql) {
    $pdo = createPDO();
    $id = $_GET['university'];
    $result = $pdo->prepare($sql);
    $result->bindValue(':id', $id);
    $result->execute();
    return $result;
    $pdo = null;
}*/

function printUniversities($universitiesDB) {
    //$pdo = createPDO();
    //$sql1 = 'SELECT Name, UniversityID FROM Universities ORDER BY Name LIMIT 0, 20';
    //$result1 = $pdo->query($sql1);
    
    if (!isset($_GET['state']) || strpos($_GET['state'], 'none') !== false ){
        //while ($row = $result1->fetch())	{
        $result1 = $universitiesDB->findAllSorted(true);
    	foreach ($result1 as $row) {
    		echo '<li><a href="?university='. $row['UniversityID'] . '"><h6>' . $row['Name'] . '</h6></a></li>';							
        }
    }
    else {
        //$sql2 = 'SELECT UniversityID, Name, State, StateID FROM Universities INNER JOIN States ON Universities.State=States.StateName WHERE StateName =:name ORDER BY Name LIMIT 0, 20';
        //$result2 = callDB($sql2);
        //while ($row = $result2->fetch())	{
        $result2 = $universitiesDB->findListByName($_GET['state']);
        foreach ($result2 as $row) {
    		echo '<li><a href="?university='. $row['UniversityID'] . '"><h6>' . $row['Name'] . '</h6></a></li>';							
        }
    }
	
    $pdo = null;
}

function printError($universitiesDB) {
    #$isCorrect = true;
    if (!isset($_GET['university']) ) {
        echo '<h4>Please select a university.</h4>';
        #$isCorrect = false;
    }
    else {
        $testQuery = callDB2("SELECT UniversityID FROM Universities WHERE UniversityID=:id");
        if ( $testQuery->rowCount() == 0 ) {
            echo '<h4>Did not understand request. Try clicking on a university from the list.</h4>';
            #$isCorrect = false;
        }
    }
}

function stateOptions($statesDB) {
    /*$pdo = createPDO();
    $sql = 'SELECT StateName, StateID from States';
    $result = $pdo->query($sql);*/
    $result = $statesDB->findAllSorted(true);
    echo "<option value='none'>None</option>";
    
    
    //while ($row = $result->fetch()) {
    foreach ($result as $row) {
        echo '<option value="' . $row['StateName'] . '">' . $row['StateName'] . '</option>';
    }
}

function printUniversityInfo ($universitiesDB) {
    //$sql = "select * from Universities where UniversityID=:id";
    //$result = callDB2($sql);
    if (isset($_GET['university'])) {
//    $row = $universitiesDB->findListById($_GET['university']);
    //while ($row = $result->fetch()) {
    $row = $universitiesDB->findUniversityById($_GET['university']);
    
        echo "<h4>" . $row['Name'] . "</h4>";
        echo $row['Address'] . '<br>';
        echo $row['City'] . ', ';
        echo $row['State'] . '   ';
        echo $row['Zip'] . '<br>';
        echo "<a href='http://" . $row['Website'] . "'>" . $row['Website'] . '</a><br>';
        //echo $row['Country'] . '<br>';
        echo "
        <h3>Google Maps </h3>
                        <div id=map></div>
                        <script>
                            function initMap() {
                                var uluru = {lat: " . $row['Latitude'] . ", "  . "lng: " . $row['Longitude'] ."};
                                var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 4,
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
                                    
        //echo "Coordinates: " . $row['Latitude'] . ", " . $row['Longitude'];
        
    //}
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
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
                        <?//php printError($universitiesDB); ?>
                        
                    </div>
                    
                    <div style="padding-left:2em;">
                        <?php printUniversityInfo($universitiesDB) ?>
                        
                       <!-- <h3>My Google Maps Demo</h3>
                        <div id="map"></div>
                        <script>
                            function initMap() {
                                var uluru = {lat: -25.363, lng: 131.044};
                                var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 4,
                                center: uluru
                                });
                                var marker = new google.maps.Marker({
                                position: uluru,
                                map: map
                                });
                            }
                        </script>
                        <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0KMuUs2e7A8q-WRE3J7yxWOZpsZ35HVE&callback=initMap">
                        </script>--> 
                    
                    </div>
                 
              </div>  <!-- / mdl-cell + mdl-card -->   
            </div>  <!-- / mdl-grid --> 
            

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
<?php
require_once('includes/db-config.inc.php');

//connections to each gateway class (ie. table in Database)
$employeeDB = new EmployeesGateway($connection );
$messageDB = new MessagesGateway($connection );
$employeeToDoDB = new EmployeesToDoGateway($connection );

function printEmployees($employeeDB) {
    /* Uses the employeeDB gateway class to find all employees and sort them by last name*/
    
    $result = $employeeDB->findAllSorted(true);
    foreach ($result as $row) {
        echo '<li><a href="?employee='. $row['EmployeeID'] . '"><h6>' . $row['FirstName'] . ' ' . $row['LastName'] . '</h6></a></li>';
    }
}

function displayDetails($employeeDB) {
    /* Uses the employeeDB gateway class to find an employee ID in the table and returl the record, this also checks first if the employee is clicked
    first before trying to run the SQL*/
    if (!isset($_GET['employee']) ) {
        echo '<h4>Please select an employee.</h4>';
    }
    else{
    $row = $employeeDB->findById($_GET['employee']);
        echo "<h4>" . $row['FirstName'] . " " . $row["LastName"] . "</h4>";
        echo $row['Address'] . '<br>';
        echo $row['City'] . ', ' . $row['Region'] . '<br>';
        echo $row['Country'] . ', ' . $row['Postal'] . '<br>';
        echo $row['Email'];
    }
    
}

function displayTodos($employeeToDoDB) {
    /* Uses the EmployeeToDoDB gateway class to find the list of To Do's associated to the employee's ID and sorts it by Date*/
    
    $result = $employeeToDoDB->findListByIdSorted(true, $_GET['employee']);
    foreach($result as $row){
        $date = date_create( substr($row['DateBy'], 0, -9) );
        echo '<tr><td>' . date_format($date, "Y-M-d") . '</td><td>' . $row['Status'] . '</td><td>' . 
            $row['Priority'] . '</td><td style="text-align:left;">' . $row['Description'] .  '</td></tr>';
    }
}

function displayMessages($messageDB) {
    /* Uses the MessageDB gateway class to find the list of messages associated to the employee's ID and sorts it by Date*/
    
    $result = $messageDB->findListByIdSorted(true,$_GET['employee']);
    foreach($result as $row) {
        echo '<tr><td>' . date("Y-M-d", strtotime($row['MessageDate'])) . '</td><td>' . $row['Category'] . '</td><td>' . 
        $row['FirstName'] . " " . $row['LastName'] . '</td><td style="text-align:left;">' . substr($row['Content'], 0, 39) .  '</td></tr>';
    }
}

function displayTabs () {
    if (!isset($_GET['employee']) ) {
        echo ' style="display:none;"';
    }
}

/* Fixed up this function to display an error if the returned sql query is null. Had to remove the first echo as it would display duplicates. I also added this
check in the above "displayDetails" function as it would throw an error if the employee id was empty. */
function printError($employeeDB) {
    if (!isset($_GET['employee']) ) {
    }
    else {
        /* checks if the employee id is empty or not in the table*/
        $testQuery = $employeeDB->findById($_GET['employee']);
        if($testQuery == null){
            echo '<h4>Did not understand request. Try clicking on an employee from the list.</h4>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Employees</title>
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

              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet mdl-cell--4-col-phone card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Employees</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">

                         <?php  
                           /* programmatically loop though employees and display each
                              name as <li> element. */
                              printEmployees($employeeDB);
                         ?>            

                    </ul>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->
              
              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--9-col mdl-cell--5-col-tablet mdl-cell--4-col-phone card-lesson mdl-card  mdl-shadow--2dp">

                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Employee Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                          <div class="mdl-tabs__tab-bar" <?php displayTabs(); ?>>
                              <a href="#address-panel" class="mdl-tabs__tab is-active">Address</a>
                              <a href="#todo-panel" class="mdl-tabs__tab">To Do</a>
                              <a href="#messages-panel" class="mdl-tabs__tab">Messages</a>
                          </div>
                            
                          <?php printError($employeeDB); ?>
                          
                          <div class="mdl-tabs__panel is-active" id="address-panel">
                              
                           <?php   
                             /* display requested employee's information */
                             displayDetails($employeeDB);
                           ?>
                           
         
                          </div>
                          <div class="mdl-tabs__panel" id="todo-panel">
                              
                               <?php                       
                                 /* retrieve for selected employee;
                                    if none, display message to that effect */
                                    if (isset ($_GET['employee']) )
	                                    echo "";
                                    else
                                        echo "<h5>No employee selected.</h5>";

                               ?>                                  
                            
                                <table class="mdl-data-table  mdl-shadow--2dp">
                                  <thead>
                                    <tr>
                                      <th class="mdl-data-table__cell--non-numeric">Date</th>
                                      <th class="mdl-data-table__cell--non-numeric">Status</th>
                                      <th class="mdl-data-table__cell--non-numeric">Priority</th>
                                      <th class="mdl-data-table__cell--non-numeric">Content</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                   
                                    <?php /*  display TODOs  */ 
                                        displayTodos($employeeToDoDB);
                                    
                                    ?>
                            
                                  </tbody>
                                </table>
                           
         
                          </div>
                          
                          <div class="mdl-tabs__panel" id="messages-panel">
                              
                               <?php                       
                                 /* retrieve for selected employee;
                                    if none, display message to that effect */
                                    if (isset ($_GET['employee']) )
	                                    echo "";
                                    else
                                        echo "<h5>No employee selected.</h5>";

                               ?>                                  
                            
                                <table class="mdl-data-table  mdl-shadow--2dp">
                                  <thead>
                                    <tr>
                                      <th class="mdl-data-table__cell--non-numeric">Date</th>
                                      <th class="mdl-data-table__cell--non-numeric">Category</th>
                                      <th class="mdl-data-table__cell--non-numeric">From</th>
                                      <th class="mdl-data-table__cell--non-numeric">Messages</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                   
                                    <?php /*  display Messages  */ 
                                        displayMessages($messageDB);
                                    ?>
                            
                                  </tbody>
                                </table>
                          </div>
                        </div>                         
                    </div>    
  
                 
              </div>  <!-- / mdl-cell + mdl-card -->   
            </div>  <!-- / mdl-grid -->  

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
<?php

require_once('config.php');

function createPDO() {
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
    $id = $_GET['employee'];
    $result = $pdo->prepare($sql);
    $result->bindValue(':id', $id);
    $result->execute();
    return $result;
    $pdo = null;
}

function printEmployees() {
    $pdo = createPDO();
    $sql = 'select * from Employees
				Order By LastName';
    $result = $pdo->query($sql);
	while ($row = $result->fetch())	{
		echo '<li><a href="?employee='. $row['EmployeeID'] . '"><h6>' . $row['FirstName'] . ' ' . $row['LastName'] . '</h6></a></li>';							
    }
    $pdo = null;
}

function displayDetails() {
    $sql = "select * from Employees where EmployeeID=:id";
    $result = callDB($sql);
    while ($row = $result->fetch()) {
        echo "<h4>" . $row['FirstName'] . " " . $row["LastName"] . "</h4>";
        echo $row['Address'] . '<br>';
        echo $row['City'] . ', ' . $row['Region'] . '<br>';
        echo $row['Country'] . ', ' . $row['Postal'] . '<br>';
        echo $row['Email'];
    }
}

function displayTodos() {
    $sql = "select * from EmployeeToDo where EmployeeID=:id order by DateBy";
    $result = callDB($sql);
    while ($row = $result->fetch()) {
        $date = date_create( substr($row['DateBy'], 0, -9) );
        echo '<tr><td>' . date_format($date, "Y-M-d") . '</td><td>' . $row['Status'] . '</td><td>' . 
            $row['Priority'] . '</td><td style="text-align:left;">' . $row['Description'] .  '</td></tr>';
    }
}

function displayMessages() {
    $sql = "SELECT EmployeeMessages.MessageDate, EmployeeMessages.Category, Contacts.FirstName, Contacts.LastName, EmployeeMessages.Content
            FROM EmployeeMessages
            INNER JOIN Contacts on EmployeeMessages.ContactID=Contacts.ContactID
            WHERE EmployeeMessages.EmployeeID=:id
            ORDER BY MessageDate";
    $result = callDB($sql);
    while ($row = $result->fetch()) {
        $date = date_create( substr($row['MessageDate'], 0, -9) );
        echo '<tr><td>' . date_format($date, "Y-M-d") . '</td><td>' . $row['Category'] . '</td><td>' . 
        $row['FirstName'] . " " . $row['LastName'] . '</td><td style="text-align:left;">' . substr($row['Content'], 0, 39) .  '</td></tr>';
    }
}

function displayTabs () {
    if (!isset($_GET['employee']) ) {
        echo ' style="display:none;"';
    }
}


function printError() {
    if (!isset($_GET['employee']) ) {
        echo '<h4>Please select an employee.</h4>';
    }
    else {
        $testQuery = callDB("SELECT EmployeeID FROM Employees WHERE EmployeeID=:id");
        if ( $testQuery->rowCount() == 0 ) {
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
                              printEmployees();
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
                            
                          <?php printError(); ?>
                          
                          <div class="mdl-tabs__panel is-active" id="address-panel">
                              
                           <?php   
                             /* display requested employee's information */
                             displayDetails();
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
                                        displayTodos();
                                    
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
                                   
                                    <?php /*  display TODOs  */ 
                                        displayMessages();
                                    
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
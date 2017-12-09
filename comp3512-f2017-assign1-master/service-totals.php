<?php
header('Content-Type: application/json');
require_once('includes/db-config.inc.php');

$visitsDB = new BookVisitsGateway($connection);
$todosDB = new EmployeesToDoGateway($connection);
$messagesDB = new MessagesGateway($connection);

$final["totalVisits"] = $visitsDB->findAll()[0]['Visits'];

$result = $visitsDB->findAllGrouped();
$count = 0;
foreach ($result as $row) {
    $count++;
}
$final["totalCountries"] = $count;

$result = $todosDB->customWhere("DateBy BETWEEN '2017-06-01 00:00:00' AND '2017-06-30 00:00:00'");
$count = 0;
foreach ($result as $row) {
    $count++;
}
$final["totalTodos"] = $count;

$result = $messagesDB->customWhere("MessageDate BETWEEN '2017-06-01 00:00:00' AND '2017-06-30 00:00:00'");
$count = 0;
foreach ($result as $row) {
    $count++;
}
$final["totalMessages"] = $count;


echo json_encode($final);

?>
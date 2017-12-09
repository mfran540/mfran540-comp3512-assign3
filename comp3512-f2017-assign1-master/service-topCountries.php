<?php
require_once('includes/db-config.inc.php');

$analytics = new BookVisitsGateway($connection);
$jsonObject = $analytics->findAllSortedLimitedGrouped(false, 15);

header('Content-Type: application/json');
echo json_encode($jsonObject);

?>
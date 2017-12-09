<?php
header('Content-Type: application/json');
require_once('includes/db-config.inc.php');

$adoptionsDB = new AdoptionsAnalyticsGateway($connection);


$jsonObject = $adoptionsDB->findAllSortedLimitedGrouped(false, 10);

echo json_encode($jsonObject);

?>
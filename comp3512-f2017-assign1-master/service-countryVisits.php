<?php
header('Content-Type: application/json');
require_once('includes/db-config.inc.php');

$visitsDB = new BookVisitsGateway($connection);


$jsonObject = $visitsDB->findAllSortedLimitedGrouped(false, 15);

foreach($jsonObject as $row) {
    if($row["CountryCode"] == $_GET['countryCode']) {
        $final["CountryName"] = $row["CountryName"];
        $final["Visits"] = $row["Visits"];
        
        echo json_encode($final);
    }
}
?>
<?php
header('Content-Type: application/json');
require_once('includes/db-config.inc.php');

$visitsDB = new BookVisitsGateway($connection);


$jsonObject = $visitsDB->findAllSortedLimitedGrouped(false, 15);

foreach($jsonObject as $row) {
    if($row["CountryCode"] == $_GET['countryCode']) {
        //$result = [$row['CountryName'], $row['Visits']];
        
        $final["CountryName"] = $row["CountryName"];
        $final["Visits"] = $row["Visits"];
        
        //$name["CountryName"] = $row['CountryName'];
        //$visits['Visits'] = $row['Visits'];
        //$result = [$name, $visits];
        echo json_encode($final);
    }
}
//IT WORKS NOW
//Takes a query string called countryCode

?>
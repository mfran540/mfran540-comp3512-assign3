<?php
header('Content-Type: application/json');
require_once('includes/db-config.inc.php');

$visitsDB = new BookVisitsGateway($connection);


$jsonObject = $visitsDB->customStatement("SELECT DateViewed, COUNT(DateViewed) AS Num FROM BookVisits GROUP BY DateViewed");

$count = 1;
$final = [];
foreach($jsonObject as $row) {
    $final[] = [
    "DateViewed" => $count,
    "Visits" => (int)$row["Num"]
    ];
    $count+=1;
}

echo json_encode($final);
?>
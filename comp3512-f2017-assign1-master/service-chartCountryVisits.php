<?php
header('Content-Type: application/json');
require_once('includes/db-config.inc.php');

$visitsDB = new BookVisitsGateway($connection);


$jsonObject = $visitsDB->customStatement('SELECT Countries.CountryName, COUNT(BookVisits.CountryCode) AS Visits
                                            FROM BookVisits 
                                            INNER JOIN Countries ON BookVisits.CountryCode = Countries.CountryCode
                                            GROUP BY Countries.CountryCode');

$final = [];
foreach($jsonObject as $row) {
    if ((int)$row["Visits"] > 10) {
        $final[] = [
        "CountryName" => $row["CountryName"],
        "Visits" => (int)$row["Visits"]
        ];
    }
}

echo json_encode($final);
?>
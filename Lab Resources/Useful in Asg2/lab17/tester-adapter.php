<?php
include 'includes/book-config.inc.php';

$sql = "select * from Imprints";
$statement = DatabaseHelper::runQuery($connection, $sql, null);

?>

<html>
<body>
<h1>Imprints (using DatabaseHelper)</h1>
<?php

    while ($row = $statement->fetch()) {
        echo $row['ImprintID'] . ' ' . $row['Imprint'] . '<br>';
    }
    
?>
</body>
</html>
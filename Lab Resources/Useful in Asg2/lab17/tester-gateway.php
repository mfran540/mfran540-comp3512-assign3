<?php

include 'includes/book-config.inc.php';

?>

<html>
<body>

<?php

try {
    $db = new ImprintDB($connection );
    $result = $db->findById(5);
    echo '<h3>Sample Imprint (id=5)</h3>';
    echo $result['ImprintID'] . ' ' . $result['Imprint'];
    
    $result = $db->getAll();
    echo '<h3>All Imprints</h3>';
    foreach ($result as $row) {
        echo $row['ImprintID'] . ' ' . $row['Imprint'] . ', ';
    }

}
catch (Exception $e) {
   die( $e->getMessage() );
}

echo '<hr>';

$db = new EmployeesGateway($connection );
$result = $db->findById(11);
echo '<h3>Sample Employee (id=11)</h3>';
echo $result['EmployeeID'] . ' ' . $result['FirstName'] . ' ' .
$result['LastName'] . ' ' . $result['Address'];

$result = $db->findAll();
echo '<h3>All Employees</h3>';
foreach ($result as $row) {
    echo $row['EmployeeID'] . ' ' . $row['LastName'] . ', ';
} 

?>
</body>
</html>
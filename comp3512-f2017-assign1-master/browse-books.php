<?php
include 'includes/login-checker.inc.php';
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

function callDB($sql, $id) {
    $pdo = createPDO();
    $result = $pdo->prepare($sql);
    $result->bindValue(':id', $id);
    $result->execute();
    return $result;
    $pdo = null;
}

function callDB2($sql, $id, $id2) {
    $pdo = createPDO();
    $result = $pdo->prepare($sql);
    $result->bindValue(':id', $id);
    $result->bindValue(':id2', $id2);
    $result->execute();
    return $result;
    $pdo = null;
}

function printSubcats() {
    $pdo = createPDO();
    $sql = 'SELECT * FROM Subcategories ORDER BY SubcategoryName LIMIT 0,20';
    $result = $pdo->query($sql);
    /*
    echo "<option value='None'>All Subcategories</option>";
    while ($row = $result->fetch()) {
        echo "<option>" . $row['SubcategoryName'] . "</option>";
    }*/
    
    echo "<input type='radio' name='subcat' value='None'>None" . "<br>";
    while ($row = $result->fetch()) {
        echo "<input type='radio' name='subcat' value='" . $row['SubcategoryName'] . "'>" . $row['SubcategoryName'] . "<br>";
    }
}

function printImprints() {
    $pdo = createPDO();
    $sql = 'SELECT * FROM Imprints ORDER BY Imprint';
    $result = $pdo->query($sql);
    
    echo "<input type='radio' name='imprint' value='None'>None" . "<br>";
    while ($row = $result->fetch()) {
        echo "<input type='radio' name='imprint' value='" . $row['Imprint'] . "'>" . $row['Imprint'] . "<br>";
    }
}


function printCookie ($type) {
    if ( isset($_COOKIE[$type]) ) {
        echo "<h5>Current filter: " . $_COOKIE[$type] . "</h5>";
    }
}

function makeTD($result) {
    while ($row = $result->fetch()) {
        echo '<tr><td><a href="single-book.php?isbn10=' . $row['ISBN10'] . '"><img src="' . 'book-images/thumb/' . $row['ISBN10'] . '.jpg"> <strong>' . $row['Title'] . "</strong> (" . 
        $row['CopyrightYear'] . ")</a></td><td>" . 
        $row['SubcategoryName'] . "/" . $row['Imprint'] . "</td></tr>";
    }
}

function listBooks () {
    $pdo = createPDO();
    if ( strpos($_COOKIE['SUBCAT'], 'None') !== false && strpos($_COOKIE['IMPRINT'], 'None') !== false ) { /* None|None */
        $sql = 'SELECT ISBN10, Title, CopyrightYear, Subcategories.SubcategoryName, Imprints.Imprint
                FROM Books
                INNER JOIN Subcategories ON Books.SubcategoryID = Subcategories.SubcategoryID
                INNER JOIN Imprints ON Books.ImprintID = Imprints.ImprintID
                ORDER BY Title 
                LIMIT 0 , 20';
        $result = $pdo->query($sql);
        makeTD($result);
    }
    else if ( strpos($_COOKIE['SUBCAT'], 'None') !== true && strpos($_COOKIE['IMPRINT'], 'None') !== false ) { /* ~|None */
        $sql = 'SELECT ISBN10, Title, CopyrightYear, Subcategories.SubcategoryName, Imprints.Imprint
                FROM Books
				INNER JOIN Subcategories ON Books.SubcategoryID = Subcategories.SubcategoryID
                INNER JOIN Imprints ON Books.ImprintID = Imprints.ImprintID
				WHERE Subcategories.SubcategoryName =:id
                ORDER BY Title 
                LIMIT 0 , 20';
        $result = callDB($sql, $_COOKIE['SUBCAT']);
        makeTD($result);
    }
    else if ( strpos($_COOKIE['SUBCAT'], 'None') !== false && strpos($_COOKIE['IMPRINT'], 'None') !== true ) { /* None|~ */
        $sql = 'SELECT ISBN10, Title, CopyrightYear, Subcategories.SubcategoryName, Imprints.Imprint
                FROM Books
				INNER JOIN Subcategories ON Books.SubcategoryID = Subcategories.SubcategoryID
                INNER JOIN Imprints ON Books.ImprintID = Imprints.ImprintID
				WHERE Imprints.Imprint =:id
                ORDER BY Title 
                LIMIT 0 , 20';
        $result = callDB($sql, $_COOKIE['IMPRINT']);
        makeTD($result);
    }
    else { /* ~|~ */
        $sql = 'SELECT ISBN10, Title, CopyrightYear, Subcategories.SubcategoryName, Imprints.Imprint
                FROM Books
				INNER JOIN Subcategories ON Books.SubcategoryID = Subcategories.SubcategoryID
                INNER JOIN Imprints ON Books.ImprintID = Imprints.ImprintID
				WHERE Imprints.Imprint =:id2 AND Subcategories.SubcategoryName=:id
                ORDER BY Title 
                LIMIT 0 , 20';
        $result = callDB2($sql, $_COOKIE['SUBCAT'], $_COOKIE['IMPRINT']);
        makeTD($result);
    }
    $pdo = null;
}

//MOVE THIS TO CONFIG FILE OR SOMEWHERE ON INDEX PAGE
function makeCookiesNone() {
    if (!isset($_COOKIE['SUBCAT'])){
        setcookie('SUBCAT', 'None', 0);
    }
    if (!isset($_COOKIE['IMPRINT'])){
        setcookie('IMPRINT', 'None', 0);
    }
}
makeCookiesNone();



?>
<!DOCTYPE html>

<html lang="en">
    
<head>
    <?php //redirectToLogin('browse-books.php'); ?>
    <title>Books</title>
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

              <!-- Books card | mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card  mdl-shadow--2dp">

                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Books</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        
                        <table id="booktable">
                            <tr>
                                <th>Title</th>
                                <th>Subcategory/Imprint</th>
                            </tr>
                            <?php listBooks(); ?>
                        </table>
                        
                    </div>    
              </div>  <!-- / mdl-cell + mdl-card -->   
              
              <!-- Filters cards | mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--4-col-phone card-lesson mdl-card  mdl-shadow--2dp">
                
                <!-- Imprint Card -->  
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Imprint Filter</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">
                        
                        <?php printCookie('IMPRINT'); ?>
                        <form action="make-cookies.php" method='post'>
                            
                            <?php printImprints(); ?>
                            <input type='submit' value='Filter'>
                            
                        </form>            

                    </ul>
                </div>
                
                <!-- Subcategory Card -->
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Subcategory Filter</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">
                        
                        <?php printCookie('SUBCAT'); ?>
                        <form action="make-cookies.php" method='post'>
                            <!--
                            <select name="subcat">
                                <?php printSubcats(); ?>
                            </select>
                            <input type='submit' value='Filter'>
                            -->
                            <?php printSubcats(); ?>
                            <input type='submit' value='Filter'>
                        </form>    
                    </ul>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->
              
              
              
            </div>  <!-- / mdl-grid -->  

        </section>
    </main>    
</div>    <!-- / mdl-layout -->
          
</body>
</html>
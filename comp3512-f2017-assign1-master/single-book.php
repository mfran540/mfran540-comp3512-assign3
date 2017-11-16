<?php
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

function displayText($name) {
    $sql = 'SELECT ISBN10, ISBN13, Title, CopyrightYear, Subcategories.SubcategoryName, Imprints.Imprint, Statuses.Status, BindingTypes.BindingType,
		            TrimSize, PageCountsEditorialEst, Books.Description
            FROM Books
            INNER JOIN Subcategories ON Books.SubcategoryID=Subcategories.SubcategoryID
            INNER JOIN Imprints ON Books.ImprintID=Imprints.ImprintID
            INNER JOIN Statuses ON Books.ProductionStatusID=Statuses.StatusID
            INNER JOIN BindingTypes ON Books.BindingTypeID=BindingTypes.BindingTypeID
            WHERE Books.ISBN10=:id';
    $result = callDB($sql, $_GET['isbn10']);
    while ($row = $result->fetch() ) {
        if ($name == 'SubcategoryName'){
            echo "<a href='browse-books.php?subcat=".$row[$name]."'>".$row[$name]."</a>";
        }
        else if ($name == 'Imprint'){
            echo "<a href='browse-books.php?Imprint=".$row[$name]."'>".$row[$name]."</a>";
        }
        else {
        echo $row[$name];
        }
    }
}

function printAuthors() {
    $sql = 'SELECT FirstName, LastName, Books.ISBN10, Books.BookID
            FROM Authors
            INNER JOIN BookAuthors ON Authors.AuthorID=BookAuthors.AuthorID
            INNER JOIN Books ON BookAuthors.BookID=Books.BookID
            WHERE Books.ISBN10=:id
            ORDER BY BookAuthors.Order';
    $result = callDB($sql, $_GET['isbn10']);
    while ($row = $result->fetch() ) {
        echo $row['FirstName'] . ' ' . $row['LastName'] . '<br>' . '<br>';
    }
}

function printUniversities() {
    $sql = 'SELECT Universities.Name, Universities.UniversityID, Books.ISBN10
        FROM Universities
        INNER JOIN Adoptions ON Universities.UniversityID = Adoptions.UniversityID
        INNER JOIN AdoptionBooks ON Adoptions.AdoptionID = AdoptionBooks.AdoptionID
        INNER JOIN Books ON AdoptionBooks.BookID = Books.BookID
        WHERE Books.ISBN10=:id
        ORDER BY Name';
    $result = callDB($sql, $_GET['isbn10']);
    while ($row = $result->fetch() ) {
        echo "<a href='browse-universities.php?university=".$row['UniversityID']."'>".$row['Name'] . '</a><br>';
    }
}


function displayPage () {
    if (!isset($_GET['isbn10']) || !isGoodQS()) {
        echo ' style="display:none;"';
    }
}

function printError() {
    if (!isset($_GET['isbn10']) ) {
        echo '<h4 class="singleerror">Please go to <a href="browse-books.php"><strong>books page</strong></a> to select a book.</h4>';
    }
    else if (!isGoodQS()) {
        echo '<h4 class="singleerror">Did not understand request. Try going back to the <a href="browse-books.php"><strong>books page.</strong></a></h4>';
    }
}

function isGoodQS() {
    $result = true;
    $testQuery = callDB("SELECT ISBN10 FROM Books WHERE ISBN10=:id", $_GET['isbn10']);
        if ( $testQuery->rowCount() == 0 ) {
            $result = false;
        }
    return $result;
}


?>
<!DOCTYPE html>

<html lang="en">
    
<head>
    <title>Single Book</title>
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
    
    <style type="text/css">
        #largeImage{
            text-align: center;
            position: absolute;
            visibility: hidden;
            z-index: 100;
            top: 0; left: 0; 
            padding-top: 3em;
            width:100%;
            height:100%; 
            background-color: rgba(100,100,100, .5)
        }
    </style>
    <script>
        function enlargeImage (id) {
            document.querySelector(id).style.visibility = "visible";
        }
        
        function hideImage (image) {
            image.style.visibility = "hidden";
            window.location.reload();
        }        
    </script>
    <main class="mdl-layout__content mdl-color--grey-50">
        <?php printError(); ?>
        <section class="page-content" <?php displayPage() ?>>
        <div id="largeImage">
            <img src="book-images/large/<?php echo $_GET['isbn10'] ?>.jpg" onclick="hideImage(this)"/>
        </div>    
            <div class="mdl-grid">
                <div class="mdl-card mdl-cell mdl-cell--6-col mdl-cell--3-col-tablet mdl-cell--4-col-phone mdl-shadow--2dp">
                    <figure id="singleImage" class="mdl-card__media">
                        <img src="book-images/medium/<?php echo $_GET['isbn10'] ?>.jpg" onclick="enlargeImage('#largeImage')"/>
                    </figure>
                    <div id="cardtitle" class="mdl-card__title">
                        <h1 id="singlebooktitle" class="mdl-card__title-text"><?php displayText('Title'); ?> (<?php displayText('CopyrightYear') ?>)</h1>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <h5>Details</h5>
                        <p>ISBN10: <?php echo $_GET['isbn10']; ?></p>
                        <p>ISBN13: <?php displayText('ISBN13'); ?></p>
                        <p>Subcategory: <?php displayText('SubcategoryName'); ?></p>
                        <p>Imprint: <?php displayText('Imprint'); ?></p>
                        <p>Production Status: <?php displayText('Status'); ?></p>
                        <p>Binding Type: <?php displayText('BindingType'); ?></p>
                        <p>Trim size: <?php displayText('TrimSize'); ?></p>
                        <p>Page count: <?php displayText('PageCountsEditorialEst'); ?></p>
                        
                        <p><h5>Description</h5><?php displayText('Description'); ?></p>
                    </div>
                </div>
                
                <!-- mdl-cell + mdl-card -->
                <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-tablet mdl-cell--4-col-phone card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--orange">
                        <h2 class="mdl-card__title-text">Authors</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <ul class="demo-list-item mdl-list">
                        <h5>
                         <?php  
                            printAuthors();
                         ?>
                            </h5>
                        </ul>
                    </div>
                  </div>  <!-- / mdl-cell + mdl-card -->
                  
                  <!-- mdl-cell + mdl-card -->
                <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet mdl-cell--4-col-phone card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--orange">
                        <h2 class="mdl-card__title-text">Adopted By</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <ul class="demo-list-item mdl-list">

                         <?php  
                           printUniversities();
                         ?>            

                        </ul>
                    </div>
                  </div>  <!-- / mdl-cell + mdl-card -->
               
            </div>  <!-- / mdl-grid -->  

        </section>
    </main>    
</div>    <!-- / mdl-layout -->
          
</body>
</html>
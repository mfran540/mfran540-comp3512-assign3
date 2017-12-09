<?php
include 'includes/login-checker.inc.php';
require_once('includes/db-config.inc.php');

$booksDB = new BooksGateway($connection );
$authorDB = new AuthorsGateway($connection );
$universitiesDB = new UniversitiesGateway($connection);

/*
    Displays the info from database depending on which type is passed in
*/
function displayText($booksDB) {
    $result = $booksDB->findListById($_GET['isbn10']);
    foreach ($result as $row) {
        echo "
        <div id='cardtitle' class='mdl-card__title'>
        <h1 id='singlebooktitle' class='mdl-card__title-text'>".$row['Title'].$row['CopyrightYear']." </h1></div>
        <div class='mdl-card__supporting-text'><h5>Details</h5>
        <p>ISBN10:".$row['ISBN10']."</p>
        <p>ISBN13:".$row['ISBN13']."</p>
        <p>Subcategory: <a href = 'browse-books.php?subcat=".$row['SubcategoryID']."'>".$row['SubcategoryName']."</a></p>
        <p>Imprint: <a href = 'browse-books.php?imprint=".$row['ImprintID']."'>".$row['Imprint']."</a></p>
        <p>Production Status:".$row['Status']."</p>
        <p>Binding Type:".$row['BindingType']."</p>
        <p>Trim size:".$row['TrimSize']."</p>
        <p>Page count:".$row['PageCountsEditorialEst']."</p>
        <p><h5>Description</h5>".$row['Description']."</p></div>";
    }
                    
}

/*
    Prints the authors of the book in a list
*/
function printAuthors($authorDB) {
    $result = $authorDB->findListByIdSorted(true, $_GET['isbn10']);
    foreach ($result as $row) {
        echo $row['FirstName'] . ' ' . $row['LastName'] . '<br>' . '<br>';
    }
}

/*
    Prints a list of universites that adopted the book with a link back to university page
*/
function printUniversities($universitiesDB) {
    $result = $universitiesDB->adoptedUniversitiesList($_GET['isbn10']);
    foreach ($result as $row) {
        echo "<a href='browse-universities.php?university=".$row['UniversityID']."'>".$row['Name'] . '</a><br>';
    }
}

/*
    Hides contents of page if query string is incorrect
*/
function displayPage () {
    if (!isset($_GET['isbn10'])) {
        echo ' style="display:none;"';
    }
}

/*
    Prints an error if the query string is not there or incorrect
*/
function printError($booksDB) {
    if (!isset($_GET['isbn10']) ) {
    }
    else {
        /* checks if the books id is empty or not in the table*/
        $testQuery = $booksDB->findById($_GET['isbn10']);
        if($testQuery == null){
            echo '<h4>Did not understand request. Try going back to the books list and clicking on a book.</h4>';
        }
    }
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
        <?php printError($booksDB); ?>
        <section class="page-content" <?php displayPage() ?>>
        <div id="largeImage">
            <img src="book-images/large/<?php echo $_GET['isbn10'] ?>.jpg" onclick="hideImage(this)"/>
        </div>    
            <div class="mdl-grid">
                <div class="mdl-card mdl-cell mdl-cell--6-col mdl-cell--3-col-tablet mdl-cell--4-col-phone mdl-shadow--2dp">
                    <figure id="singleImage" class="mdl-card__media">
                        <img src="book-images/medium/<?php echo $_GET['isbn10'] ?>.jpg" onclick="enlargeImage('#largeImage')"/>
                    </figure>
                    <?php displayText($booksDB); ?>
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
                            printAuthors($authorDB);
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
                           printUniversities($universitiesDB);
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
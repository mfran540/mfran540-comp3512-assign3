<?php
include 'includes/login-checker.inc.php';
require_once('includes/db-config.inc.php');

$booksDB = new BooksGateway($connection );
$subcatDB = new SubcatGateway($connection );
$imprintDB = new ImprintGateway($connection );

function displayBooks($booksDB){
    if (isset($_GET['subcat'])) {
    // display books with subcategory selected
    
    $result = $booksDB->findListBySubcat($_GET['subcat']);
                    
    foreach ($result as $row ){
        echo createBook($row['ISBN10'],$row['Title'],$row['CopyrightYear'],$row['SubcategoryName'],$row['Imprint']);
        }
    }
    elseif (isset($_GET['imprint'])) {
    // display books with imprint selected
    
    $result = $booksDB->findListByImprint($_GET['imprint']);
                    
    foreach ($result as $row ){
        echo createBook($row['ISBN10'],$row['Title'],$row['CopyrightYear'],$row['SubcategoryName'],$row['Imprint']);
        }
    }
    else {
    //display list of all books, limit 20, unfiltered
    
    $result = $booksDB->findAllBooksSorted(true);
                    
    foreach ($result as $row ){
        echo createBook($row['ISBN10'],$row['Title'],$row['CopyrightYear'],$row['SubcategoryName'],$row['Imprint']);
        }
    }
}

function createBook($isbn,$title,$year,$subcat,$imprint){
   
   $markup="<a href='single-book.php?isbn10=".$isbn."' class='mdl-js-ripple-effect'>
            <div class='mdl-cell mdl-shadow--2dp mdl-typography--text-center mdl-color--orange books-card'>
            <div class='mdl-card__title mdl-card--border'>";

    $markup.="<div class='mdl-layout-spacer'></div><img src='book-images/thumb/".$isbn.".jpg' alt'".$isbn."'></img><div class='mdl-layout-spacer'></div></div>
                <div class='mdl-card__supporting-text'>".
                "<b>Title: </b>".$title."</br>".
                "<b>Copyright Year: </b>".$year."</br>".
                "<b>Sub-Category: </b>".$subcat."</br>".
                "<b>Imprint: </b>".$imprint."</br>".
                "<b>ISBN10: </b>".$isbn."</br>"
                ."</div>";
                            
    $markup.="<a href='single-book.php?isbn10=".$isbn."' class='mdl-js-ripple-effect'></a></div></a>";
                            
    return $markup;
}

function filter(){
    if (isset($_GET['subcat']) || isset($_GET['imprint'])){
        echo "<a class='mdl-button mdl-js-button mdl-js-ripple-effect' href='browse-books.php?'> Remove Filters </a>";
    }
}

function displaySubCat($subcatDB){
    //display subcategories and assign filter.
    $result = $subcatDB->findAll();
                        
    foreach ($result as $row) {         
        echo "<li class='mdl-list'><a href='browse-books.php?subcat=".$row['SubcategoryID']."'>".$row['SubcategoryName']."</a></li>";
    }
}

function displayImprint($imprintDB){
    //Display all imprint filters in a list, sorted by title.
    $result = $imprintDB->findAllSorted(true);
                        
    foreach ($result as $row) {         
        echo "<li class='mdl-list'><a href='browse-books.php?imprint=".$row['ImprintID']."'>".$row['Imprint']."</a></li>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php redirectToLogin('browse-universities.php'); ?>
    <title>Assignment 1</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">

    <link rel="stylesheet" href="css/styles.css">
    
    
    <script src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
       
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

              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--2-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Set Filter's</h2>
                </div>
                <div class="mdl-card__subtitle-text mdl-color--deep-purple mdl-typography--text-center">
                  <h5 class="mdl-color-text--white">Imprints</h5>
                </div>
                <div class="mdl-card__supporting-text">
                    <?php
                    //adds filter button if the filter is selected
                        filter();
                    ?>
                
                    <ul class="demo-list-item mdl-list">
                        <?php
                        displayImprint($imprintDB);            
                        ?>
                    </ul>
                </div>
              
                <div class="mdl-card__subtitle-text mdl-color--deep-purple mdl-typography--text-center">
                  <h5 class="mdl-color-text--white">Sub-Categories</h5>
                </div>
                <div class="mdl-card__supporting-text">
                    
                    <ul class="demo-list-item mdl-list">

                    <?php
                    displaySubCat($subcatDB);
                    ?>            

                    </ul>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->
              
              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--orange mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Books</h2>
                    </div>
                
                <div class="mdl-grid">
                    <?php
                    displayBooks($booksDB);
                    
                    //close connection
                    $pdo=null;    
                    ?>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->   
            </div>  <!-- / mdl-grid -->    
        </section>
    </main>
</div>    <!-- / mdl-layout --> 
</body>
</html>
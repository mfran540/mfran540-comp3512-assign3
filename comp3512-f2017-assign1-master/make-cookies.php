<?php

if ( isset($_POST['subcat']) ) {
        setcookie('SUBCAT', $_POST['subcat'], 0);
}

if ( isset($_POST['imprint']) ) {
        setcookie('IMPRINT', $_POST['imprint'], 0);
}

header("Location: browse-books.php");

?>
<?php 
    //Kills all session data
    session_start();
    $_SESSION = array();
    session_destroy();
?>

<script>
    //Redirects back to index page after logout
     window.location.href="index.php";
</script>
<?php 
require_once('includes/db-config.inc.php');
$usersDB = new UsersGateway($connection ); 

function printUserName($id,$usersDB)
{
    $row = $usersDB->findById($id);
    echo "<h4>" . $row['FirstName'] . " " . $row["LastName"] . "</h4>";
    echo "<span>".$row['Email']."</span>";
}

?>

  <div class="mdl-layout__drawer mdl-color--blue-grey-800 mdl-color-text--blue-grey-50">
       <div class="profile">
           <?php 
            if(isset($_SESSION['userId'])) {
                echo '<img src="images/GenericUserOnline.png" class="avatar">';
                printUserName($_SESSION['userId'],$usersDB);
                
            }
            else { 
                echo '<img src="images/GenericUserOffline.png" class="avatar">';
                echo "";}
            ?>
       </div>

    <nav class="mdl-navigation mdl-color-text--blue-grey-300">
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="index.php"><i class="material-icons" role="presentation">dashboard</i> Dashboard</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="user-profile.php"><i class="material-icons" role="presentation">perm_identity</i> User Profile</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="browse-employees.php"><i class="material-icons" role="presentation">group</i> Employees</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="browse-books.php"><i class="material-icons" role="presentation">import_contacts</i> Books</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="browse-universities.php"><i class="material-icons" role="presentation">account_balance</i> Universities</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="analytics.php"><i class="material-icons" role="presentation">insert_chart</i> Analytics</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="aboutus.php"><i class="material-icons" role="presentation">announcement</i> About</a> 
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="login.php"><i class="material-icons" role="presentation">input</i> Login</a> 
    </nav>
    
  </div>
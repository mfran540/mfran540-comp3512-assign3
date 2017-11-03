
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
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
                <div class="mdl-card mdl-cell mdl-cell--4-col mdl-cell--3-col-tablet mdl-shadow--2dp">
                    <figure id="singleImage" class="mdl-card__media"><img src="images/Marc.jpg"/>
                    </figure>
                    <div class="mdl-card__title">
                        <h1 class="mdl-card__title-text">Marc Francois</h1>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <p><strong>COMP3512 (Web 2)</strong> - Fall 2017</p>
                        <p>Todays Date: <?php echo date("l, F jS Y"); ?></p>
                    </div>
                </div>
    
                <!-- mdl-cell + mdl-card -->
                  <div class="mdl-cell mdl-cell--5-col mdl-cell--5-col-tablet mdl-cell--4-col-phone card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--orange">
                      <h2 class="mdl-card__title-text">Resources (not mine)</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <ul class="demo-list-item mdl-list">
                            <h4>- Material Design Lite and Components</h4>
                            <h4>- JQuery Sparkline</h4>
                            <h4>- Dashboard Images (random Google searches)</h4>
                            <h4>- Base code from Lab 4 (Author Randy Connolly)</h4>
                            <h4>- Code from Lab 5 (Cookies)</h4>
                            <h4>- book-complete.sql data</h4>
                            <h4>- Book images</h4>
                        </ul>
                    </div>
                  </div>  <!-- / mdl-cell + mdl-card -->
            </div>
        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
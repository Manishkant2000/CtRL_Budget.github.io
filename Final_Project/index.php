<?php
require 'includes/common.php';
if(isset($_SESSION['email'])){
    header('location:home.php');

}
    ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Expense Manager</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >    
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>   
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">        
    </head>
    <body>
        <?php
        require 'includes/header.php';
        ?>
        
        <div id="banner_image" >
            <div class="container">
                <div id="banner_content">
                    <h4>We help you control your budget</h4>
                    <a href="login.php" class="btn btn-info btn-lg">Start Today</a>
                </div>
            </div>
        </div>
        
        <?php
        require 'includes/footer.php';
        ?>
    </body>
</html>



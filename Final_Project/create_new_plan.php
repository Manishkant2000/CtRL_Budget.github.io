<?php
require 'includes/common.php';
if(!isset($_SESSION['email'])){
    header('location:index.php');
}
else{
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Expense Manager</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >    
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>   
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
            #i:hover{
                background-color: #05836D;
                color: #f8f8f8;
            }
            #i{
                color: #05836D;
                border-color: #05836D;
            }
        </style>
    </head>
    <body>
        <?php
        include 'includes/header.php'; ?>
        
        <div class="container" style='margin-top: 75px; margin-bottom: 75px;'>           
            <div class="row">                
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <div class="panel panel-info">
                        <div class="panel-heading" style="background-color: #05836D; color: #f8f8f8">
                            <h1 class='text-center'>Create New Plan</h1>
                        </div>
                        <div class="panel-body">
                            <form action="plan_details_page.php" method="post">
                                <div class='form-group'>
                                    <label for="email">Initial Budget</label>
                                    <input type="int" id="email" class="form-control" name='budget' placeholder='Initial Budget (Ex. 4000)' required="true">
                                    <?php //this displays an error when one does not enter a positive number.
                                        if(isset($_GET['error1'])){ ?>
                                            <div class="form-control"> 
                                                <?php echo $_GET['error1']; ?>
                                            </div>
                                    <?php
                                    } ?>
                                </div>
                                <div class='form-group'>
                                    <label for="no_of_people">How many peoples you want to add in your group?</label>
                                    <input type="int" id="no_of_people" class="form-control" name='no_of_people' placeholder='No. of people' required="true">
                                    <?php //this displays an error when one does not enter a positive number.
                                        if(isset($_GET['error2'])){ ?>
                                            <div class="form-control"> 
                                                <?php echo $_GET['error2']; ?>
                                            </div>
                                    <?php
                                    } ?>
                                </div>
                                <input id="i" type='Submit' value="Next" class="btn btn-default btn-block ">   
                            </form>                                                       
                        </div>
                     
                    </div>                   
                </div>                
            </div>            
        </div>
        
        <?php
        include'includes/footer.php' 
            ?>
    </body>
</html>
<?php
}
?>



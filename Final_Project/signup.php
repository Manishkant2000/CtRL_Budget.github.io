<?php
require 'includes/common.php';     //connect to the database and start the session if it is not already started
if(isset($_SESSION['email'])){      //if session is set then move to home page
    header('location:home.php');
}
else{
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
            include 'includes/header.php';
        ?>
        
        <div class="container-fluid" style="margin-top:75px; margin-bottom: 75px">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 style="text-align: center;">SIGN UP</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="signup_script.php">
                                <div class="form-group">
                                    <label for="name" >Name:</label>
                                    <input class="form-control" id="name" type="text" name="name" placeholder="Name" required="true" >
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input class="form-control" id="email" type="email" name="email" placeholder="Enter Valid Email" required="true" >

                                    <?php if(isset($_GET['email_error1'])){ //This displays an error when invalid input is given.?>
                                        <div class="form-control"> 
                                            <?php echo $_GET['email_error1']; ?>
                                        </div>
                                    <?php } 
                                    elseif (isset ($_GET['email_error2'])) {  //This displays an error if the input email is already registered. ?>
                                        <div class="form-control"> 
                                            <?php echo $_GET['email_error2']; ?>
                                        </div>
                                    <?php  } ?>

                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input class="form-control" id="password" type="password" name="password" placeholder="Password (Min. 6 characters)" required="true" >
                                    <?php if(isset($_GET['password_error'])){ //display an error if length of input password is less than 6. ?>
                                        <div class="form-control"> 
                                            <?php echo $_GET['password_error']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number:</label>
                                    <input class="form-control" id="phone" type="int" name="phone" placeholder="Enter Valid Phone Number (Ex: 8448444853)" required="true" >
                                    <?php if(isset($_GET['phone_error1'])){ //This displays an error if the input value is not numeric. ?>
                                       <div class="form-control"> 
                                           <?php echo $_GET['phone_error1']; ?>
                                       </div>
                                    <?php }
                                    else if(isset($_GET['phone_error2'])){ // This displays an error if the length of input value is not 10. ?>
                                       <div class="form-control"> 
                                           <?php echo $_GET['phone_error2']; ?>
                                       </div>
                                    <?php } ?>
                                </div>

                                <input type="Submit" value="Sign Up" class="btn btn-primary btn-block">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            include 'includes/footer.php';
        ?>
    </body>
</html>
<?php
}
?>



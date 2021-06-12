<?php
require 'includes/common.php';
if(!isset($_SESSION['email'])){
    header('location:index.php');
}

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
        require 'includes/header.php';
        ?>
        
        <div class="container-fluid" style="margin-top: 75px; margin-bottom: 75px;">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-xs-12 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 style="text-align: center" >Change Password</h3>
                        </div>
                        <div class="panel-body">
                            <form action="change_password_script.php" method="post">        
                                <div class="form-group">
                                        <label for="old_password">Old Password</label>
                                        <input type="password" id="old_password" class="form-control" name="old_password" placeholder="Old Password">
                                        <?php //error1 is displayed if this password does not match with the password in the database
                                            if(isset($_GET['error1'])){ ?>          
                                        <div>
                                        <?php echo $_GET['error1'] ; ?> 
                                        </div>
                                        <?php
                                            }
                                        ?>    
                                </div>
                                <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="text" id="new_password" class="form-control" name="new_password" placeholder="New Password (Min. 6 characters)">
                                        <?php //error2 is displayed if it contains less than 6 characters
                                            if(isset($_GET['error2'])){ ?>     
                                        <div>
                                        <?php echo $_GET['error2'] ; ?> 
                                        </div>
                                        <?php
                                            }
                                        ?>    
                                </div>
                                <div class="form-group">
                                        <label for="re-type_new_password">Confirm New Password</label>
                                        <input type="text" id="re-type_new_password" class="form-control" name="re-type_new_password" placeholder="Re-type New Password">
                                        
                                        <?php //error3 is displayed if this re-typed new password does not match with the above entered new password
                                            if(isset($_GET['error3'])){ ?>   
                                        <div>
                                        <?php echo $_GET['error3'] ; ?> 
                                        </div>
                                        <?php
                                            }
                                        ?>                         
                                        </div>
                                <input type="Submit" value="Change" class="btn btn-primary">
                            </form>                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <?php
        require 'includes/footer.php';
        ?>
    </body>
</html>

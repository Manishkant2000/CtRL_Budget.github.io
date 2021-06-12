<?php
require 'includes/common.php';
if(!isset($_SESSION['email'])){
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
        include 'includes/header.php'; ?>
        
        <div class="container-fluid" style='margin-top: 75px; margin-bottom: 75px'>           
            <div class="row">                
                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h1 class='text-center'>LOGIN</h1>
                        </div>
                        <div class="panel-body">
                            <form action="login_submit.php" method="post">
                                <div class='form-group'>
                                    <label>Email:</label>
                                    <input type="email" class="form-control" name='email' placeholder='Email' required="true">
                                    <?php //This error is displayed when input email is invalid.
                                    if(isset($_GET['email_error1'])){  ?> 
                                        <div>
                                          <?php echo $_GET['email_error1'] ; ?>
                                        </div> 
                                    <?php
                                    }
                                    else if(isset($_GET['email_error2'])){ //This displays an error when this email has not been registered earlier. ?> 
                                        <div>
                                          <?php echo $_GET['email_error2'] ; ?>
                                        </div> 
                                    <?php
                                    }
                                    ?>   
                                    
                                </div>
                                <div class='form-group'>
                                    <label>Password:</label>
                                    <input type="password" class="form-control" name='password' placeholder='Password' required="true">
                                    <?php if(isset($_GET['error3'])){ //Shows error when length of the password is less than 6.  ?>
                                    <div>
                                        <?php
                                      echo $_GET['error3'] ;  ?>
                                    </div>
                                    <?php
                                    }
                                    ?>    
                                </div>
                                <input type='Submit' value="Login" class="btn btn-primary btn-block ">   
                            </form>                                                       
                        </div>
                        <div class="panel-footer">
                            Don't have an account? <a href='signup.php'>Register</a>
                        </div>
                    </div>                   
                </div>                
            </div>            
        </div>
        
        <?php
        include'includes/footer.php' ?>
    </body>
</html>
<?php
}
?>

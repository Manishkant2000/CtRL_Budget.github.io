<?php
require 'includes/common.php';
if(!isset($_SESSION['email'])){
    header('location:index.php');
}
else{
    if($_POST['budget']<=0){
       header('location:create_new_plan.php?error1=Please Enter Positive Number'); 
    }
    else if($_POST['no_of_people']<=0){
      header('location:create_new_plan.php?error2=Please Enter Positive Number'); 
    }
    else{
    $budget=$_POST['budget']; 
    $no_of_people=$_POST['no_of_people'];   
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
        
        <div class="container" style='margin-top: 75px;margin-bottom: 75px;'>           
            <div class="row">                
                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        
                        <div class="panel-body">
                            <form action="plan_details_script.php?budget=<?php echo "$budget" ?>&&no_of_people=<?php echo "$no_of_people" ?>" method="post">
                                <div class='form-group'>
                                    <label for="title">Title</label>
                                    <input type="text" id="title" class="form-control" name='title' placeholder='Enter Title (Ex. Trip to Goa)' required="true">
                                </div>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class='form-group'>
                                            <label for="from">From</label>
                                            <input type="date" id="from" class="form-control" min="2000-01-01" max="2099-12-31" name='from' placeholder='dd/mm/yyyy' required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class='form-group'>
                                            <label for="to">To</label>
                                            <input type="date" id="to" class="form-control" min="2020-06-16" max="2040-01-01" name='to' placeholder='dd/mm/yyyy' required="true">
                                        </div>
                                    </div>
                                </div>
                                <?php if(isset($_GET['error'])){ //display an error if ending date (to) is less than starting date (from).
                                    ?>
                                       <div class="form-group"> 
                                           <?php echo $_GET['error']; ?>
                                       </div>
                                <?php
                                }
                                ?>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class='form-group'>
                                            <label for="budget">Initial Budget</label>
                                            <input type="int" id="budget" class="form-control" name='budget' value="<?php echo $budget ?>" disabled="true" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class='form-group'>
                                            <label>No. of People</label>
                                            <input type="int" class="form-control" name='no_of_people' value="<?php echo $no_of_people ?>" disabled="true">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $i=0;
                                while($i<$no_of_people){    //This iterates to display the option for filling the name of all the persons involved in the plan. 
                                    $i+=1;
                                    $v= strval($i);
                                    ?>
                                    <div class='form-group'>
                                        <label >Person <?php echo $i ?></label>
                                        <input type="text" class="form-control" name="<?php echo $v ?>" placeholder="Person <?php echo $i ?> Name" required="true">
                                    </div>
                                <?php
                                }
                                ?>
                               <input type='Submit' value="Submit" class="btn btn-default  btn-block ">   
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
}
?>


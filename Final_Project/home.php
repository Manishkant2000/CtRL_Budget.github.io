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
            #icon{
                position: fixed;
                left: 0;
                margin-top: 10px;
                bottom:60px;
                width:100%;
            }
        </style>
    </head>
    <body>
        <?php
        include 'includes/header.php';
        ?>
        
        <?php
        $user_id=$_SESSION['id'];
        $select_query="SELECT * FROM plans WHERE plans.user_id=$user_id ;";  //This selects all the plans corresponding to a particular user from the 'plans' table.
        $select_query_result=mysqli_query($con, $select_query) 
                or die(mysqli_error($con));
        $n_rows=mysqli_num_rows($select_query_result);
        if($n_rows==0){     //it implies that no plan has been added by the user 
            ?>
            <div class="container" style="margin-top: 100px; margin-bottom: 100px;">
                <h4>You don't have any active plans</h4>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 jumbotron">
                        <center>
                        <a href="create_new_plan.php" style="font-size: 25px"><span class="glyphicon glyphicon-plus-sign"></span>Create a New Plan</a>
                        </center>
                    </div>
                </div>
            </div>
        <?php 
        }
        else{
            ?>
            <div class="container" style="margin-top: 100px; margin-bottom: 75px;">
                <h3>Your Plans</h3>  
                <div class="row">
                    <?php
                    while ($row = mysqli_fetch_array($select_query_result)) {  //This loop iterates to show all the plans corresponding to a user.
                        $plan_id=$row['id'];    //it stores the unique id corresponding to a plan
                        $title=$row['title'];   //it stores the title of the plan
                        $from=$row['start'];    //it stores the starting date of the plan
                        $from= date_create($from);
                        $from= date_format($from, 'jS M Y');  //date has been converted to another form
                        $to=$row['end'];  //it stores the ending date of the plan
                        $to= date_create($to);
                        $to= date_format($to, 'jS M Y');   //date has been converted to another form
                        $budget=$row['budget'];         //it stores the budget of the plan
                        $no_of_people=$row['no_of_people']; //it stores the number of the people corresponding to a plan

                        ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class='panel panel-info'>
                            <div class="panel-heading" style="background-color: #05836D; color: #f8f8f8">
                                <div class="row">
                                    <div style="text-align: center" class="col-xs-10 col-sm-8">
                                        <h4><?php echo $title ?></h4>
                                    </div>
                                    <div class="col-xs-2 col-sm-4">
                                        <h4 style="float: right" ><span class="glyphicon glyphicon-user"></span><?php echo $no_of_people ?><h4>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <strong>Budget</strong>
                                    <p style="float:right">₹ <?php echo $budget ?></p>
                                </div>
                                <div class="form-group">
                                    <strong>Date</strong>
                                    <p style="float:right;" ><?php echo $from." - ".$to ?> </p>
                                </div>
                                <div class="form-group" >
                                    <a href="view_plan.php?plan_id=<?php echo $plan_id ?>"><button style="color:#05836D; border-color:#05836D;" class="btn btn-block btn-default" >View Plan</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div id="icon" class="row">  
                    <!-- This div displays a plus sign on the right which takes to a page to create new plan and, it is fixed in this part as per instructions in the problem statement -->
                    <a href="create_new_plan.php" style="float: right; font-size: 40px; color: #05836D"><span class="glyphicon glyphicon-plus-sign"></span></a>   
                </div>
            </div>
        <?php
        } 
        ?>
        
        <?php
        include 'includes/footer.php';
        ?>
    </body>
</html>
<?php
}
?>

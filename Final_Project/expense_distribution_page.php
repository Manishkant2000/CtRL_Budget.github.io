<?php
require 'includes/common.php';
if(!isset($_SESSION['email'])){
    header('location:index.php');
}
else{
    $user_id=$_SESSION['id'];
    $plan_id=$_GET['plan_id'];
       
    $select_query="SELECT title, budget, no_of_people FROM plans WHERE plans.user_id=$user_id AND plans.id=$plan_id ;";
    $select_query_result=mysqli_query($con, $select_query) 
            or die(mysqli_error($con));
    $plan= mysqli_fetch_array($select_query_result);
    
    $title=$plan['title'];  //stores the title of the plan
    $budget=$plan['budget'];  //stores the budget in the plan
    $no_of_people=$plan['no_of_people'];  //stores the number of the people involved in the plan
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
        
        <div class="container" style="margin-top: 75px; margin-bottom: 75px">
            <div class="panel panel-info">
                <div class="panel-heading" style="background-color: #05836D; color: #f8f8f8">
                    <div class="row">
                        <div style="text-align: center" class="col-xs-10">
                            <h4><?php echo $title ?></h4>
                        </div>
                        <div class="col-xs-2">
                            <h4 style="float: right" ><span class="glyphicon glyphicon-user"></span><?php echo $no_of_people ?><h4>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                            <strong>Initial Budget</strong>
                            <p style="float:right">₹ <?php echo $budget ?></p>
                    </div>
                    
                    <?php
                    $select_query0="SELECT name FROM person WHERE person.user_id=$user_id and person.plan_id=$plan_id;";    //It selects the name of the persons corresponding to a plan
                    $select_query_result0= mysqli_query($con, $select_query0)      
                            or die(mysqli_error($con));
                    
                    $total_expense=0;    //Total expense by all persons
                    while($row=mysqli_fetch_array($select_query_result0)){  //This loops to display the persons related to this plan and their total expenses in this plan.
                        $name=$row['name'];  
                        
                        $select_query1="SELECT amount FROM expense WHERE expense.user_id=$user_id and expense.plan_id=$plan_id and expense.person='$name';";
                        //this selects the amount from the expense table corresponding to a particular plan and expense identified with their unique id
                        $select_query_result1= mysqli_query($con, $select_query1)
                            or die(mysqli_error($con));
                        $expense=0;  //Individual total expense
                        
                        $no_of_row= mysqli_num_rows($select_query_result1); //It means no amount has been spent by this person
                        if($no_of_row==0){ 
                            $expense=0;
                        }
                        else{
                            while($nrow=mysqli_fetch_array($select_query_result1)){  //This loop adds all the expenses by a particular person in a particular plan
                                $exp=$nrow['amount'];
                                $expense+=$exp;
                                $total_expense+=$exp;
                            }
                        }
                    ?>
                        <!--  This div displays a particular person name and his expenses. It iterates for all the persons related to a plan.    -->   
                        <div class="form-group">
                            <strong><?php echo $name ?></strong>
                            <p style="float:right">₹ <?php echo $expense ?></p>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- This displays the total amount spent in the plan by all. -->
                    <div class="form-group"> 
                        <strong>Total amount spent</strong>
                            <p style="float:right">₹ <?php echo $total_expense ?></p>
                    </div>
                    <?php
                    $remaining_amount=$budget-$total_expense;
                    //This calculates the remaining amount and shows a message in different color depending on the amount being positive, negative and zero.
                    if($remaining_amount==0){
                    ?>
                        <div class="form-group">
                            <strong>Remaining Amount</strong>
                                <p style="float:right; color: #000000">₹ <?php echo $remaining_amount ?></p>
                        </div>
                    
                    <?php
                        }
                    elseif ($remaining_amount<0) {
                    ?>
                        <div class="form-group">
                            <strong>Remaining Amount</strong>
                            <p style="float:right; color:#FF0000 ">₹ <?php echo $remaining_amount ?></p>
                        </div>        
                    <?php
                        }
                    elseif ($remaining_amount>0) {
                    ?>
                        <div class="form-group">
                            <strong>Remaining Amount</strong>
                                <p style="float:right; color:#008000 ">₹ <?php echo $remaining_amount ?></p>
                        </div>
                    <?php
                        } 
                    //This displays the individual share of the people as defined in the project problem statement.   
                    $individual_shares=$total_expense/$no_of_people;
                    ?>
                    <div class="form-group">
                        <strong>Individual Shares</strong>
                         <p style="float:right">₹ <?php echo $individual_shares ?></p>
                    </div>
                    
                    <?php
                    $select_query2="SELECT name FROM person WHERE person.user_id=$user_id and person.plan_id=$plan_id;";   //It selects the name of the persons corresponding to a plan
                    $select_query_result2= mysqli_query($con, $select_query2)
                            or die(mysqli_error($con));
                    
                    while($row=mysqli_fetch_array($select_query_result2)){   //This loop iterates for all the persons in this plan and show thier conditions on whether they have paid more, equal or less than individual shares.
                        $name=$row['name'];
                        
                        $select_query3="SELECT amount FRom expense WHERE expense.user_id=$user_id and expense.plan_id=$plan_id and expense.person='$name';";
                        $select_query_result3= mysqli_query($con, $select_query3)
                            or die(mysqli_error($con));
                        $total_expense_by_this_person=0; //Individual Total Expenses
                        
                        $no_of_row= mysqli_num_rows($select_query_result3);
                        if($no_of_row==0){  //It means that no amount has been paid by this person 
                            $total_expense_by_this_person=0;  //Expense by this person is 0.
                        }
                        else{
                            while($nrow=mysqli_fetch_array($select_query_result3)){ //It means that some amount has been paid by this person 
                                $exp=$nrow['amount'];
                                $total_expense_by_this_person+=$exp;
                            }
                        }
                        
                        $amount_to_be_paid_by_this_person=$total_expense_by_this_person-$individual_shares;
                        $message;
                        if($amount_to_be_paid_by_this_person==0){
                            $message='All settled up';
                        ?>
                            <div class="form-group">
                                <strong><?php echo $name ?></strong>
                                <p style="float:right; color: #000000"><?php echo $message ?></p>
                            </div>
                    
                        <?php
                        }
                        elseif ($amount_to_be_paid_by_this_person<0) {
                            $amount_to_be_paid_by_this_person=abs($amount_to_be_paid_by_this_person);
                            $message="Owes ₹ $amount_to_be_paid_by_this_person";
                        ?>
                            <div class="form-group">
                                <strong><?php echo $name ?></strong>
                                <p style="float:right; color:#FF0000 "><?php echo $message ?></p>
                            </div>
                        <?php
                        }
                        elseif ($amount_to_be_paid_by_this_person>0) {
                            $message="Gets back ₹ $amount_to_be_paid_by_this_person";
                        ?>
                            <div class="form-group">
                                <strong><?php echo $name ?></strong>
                                <p style="float:right; color:#008000 "><?php echo $message ?></p>
                            </div>
                        <?php
                        }
                    }
                    ?>
                    <div class="form-group">
                        <center>
                            <a href="view_plan.php?plan_id=<?php echo $plan_id ?>" class="btn btn-info" ><span class="glyphicon glyphicon-arrow-left"></span> Go back</a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
        require 'includes/footer.php';
        ?>
    </body>
</html>
<?php
}
?>
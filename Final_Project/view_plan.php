<?php
require 'includes/common.php';

if(!isset($_SESSION['email'])){
    header('location:index.php');
}
else{
    $user_id=$_SESSION['id'];
    $plan_id=$_GET['plan_id'];
                 
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
        include 'includes/header.php';
        ?>
        
        <div class="container" style="margin-top:100px; margin-bottom: 50px;">  <!-- This div displays the plan details -->
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-8">

                    <?php
                    $select_query="SELECT * FROM plans WHERE plans.id=$plan_id ;"; //It selects all the details of the plan with unique plan_id.
                    $select_query_result=mysqli_query($con, $select_query) 
                            or die(mysqli_error($con));

                    $plan= mysqli_fetch_array($select_query_result);
                    $title=$plan['title'];   //stores the title of the plan
                    $budget=$plan['budget'];  //stores the budget of the plan
                    $from=$plan['start'];       //stores the starting date of the plan
                    $from= date_create($from);
                    $from= date_format($from, 'jS M Y');  //This convert the date in the specific format as it was shown in the project problem statement.
                    $to=$plan['end'];       //stores the ending date if the plan.
                    $to= date_create($to);
                    $to= date_format($to, 'jS M Y');
                    $no_of_people=$plan['no_of_people'];  //stores the number of the people in the plan.


                    $expenses=0;
                    $select_query1="SELECT amount FROM expense WHERE expense.user_id=$user_id AND expense.id=$plan_id ;"; // This select the amount of the expenses corresponding to a particular plan.
                    $select_query_result1=mysqli_query($con, $select_query1) 
                        or die(mysqli_error($con));

                    while ($row = mysqli_fetch_array($select_query_result1)) { //this loop gives the total amount of the expense in the plan.
                        $amount=$row['amount'];
                        $expenses+=$amount;
                    }

                    $remaining_amount=$budget-$expenses;   //calculate the total remaining amount in the plan

                    ?>
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
                            <?php
                            if($remaining_amount==0){
                                //to display the remaining amount in black color.
                            ?>
                                <div class="form-group">
                                    <strong>Remaining Amount</strong>
                                        <p style="float:right; color: #000000">₹ <?php echo $remaining_amount ?></p>
                                </div>

                            <?php
                                }
                            elseif ($remaining_amount<0) {
                                //to display remaining amount in red color.
                            ?>
                                <div class="form-group">
                                    <strong>Remaining Amount</strong>
                                    <p style="float:right; color:#FF0000 ">₹ <?php echo $remaining_amount ?></p>
                                </div>        
                            <?php
                                }
                            elseif ($remaining_amount>0) {
                                //to display remaining amount in green color.
                            ?>
                                <div class="form-group">
                                    <strong>Remaining Amount</strong>
                                        <p style="float:right; color:#008000 ">₹ <?php echo $remaining_amount ?></p>
                                </div>
                            <?php
                                } 
                            ?>
                            <div class="form-group">
                                <strong>Date</strong>
                                <p style="float:right;" ><?php echo $from." - ".$to ?> </p>
                            </div>
                        </div>        
                    </div>
                </div>               
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <center class="jumbotron">
                    <a href="expense_distribution_page.php?plan_id=<?php echo $plan_id ?>" class="btn btn-default">Expense Distribution</a>
                    </center>
                </div>
            </div>
        </div>
        <div class="container" style="margin-bottom:75px;">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-8">
                    <div class="row">
                    <?php
                    $select_query2="SELECT * FROM expense WHERE expense.user_id=$user_id AND expense.plan_id=$plan_id ;";
                    $select_query_result2=mysqli_query($con, $select_query2) 
                        or die(mysqli_error($con));

                    while ($row = mysqli_fetch_array($select_query_result2)) {   //It iterates to display all the expenses corresponding to a plan.
                        $title=$row['name'];   //stores the title of the expense.
                        $amount=$row['amount'];  //stores the amount spent in an expense
                        $paid_by=$row['person'];  //stores the name of person who has paid the amount.
                        $paid_on=$row['date'];   //the the date of expense.
                        $paid_on= date_create($paid_on);
                        $paid_on= date_format($paid_on, 'jS M Y');
                        $bill=$row['bill'];  //stores the billing condition of the expense i.e. either there is a bill uploaded or not.
                        ?>
                    
                        <div class="col-xs-12 col-md-4 col-sm-6 ">
                            <div class='panel panel-info'>
                                <div class="panel-heading" style="background-color: #05836D; color: #f8f8f8">
                                    <h4 style="text-align:center;"><?php echo $title ?></h4>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <strong>Amount</strong>
                                        <p style="float:right">₹ <?php echo $amount ?></p>
                                    </div>
                                    <div class="form-group">
                                        <strong>Paid by</strong>
                                        <p style="float:right"><?php echo $paid_by ?></p>
                                    </div>
                                    <div class="form-group">
                                        <strong>Paid on</strong>
                                        <p style="float:right;" ><?php echo $paid_on ?> </p>
                                    </div>
                                    <div class="form-group">

                                        <?php 
                                        if($bill==NULL){  ?>
                                            <center style="color:blue">
                                                <p>You don't have bill</p>
                                            </center>
                                        <?php
                                        }
                                        else{  ?>
                                            <center style="color:blue">
                                                <a href="show_bill_script.php?plan_id=<?php echo $plan_id ?>&&bill=<?php echo $bill ?>">Show Bill</a>
                                            </center>
                                        <?php
                                        }
                                        ?> 
                                    </div>
                                </div> 
                            </div>
                        </div>
                    <?php
                    }
                        ?>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <!-- This div contains ADD NEW EXPENSE FORM. -->
                    <div class="panel panel-info">
                        <div class="panel-heading" style="background-color: #05836D; color: #f8f8f8">
                            <h1 class='text-center'>Add New Expense</h1>
                        </div>
                        <div class="panel-body">
                            <form action="add_new_expense_script.php?plan_id=<?php echo $plan_id ?>" method="post" enctype="multipart/form-data">
                                <div class='form-group'>
                                    <label for="title">Title</label>
                                    <input type="text" id="title" class="form-control" name='title' placeholder='Expense name' required="true">
                                </div>
                                <div class='form-group'>
                                    <label for="date">Date</label>
                                    <input type="date" id="date" class="form-control" name='paid_on' required="true">
                                    <?php if(isset($_GET['error1'])){ // display an error when the date given by user is beyond the duration of the plan.?>
                                       <div> 
                                           <?php echo $_GET['error1']; ?>
                                       </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class='form-group'>
                                    <label for="amount">Amount</label>
                                    <input type="int" id="amount" class="form-control" name='paid_amount' placeholder="Amount Spent" required="true">
                                    <?php if(isset($_GET['error2'])){ //display an error if amount entered by the user is not positive. ?>
                                       <div> 
                                           <?php echo $_GET['error2']; ?>
                                       </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                    $select_query1="SELECT name FROM person WHERE person.user_id=$user_id AND person.plan_id=$plan_id ;"; //select the name of all person involved in this plan.
                                    $select_query_result1=mysqli_query($con, $select_query1) 
                                            or die(mysqli_error($con));
                                ?>
                                <div class='form-group'>
                                    <select class="form-control" name="paid_by">
                                        <?php
                                        while ($row = mysqli_fetch_array($select_query_result1)) {   //this iterates to show a dropdown containing name of all the person so that one can choose one from all the options.
                                            $person=$row['name'];
                                        ?>
                                        <option><?php echo $person ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class='form-group'>
                                    <label for="file">Upload Bill</label>
                                    <input type="file" id="file" class="form-control" name='file'>
                                </div>
                                <input id="i" type='submit' name="submit" value="Add" class="btn btn-default btn-block ">   
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

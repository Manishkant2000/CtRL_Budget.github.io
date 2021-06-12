<?php
include 'includes/common.php';
$user_id=$_SESSION['id'];

$title=$_POST['title'];
$budget=$_GET['budget'];
$no_of_people=$_GET['no_of_people'];
$from=$_POST['from'];  //store strating date of the plan
$to=$_POST['to'];   //store last date of the plan

if($from>$to){  //it displays an error if starting date is greater than ending date of the plan
    header('location:plan_details_page.php?error=Starting day should be less than ending day of the plan');
}
else{
    $insert_query="INSERT INTO plans (title, start, end, budget, no_of_people, user_id) VALUES ('$title','$from','$to','$budget','$no_of_people','$user_id');  ";
    $insert_query_result= mysqli_query($con, $insert_query)
            or die(mysqli_error($con));

    $plan_id= mysqli_insert_id($con);  //id of recently added plan

    $i=0;
    while($i<$no_of_people){
        $i+=1;
        $v= strval($i);
        $name=$_POST[$v];  
        $insert_query="INSERT INTO person (name,user_id,plan_id) VALUES ('$name','$user_id','$plan_id');  ";   //insert the persons relatedto this plan in the person database.
        $insert_query_result= mysqli_query($con, $insert_query)
            or die(mysqli_error($con));
    }
    header('location:home.php');
}
?>
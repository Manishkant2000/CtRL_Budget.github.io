<?php
require 'includes/common.php';

$title= mysqli_real_escape_string($con, $_POST['title']);   //store the title of the expense
$paid_on=mysqli_real_escape_string($con, $_POST['paid_on']);  //store the date on which amount has been paid
$paid_amount=mysqli_real_escape_string($con, $_POST['paid_amount']); //store the amount which has been paid
$paid_by=$_POST['paid_by'];   //store the person's name by which amount has been paid

$user_id=$_SESSION['id'];   //get the user_id from the session
$plan_id=$_GET['plan_id'];  //store the plan_id as it has been sent through url

$select_query="SELECT start,end from plans where user_id=$user_id and id=$plan_id";
$select_query_result= mysqli_query($con, $select_query)
        or die(mysqli_error($con));

$rows= mysqli_fetch_array($select_query_result);
$from=$rows['start'];   //it stores the starting date of this plan 
$to=$rows['end'];       //it stores the end date of this plan

if($paid_on<$from || $paid_on>$to){   //It displays an error if date entered by the user is not in between the starting and ending date of the plan.
    header("location:view_plan.php?plan_id=$plan_id&&error1=Date entered by you is beyond the duration of the plan! ");
}
else{
    if($paid_amount<0){  //if paid amount is negative then it displays an error.
        header("location:view_plan.php?plan_id=$plan_id&&error2=Please enter the positive amount! ");
    }
    else{
        function GetImageExtension($imagetype){
            if(empty($imagetype))        return false;
            switch($imagetype){
                case 'image/bmp' : return '.bmp';
                case 'image/gif' : return '.gif';
                case 'image/jpeg' : return '.jpeg';
                case 'image/png' : return '.png';
                default : return false;
            }
        }

        if(!empty($_FILES["file"]["name"])){    //if bill has been uploaded then only go through this.
            $file_name=$_FILES["file"]["name"];
            $temp_name=$_FILES["file"]["tmp_name"];
            $imgtype=$_FILES["file"]["type"];
            $ext= GetImageExtension($imgtype);
            $imagename=date("d-m-y")."-".time().$ext;
            $target_path="img/".$imagename;

            if(move_uploaded_file($temp_name, $target_path)){
                    $insert_query="INSERT INTO expense (name, date, amount, person, bill, user_id, plan_id) VALUES ('$title', '$paid_on', '$paid_amount', '$paid_by', '$target_path', '$user_id', '$plan_id' );";
                    $insert_query_result=mysqli_query($con,$insert_query)
                    or die(mysqli_error($con));
                    header("location:view_plan.php?plan_id=$plan_id");
             }    
        }
        else{   //expense is added to database if no bill has been has been uploaded.
            $insert_query="INSERT INTO expense (name, date, amount, person, user_id, plan_id) VALUES ('$title', '$paid_on', '$paid_amount', '$paid_by', '$user_id', '$plan_id' );";
            $insert_query_result=mysqli_query($con,$insert_query)
                    or die(mysqli_error($con));     
            header("location:view_plan.php?plan_id=$plan_id");
        } 
    }
}
?>
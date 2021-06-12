<?php
require 'includes/common.php';
//backend validations
$user_id=$_SESSION['id'];   //user id f the current user

$old_password=$_POST['old_password'];  //store the old password entered by user
$new_password=$_POST['new_password'];  //store new password entered by the user
$old_password= md5($old_password);  //encrypt the password using md5 algorithm

$select_query="SELECT password FROM users WHERE id='$user_id';";   //select the current password of the user from database using user_id
$select_query_result= mysqli_query($con, $select_query)
        or die(mysqli_error($con));
$rows= mysqli_fetch_array($select_query_result);
$password=$rows['password'];      //store the current password of user

if($password!=$old_password){     //password from database and password from user's input are not matched so display an error.
    header('location:change_password.php?error1=Wrong password! Please Enter Correct Old Password!');
}
else{
    if(strlen($new_password)<6){   //if new password has less then 6 characters  then displays an error
        header('location:change_password.php?error2=Password should have at-least 6 characters');
    }
    else{
        $re_new_password=$_POST['re-type_new_password'];   //store the re-typed new password 
        if($new_password!=$re_new_password){   //if new password and re-typed new password do not match 
            header('location:change_password.php?error3=RE TYPE NEW PASSWORD ');
        }
        else{
            $new_password= md5($new_password); 
            $new_password= mysqli_real_escape_string($con, $new_password);
            $update_query="UPDATE users SET password='$new_password' where users.id=$user_id; ";   //update the password in the database
            $update_query_result= mysqli_query($con, $update_query)
                    or die(mysqli_error($con));

            header('location:index.php');   //direct to index page
        }
    }
}
?>

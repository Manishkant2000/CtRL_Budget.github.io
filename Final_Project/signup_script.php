<?php
require 'includes/common.php';  

$name= mysqli_real_escape_string($con, $_POST['name']);   //store the name entered by the user the form
$email=mysqli_real_escape_string($con, $_POST['email']);   //store the email entered by the form
$password =$_POST['password'];  //store the password entered by the user
$phone=$_POST['phone'];    //store the phone number entered by the user
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";  //pattern for email which contains at least one @ and one dot(.)
if (!preg_match($regex_email, $email)) {       
  header('location:signup.php?email_error1=Enter Valid Email');    
}
else{
    $select_query="SELECT email FROM users WHERE email='$email' ";      //select the email from database with the given email
    $select_query_result= mysqli_query($con, $select_query)
            or die(mysqli_error($con));
    $no_of_rows= mysqli_num_rows($select_query_result);
   
    if($no_of_rows>0){    //This implies that this email has already been registered
        header('location:signup.php?email_error2=Email Already Exists!');
    }
    else{
        if (strlen($password) < 6) {    //if the length of password is less then 6 then it displays an error
            echo strlen($password).'<br>';
            header('location:signup.php?password_error=Password should have at-least 6 characters');
        }
        else{
            $password=md5($password);   //encrypt the password using md5 algorithm
            
            if(!is_numeric($phone)){    //if the values entered as phone number are not numeric then it displays an error
                header('location:signup.php?phone_error1=Please enter only digit values');
            }
            else if(strlen($phone)!=10){   //if the length of phone number entered by the user i sless than 10 then it displays an error
                header('location:signup.php?phone_error2=Enter Valid 10-digit Mobile Number');
            }
            else{

                $password= mysqli_escape_string($con, $password);
                $phone= mysqli_escape_string($con, $phone);

                $insert_query="INSERT INTO users (name,email,password,phone) values ('$name','$email','$password',$phone)";  //inserting phone, email, password, phone in the database
                $insert_query_result=mysqli_query($con,$insert_query) 
                            or die(mysqli_error($con));
                
                $id= mysqli_insert_id($con);   //insert id of newly inserted user
                //start the session variables
                $_SESSION['id']=$id;
                $_SESSION['email']=$email;

                header('location:home.php');
            }
        }
    }
}
?>
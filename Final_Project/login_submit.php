<?php
require 'includes/common.php';  

$email= mysqli_real_escape_string($con,$_POST['email']);    //store email from the form input and also using basic security function
$password = $_POST['password'];   //store the password entered by the user

//Backend Validations
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";  //pattern for email which contains at least one @ and one dot(.)
if (!preg_match($regex_email, $email)) {       
  header('location:signup.php?email_error1=Enter Valid Email');    
}
else{
    $select_query="SELECT email FROM users WHERE email='$email' ";  //Select email from the 'users' table of the database which has the email as the input given.
    $select_query_result= mysqli_query($con, $select_query)
            or die(mysqli_error($con));
    $no_of_rows= mysqli_num_rows($select_query_result);   

    if($no_of_rows==0){    //This implies that this email has already been registered; therefore displays an error
        header('location:login.php?email_error2=Email not registered! Please Sign up.');
    }
    else{
        $password=md5($password);   //encrypt the entered password

        $select_query="SELECT id,password FROM users WHERE email='$email'";  //select the password from the database with this registered email
        $select_query_result=mysqli_query($con,$select_query)
                or die(mysqli_error($con));

        $rows= mysqli_fetch_array($select_query_result);
        $main_password=$rows['password'];
        $id=$rows['id'];    //store id 

        if($main_password!=$password){
            header('location:login.php?error3=Wrong Password! Enter Correct Password.');
        }
        else{
            $_SESSION['id']=$id;
            $_SESSION['email']=$email;
            header('location:home.php');
        }
    }
}
?>

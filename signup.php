<!DOCTYPE html>
<?php
include 'connection.php';
if(isset($_POST['signup_btn'])){
    $username=mysqli_real_escape_string($con,$_POST['username']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $password=mysqli_real_escape_string($con,$_POST['password']);
    $confirmpassword=mysqli_real_escape_string($con,$_POST['confirmpassword']);
    if(empty($username)){
        $error="username is required";
    }
    elseif(empty($email)){
        $error="email is required";
    }
    elseif(empty($password)){
        $error="password is required";
    }
    elseif($password != $confirmpassword){
        $error="password does not match";
    }
    elseif(strlen($username)<3 || strlen($username) >30) {
        $error="username must be between 3 to 30 characters required";
    }
    elseif(strlen($password)<6) {
        $error="password must be at least 6 characters";
    }
    else{
        $check_email="SELECT * FROM  `data` WHERE email='$email'";
    $query=mysqli_query($con,$check_email);
    $result=mysqli_fetch_array($query);
    if($result >0){
        $error="Email already exist";
    }
    else{
        $pass=md5($password);
        $insert="INSERT INTO data (username,email,password) values('$username','$email','$password')";
        $q=mysqli_query($con,$insert);
        if($q) {
            $success="Your account created hasa been successfully";
        }
    }
}
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
</head>
<body>
    <center><h1>Contact Form</h1>
    <div class="signup">
        <p style="color:red">
        <?php
        if(isset($error)){
            echo $error;
        }
        ?>
        </p>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Enter UserName"
             value=" <?php 
             if(isset($error)) 
             {
                echo $username;
                 } ?>"><br><br>
            <input type="email" name="email" placeholder="Enter your Email"
            value=" <?php 
             if(isset($error)) 
             {
                echo $email;
                 } ?>"><br><br>
            <input type="password" name="password" placeholder="Enter your password"><br><br>
            <input type="password" name="confirmpassword" placeholder="Confirm password"><br><br>
            <input type="submit" name="signup_btn" value="SignUp"></input>
</form>
</div> 
                </center>   
</body>
</html>
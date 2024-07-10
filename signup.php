<?php
session_start();

include("connection.php");
include("functions.php");


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $email = $_POST['signupEmail'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {

        //save to database
        $user_id = random_num(20);
        $query = "insert into users (user_id,user_name,password,email) values ('$user_id','$user_name','$password','$email')";

        mysqli_query($con, $query);

        header("Location: login.php");
        die;
    }else
    {
        echo "Please enter some valid information!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobil IT login/register</title>
    <link rel="icon" type="image/x-icon" href="assets/favi.png"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <link href="css/styles.css" rel="stylesheet"/>
    
</head>

<body class="login-form"> 
     <!--Sign Up NAV  -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            
        <div class="container">
            
            <a class="navbar-brand" href="index.html"><img src="assets/img/MobilIT/MobilIT5.png" alt="..." /></a>
            
        </div>
        </nav>
<div class="container-login">
<form class="form-login " id="createAccount" action="" method="POST">
        <h1 class="form__title">Create Account</h1>
        <div class="form__message form__message--error"></div>
        <div class="form__input-group">
            <input type="text" id="signupUsername" name="user_name" class="form__input" autofocus placeholder="Username">
            <div class="form__input-error-message"></div>
        </div>
        <div class="form__input-group">
            <input type="text" class="form__input" name="signupEmail" autofocus placeholder="Email Address">
            <div class="form__input-error-message"></div>
        </div>
        <div class="form__input-group">
          <input type="password" class="form__input" name="password" autofocus placeholder="Password">
          <div class="form__input-error-message"></div>
      </div>
      <div class="form__input-group">
        <input type="password" class="form__input" name= autofocus placeholder="Confirm password">
        <div class="form__input-error-message"></div>
    </div>
      <button class="form__button" type="submit">Continue</button>
      
      <p class="form__text">
          <a class="form__link" href="login.php" id="linkLogin">Already have an account? Sign in</a>
       </p>
    </form>
  </div>
  
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
    <script src="/js/scripts.js"></script>

</body>
</html>
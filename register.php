<?php

require_once "config.php";
require_once "session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    
    $user_name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST["confirm_password"]);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    if($result = mysqli_query($db, "SELECT * FROM users WHERE email = '".$email."'")){
        
    // if($query = $db->prepare("SELECT * FROM user WHERE email = ?")) {
        $error = '';
        // bind parameters (s = string, i = int, b = blob,etc)

        // $query->bind_param('s',$email);
        // $query->execute();
        // store the results so we can check if account exists in database.
        // $query->store_result();

            if(mysqli_num_rows($result) > 0){
            // if ($query->num_rows > 0) {
                $error .= '<p class="error">The email address is already registered!</p>';
            } else {
                //Validate password
                if ( strlen($password ) < 3) {
                    $error .= '<p class="error">Password must have at least 3 characters.</p>';
                }

                // Validate confirm password
                if (empty($confirm_password)) {
                    $error .= '<p class="error">Please enter confirm password.</p>';
                } else {
                    if (empty($error) && ($password != $confirm_password)) {
                        $error .= '<p class"error">Password did not match.</p>';
                    }
            } 
            if (empty($error) ) {
                // $insertQuery = $db->prepare("INSERT INTO users (name, email, password) VALUES (?,?,?);");
                // $insertQuery ->bind_param("sss", $user_name, $email, $password_hash);
                // $result = $insertQuery->execute();

                if(mysqli_query($db,"INSERT INTO users (name, email, password) VALUES ('".$user_name."','".$email."','".$password_hash."');")){
                // if ($result) {
                    $error .= '<p class="success">Your registration was successful!</p>';
                } else {
                    $error .= '<p class="error">Something went wrong!</p>';
                }
            }
        }
        echo $error;
    } else {
        echo mysqli_error($db);
    }
    
    // $query->close();
    // $insertQuery->close();
    // // / Close DB connection
    mysqli_close($db);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobil IT Register</title>
    <link rel="icon" type="image/x-icon" href="assets/favi.png"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <link href="css/styles.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
</head>

<body class="login-form"> 
     <!--Sign Up NAV  -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            
        <div class="container">
            
            <a class="navbar-brand" href="index.php"><img src="assets/img/MobilIT/MobilIT_gold.png" alt="..." /></a>
            
        </div>
        </nav>
<div class="container-login">
    <div class="row">
        <div class="col-md-12">
            <h1 class="form__title">Register</h1>
            <!-- <p>Sign up to receive the latest updates via email.</p> -->

        
        
            <form class="form-login" action="" method="post">
                <div class="form-group form__input-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form control form__input" required>
                </div>
                    <div class="form-group form__input-group">
                <div class="form-group ">
                    <label>Email Address</label>
                    <input type="email"  name="email" class="form control form__input" required>
                </div>
                    <div class="form-group form__input-group">
                <div class="form-group ">
                    <label>Password</label>
                    <input type="password" name="password" class="form control form__input" required>
                </div>
                    <div class="form-group form__input-group">
                <div class="form-group ">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form control form__input" required>
                </div>
                    <div class="form-group form__input-group">
                <div class="form-group ">
                    <input type="submit" name="submit" class="form__button" value="submit">
                </div>
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
            </div>
        </div>
    </div>
  
    <!-- <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
    <script src="/js/scripts.js"></script> -->

</body>
</html>

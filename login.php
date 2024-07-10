<?php

require_once "config.php";
require_once "session.php";

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate if email is empty 
    if (empty($email)) {
        $error .= '<p class="error">Please enter email.</p>';
    }

    // Validate if password is empty
    if (empty($password)) {
        $error .= '<p class="error">Please enter your password.</p>';
    }

    if (empty($error)) {
        if($result = mysqli_query($db, "SELECT * FROM users WHERE email = '".$email."'")){
        // if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
            // $query->bind_param('s', $email);
            // $query->execute();
            // $row = $query->fetch();
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_array($result);
            // if ($row) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION["userid"] = $row['id'];
                    $_SESSION["user_name"] = $row['name'];
                    // $SESSION["user"] = $row;

                    // Redirect the user to welcome page
                    header("location: welcome.php");
                    exit;
                } else {
                    $error .= '<p class="error">Invalid password!</p>';
                }
            } else {
                $error .= '<p class="error">Invalid email address!</p>';
            }
        }
        echo $error;
        // $query->close();
    }
    // Close connection
    mysqli_close($db);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobil IT Login</title>
    <link rel="icon" type="image/x-icon" href="assets/favi.png"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <link href="css/styles.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>
    
</head>

<body class="login-form"> 
     <!--LOGIN NAV  -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="assets/img/MobilIT/MobilIT_gold.png" alt="..." /></a>
        </div>
        </nav>
    <!-- LOGIN FORM -->
    <div class="container-login">
        <div class="row">
            <div class="col-md-12">
                <h1 class="form__title">Login</h1>
                
                <form class="form-login" id="login" action="" method="post">
                    <div class="form-group form__input-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" required />
                    </div>
                    <div class="form-group form__input-group">
                        <label>passwords</label>
                        <input type="password" name="password" class="form-control" required />
                    </div>
                        <div class="form-group form__input-group">
                        <input type="submit" name="submit" class="form__button" value="submit">
                    </div>
                    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
                </form>
                </div>
           </div>
      </div>    

    </body>
</html>
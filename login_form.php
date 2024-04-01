<?php

@include 'config.php';

session_start();
if(isset( $_SESSION['admin_name']))
   header("location: ./admin_page.php");
if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = $_POST['password'];
   $select = " SELECT * FROM student WHERE email = '$email' && password = '$pass' ";
   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);
         $_SESSION['user_name'] = $row['firstname'];
         $_SESSION['id'] = $row['id'];
         header('location:user_page.php');
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SeatFlow | Login</title>

   <link rel="stylesheet" href="css/styles1.css">

</head>
<body>
<header>
        <nav class="navbar">
            <a href="Home.php" class="img">SeatFlow <span>.</span></a>         
        </nav>
</header>

<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <p>Email<sup>*</sup></p>
      <input type="email" name="email" required placeholder="enter your email">
      <p>Password<sup>*</sup></p>
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register_form.php">register now</a></p>
   </form>

</div>

</body>
</html>
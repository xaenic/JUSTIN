<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $idnum = $_POST['idnum'];
   $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
   $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $age = $_POST['age'];
   $gender = $_POST['gender'];
   $address = $_POST['address'];
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM student WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO student (idnum, firstname,lastname, email, age, gender, address, password) VALUES('$idnum','$firstname','$lastname','$email','$age','$gender','$address','$pass')"; // Corrected here
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
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
      <h3>register Form</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <p>ID Number<sup>*</sup></p>
      
      <input type="text" name="idnum" required placeholder="enter your id number">
      
      <p>Your First Name<sup>*</sup></p>
      <input type="text" name="firstname" required placeholder="enter your name">
       <p>Your Last Name<sup>*</sup></p>
      <input type="text" name="lastname" required placeholder="enter your name">
      <p>Your Email<sup>*</sup></p>
      <input type="email" name="email" required placeholder="enter your email">
      
      <p>Age<sup>*</sup></p>
      <input type="text" name="age" required placeholder="enter your age">
      
      <p>Gender<sup>*</sup></p>
      <select name="gender">
         <option value="male">male</option>
         <option value="female">female</option>
      </select>
      
      <p>Address<sup>*</sup></p>
      <input type="text" name="address" required placeholder="enter your address">
      
      <p>Password<sup>*</sup></p>
      <input type="password" name="password" required placeholder="enter your password">
     
      <p>Confirm Password<sup>*</sup></p>
      <input type="password" name="cpassword" required placeholder="confirm your password">
      
      <p>User Type<sup>*</sup></p>
      <select name="user_type">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>

      <input type="submit" name="submit" value="register" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>

</body>
</html>
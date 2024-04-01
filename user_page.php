<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

$id = $_SESSION['id'];
$select = " SELECT * FROM student WHERE id = '$id' ";
$result = mysqli_query($conn, $select);

$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/dashboards.css">

</head>
<body>
   
<header>
        <nav class="navbar">
            <a href="Home.php" class="img">SeatFlow <span>.</span></a>         
        </nav>
    </header>

    <section class ="Section1">
        <div class="container">
            <div class="box" data-color="clr1">
                <div class="imgBx"><img src=""></div>
                <div class="glass">
                    <h3>Aldrich<br><span>POSITION</span></h3>
                    <ul>
                        <a href="#" style="--i:1;"><ion-icon name="radio-button-on-outline"></ion-icon></a>
                    </ul>
                    
                </div>
                    <span style="color:white">Home</span>
            </div>
            <div class="box" data-color="clr2">
                <div class="imgBx"><img src=""></div>
                <div class="glass">
                    <h3>Cesar<br><span>POSITION</span></h3>
                    <ul>
                        <a href="logout.php" style="--i:1;"><ion-icon name="radio-button-on-outline"></ion-icon></a>
                    </ul>
                </div>
                <span style="color:white">Logout</span>
            </div>
    </section>

<div class="container">
   <div class="content">
      <p class="welcome-text">Welcome <span><?php echo $_SESSION['user_name'] ?></span><br>You have <?php echo $row['sessions'];?> sessions Available</p>
      
   </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
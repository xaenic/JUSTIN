<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

$student = null;
$ok = false;
$error= null;

if(isset($_GET['search']))
{
    $idno = $_GET['search'];
     $results = $conn->query("SELECT * FROM student WHERE idnum ='$idno'");
     if($results->num_rows > 0){
      $student = $results->fetch_assoc();

     }
}
$ok = false;

if($student != null) {
    $atay = $student['id'];
    $ok = $conn->query("SELECT * FROM sessions WHERE student_id = '$atay'  AND time_out IS NULL");
}

if(isset($_POST['id'])){

    

    $id = $_POST['id'];
    $laboratory = $_POST['laboratory'];
    $purpose = $_POST['purpose'];

    $results = $conn->query("SELECT * FROM sessions WHERE student_id = '$id'  AND time_out IS NULL");
    if($results->num_rows <= 0)
    {

    if($student['sessions'] > 0) {
       $query = "INSERT INTO sessions (student_id,laboratory,purpose) VALUES('$id','$laboratory','$purpose')";
    $result = $conn->query($query);
    if (!$result) {
            $errorMessage = "Error: " . $conn->error;
            return;
    }
        header('Location: ./Admin_Tbl.php');
    }else {
      $error ="No available sessions";
    }
   
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>
    <script src="https://cdn.tailwindcss.com"></script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/dashboard_admin.css">

</head>
<body>
   
<header>
    <nav class="navbar">
        <a href="./" class="img">SeatFlow <span>.</span></a>         
    </nav>
</header>

<div class="container1">
     <div>


                    <form>
                    <div class="flex gap-2 rounded-md bg-white p-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5q0-2.725 1.888-4.612T9.5 3q2.725 0 4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5q0-1.875-1.312-3.187T9.5 5Q7.625 5 6.313 6.313T5 9.5q0 1.875 1.313 3.188T9.5 14"/></svg>
                    <input class="" type="text" name="search" placeholder="IDNO...">
                    </div>
                    
                    </form>

                    <?php if(isset($_GET['search']) && $student != null ) { ?>
                    
                      <form method="post" class="bg-[#151318] border border-white text-white w-full  mt-5 p-3 rounded-md min-w-[550px] flex flex-col items-center">
                        <span class="uppercase font-semibold text-center"> <?php echo $student['firstname']; echo" "; echo $student['lastname'];?></span>
                         <span class="uppercase  text-sm text-red-500"><?php echo $student['sessions'];?> sessions Available</span>
                         <span class="uppercase  text-sm text-sky-600 self-start">IDNO: <?php echo $student['idnum'];?></span>
                        <div class="self-start flex flex-col gap-2 w-full mt-5">
          <label class="">Purpose of SitIn</label>
                    <div class="flex items-center p-2 border rounded-md gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 1024 1024"><path fill="currentColor" d="M880 112H144c-17.7 0-32 14.3-32 32v736c0 17.7 14.3 32 32 32h736c17.7 0 32-14.3 32-32V144c0-17.7-14.3-32-32-32M513.1 518.1l-192 161c-5.2 4.4-13.1.7-13.1-6.1v-62.7c0-2.3 1.1-4.6 2.9-6.1L420.7 512l-109.8-92.2a7.63 7.63 0 0 1-2.9-6.1V351c0-6.8 7.9-10.5 13.1-6.1l192 160.9c3.9 3.2 3.9 9.1 0 12.3M716 673c0 4.4-3.4 8-7.5 8h-185c-4.1 0-7.5-3.6-7.5-8v-48c0-4.4 3.4-8 7.5-8h185c4.1 0 7.5 3.6 7.5 8z"/></svg>
                      <select name="purpose" class="w-full   bg-[#151318]">
                                  <option value="Java">Java</option>
                                  <option value="Python">Python</option>
                                  <option value="C">C</option>
                                  <option value="C++">C++</option>
                                  <option value="C#">C#</option>
                                  <option value="Others">Others</option>
                              </select>
                    </div>
                            
                    
                    
                </div>
                <div class="flex flex-col gap-2 w-full mt-5">
                    <label class="">Laboratory</label>
                    <div class="flex items-center p-2 border rounded-md gap-2">

                   <svg xmlns="http://www.w3.org/2000/svg" width="1.25em" height="1em" viewBox="0 0 640 512"><path fill="currentColor" d="M384 96v224H64V96zM64 32C28.7 32 0 60.7 0 96v224c0 35.3 28.7 64 64 64h117.3l-10.7 32H96c-17.7 0-32 14.3-32 32s14.3 32 32 32h256c17.7 0 32-14.3 32-32s-14.3-32-32-32h-74.7l-10.7-32H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64zm464 0c-26.5 0-48 21.5-48 48v352c0 26.5 21.5 48 48 48h64c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm16 64h32c8.8 0 16 7.2 16 16s-7.2 16-16 16h-32c-8.8 0-16-7.2-16-16s7.2-16 16-16m-16 80c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16s-7.2 16-16 16h-32c-8.8 0-16-7.2-16-16m32 160a32 32 0 1 1 0 64a32 32 0 1 1 0-64"/></svg>
                    <select name="laboratory" class="w-full  bg-[#151318]">
                        <option value="Lab 524">Lab 524</option>
                        <option value="Lab 526">Lab 526</option>
                        <option value="Lab 528">Lab 528</option>
                        <option value="Lab 542">Lab 542</option>
                        <option value="Lab 543">Lab 543</option>
                    </select>
                    </div>
                    
                </div> <div class="flex justify-between mt-5 gap-5">

                  <input type="hidden" value="<?php echo $student['id'];?>" name="id"/>
                  <div class="flex items-center bg-[#b6a87c] gap-2 cusor-pointer px-3 p-2  rounded-md">
                


                    <?php if($ok && $ok->num_rows > 0){?>

                        <span>Already In Session</span>
                      <?php } else {?>
                     <input type="submit" value="Sit In" class="cursor-pointer font-normal text-white "/>

                     <?php }?>
                  </div>
                    <div class="flex items-center gap-2 cusor-pointer px-3 p-2   text-white bg-[#8e523d]  rounded-md">
                    
                        <a href="./delete.php?id=<?php echo $student['id'];?>" class="font-normal">Delete</a>
                    </div>
                   
                </div> 
                    </form>
                    <?php } else if(isset($_GET['search']) && $student == null) { ?>

                            <span class="text-white text-xl font-bold  "> NO STUDENT FOUND</span>

                      <?php  }?>
     </div>
   <div class="content">
      <p class="welcome-text">Search Student</p>
   </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
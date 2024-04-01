<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}
$students= [];
$query = "SELECT * FROM sessions INNER JOIN student ON student.id = sessions.student_id ORDER BY time_out asc";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}
$conn->close();
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
 <table class="mt-5 w-full text-sm text-left rtl:text-right text-white rounded-md  ">
                <thead class="text-xs bg-[#151318] border border-white  uppercase border-b-0">
                    <tr>
                        <th class="border px-4 py-4 font-medium border-none text-center font-bold">ID NO
                        </th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">FIRST NAME</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">LAST NAME</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">SESSIONS</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">EMAIL</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">TIME IN</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">TIME OUT</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">Operation</th>
                    </tr>
                </thead>
                <tbody id="tbody" class="relative">
                    

                <?php 

            foreach ($students as $student) {
                   echo '<tr class="odd:bg-[#8e523d] bg-[#b6a87c] border-r border-l border-white">
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['idnum'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['firstname'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['lastname'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['sessions'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['email'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['time_in'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['time_out'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">' . ($student['time_out'] !== null ? '<span href="#" class="text-white  bg-[#151318] px-3 p-2 rounded-md">Finished</span>' : '<a href="./timeout.php?id='.$student['id'].'&s_id='.$student['session_id'].'" class=" bg-white text-black px-3 p-2 rounded-md">Logout</a>') . '</td></tr>';
                }
            ?>

                </tbody>

            </table>
   <div class="content">
      <p class="welcome-text">Students SitIn Records</p>
   </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
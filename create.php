<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "userdb";

$connection = new mysqli($servername, $username, $password, $database);

$idnum = "";
$name = "";
$year = "";
$sessions = "";
$status = "";

$errorMessage= "";  
$successMessage = "";



if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idnum = $_POST["idnum"];
    $name = $_POST["name"];
    $year = $_POST["year"];
    $sessions = $_POST["sessions"];
    $status = $_POST["status"];

    do {
        if (empty($idnum) || empty($name) ||empty($year) ||empty($sessions) ||empty($status) ) {
            $errorMessage = "All Fields are Required";
            breake;
        }

       $sql = "INSERT INTO rm542 (idnum,name,year,sessions,status)" . 
              "VALUES ('$idnum', '$name', '$year', '$sessions', '$status')";

       $result = $connection->query($sql);

       if (!result) {
           $errorMessage = "Invalid query: " . $connection->error;
           break;
        }

        $idnum = "";
        $name = "";
        $year = "";
        $sessions = "";
        $status = "";

        $successMessage = "Student Added!";

        header("location: Admin_Tbl.php");
        exit;

    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD SIT-IN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <h2>New Sit-IN</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class = 'aler alert-warning alert-dismissable fade show' role='alert'>
                <strong>$errorMessage</strong>
            </div>
            ";
        }
        ?>

        <form method=""post>
            <div class = "row mb-3">
                <label class="col-sm-3 col-form-label">idnum</label>
                <div class ="col-sm-6">
                    <input type="text" class ="form-control name=" name="idnum" value="<?php echo $idnum; ?>">
                </div>
            </div>
            <div class = "row mb-3">
                <label class="col-sm-3 col-form-label">name</label>
                <div class ="col-sm-6">
                    <input type="text" class ="form-control name=" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class = "row mb-3">
                <label class="col-sm-3 col-form-label">year</label>
                <div class ="col-sm-6">
                    <input type="text" class ="form-control name=" name="year" value="<?php echo $year; ?>">
                </div>
            </div> 
            <div class = "row mb-3">
                <label class="col-sm-3 col-form-label">sessions</label>
                <div class ="col-sm-6">
                    <input type="text" class ="form-control name=" name="sessions" value="<?php echo $sessions; ?>">
                </div>
            </div>
            <div class = "row mb-3">
                <label class="col-sm-3 col-form-label">status</label>
                <div class ="col-sm-6">
                    <input type="text" class ="form-control name=" name="status" value="<?php echo $status; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class = 'row mb-3'>
                    <div class = 'offset-sm-3 col-sm-6'>
                        <div class = 'alert alert-success alert-dismissable fade show' role='alert'>
                            <strong>$successMessage</strong>
                         </div>
                    </div>
                </div>
                ";
            }
            ?>
            
            <div>
                <div class = "offset-sm-3 col-sm-3 d-grid">
                    <button type = "submit" class="btn btn-primary">Submit</button>
                </div>
                <div class = "col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="Admin_Tbl.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
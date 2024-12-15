<?php
require 'config.php';
include("session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Staff</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Staff</h1>
        <nav>
            <ul>
                <li><a href="staff_home.php">Home</a></li>
                <?php 
                    $regno22 = $_SESSION['login_user'];
                    $query22 = "SELECT * FROM staff where regno = '$regno22'";
                    $query_run22 = mysqli_query($db, $query22);

                    if (mysqli_num_rows($query_run22) > 0) {
                        foreach ($query_run22 as $student22) {
                            if($student22['advisor']==1){
                ?>
                <li><a href="class_stu.php">Students Data</a></li>
                <?php
                            }
                        }
                    }
                ?>
                <li><a href="mentee.php">Mentees Data</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <section id="home">
        <div class="personal-info">
            <h2>Personal Information</h2>
            <?php
                $regno = $_SESSION['login_user'];
                $query2 = "SELECT * FROM staff where regno = '$regno'";
                $query_run2 = mysqli_query($db, $query2);

                if (mysqli_num_rows($query_run2) > 0) {
                    foreach ($query_run2 as $student2) {
                ?>
                <p>Name : <span id="studentName"><?php echo $student2['name']; ?></span></p>
                <p>Register Number : <span id="studentRegisterNo"><?php echo $_SESSION['login_user']; ?></span></p>
                <p>Department : <span id="studentDepartment"><?php echo $student2['dept'] ?></span></p>
                <p>Advisor : <span id="studentMentor"><?php echo $student2['advisor'] ?></span></p>
            <?php 
                    }
                }
            ?>
        </div>
    </section>
    <script src="scripts.js"></script>
</body>
</html>
<?php
require 'config.php';
include("session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Students</title>
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
    
    <div class="class_stu">
        <div class="students-info">
            <h2>Mentee's Information</h2>
            <table class="students-table">
                <thead>
                    <tr>
                        <th class="students-table-header">S.No</th>
                        <th class="students-table-header">Register Number</th>
                        <th class="students-table-header">Name</th>
                        <th class="students-table-header">Total Fees</th>
                        <th class="students-table-header">Paid Fees</th>
                        <th class="students-table-header">Pending</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $regno = $_SESSION['login_user'];
                    $query2 = "SELECT * FROM stu_data WHERE mentor = '$regno'";
                    $query_run2 = mysqli_query($db, $query2);

                    if (mysqli_num_rows($query_run2) > 0) {
                        $sno = 1; // Initialize serial number
                        foreach ($query_run2 as $student2) {
                            echo "<tr class='students-table-row'>";
                            echo "<td class='students-table-cell'>" . $sno . "</td>";
                            echo "<td class='students-table-cell'>" . $student2['regno'] . "</td>";
                            echo "<td class='students-table-cell'>" . $student2['name'] . "</td>";
                            if($student2['via']=='bus'){
                                $stu = $student2['regno'];
                                $total = 0;
                                $querybus = "SELECT * FROM stu_bus WHERE regno = '$stu'";
                                $query_bus = mysqli_query($db, $querybus);
                                if (mysqli_num_rows($query_bus) > 0) {
                                    foreach ($query_bus as $studentbus) {
                                        $total = $studentbus['bus']+$studentbus['college']+$studentbus['miscellaneous'];
                                        echo "<td class='students-table-cell'>" . $total . "</td>";
                                    }
                                }
                                $querybus2 = "SELECT * FROM bus_paid WHERE regno = '$stu'";
                                $query_bus2 = mysqli_query($db, $querybus2);
                                if (mysqli_num_rows($query_bus2) > 0) {
                                    foreach ($query_bus2 as $studentbus2) {
                                        $pending = $studentbus2['bus']+$studentbus2['college']+$studentbus2['miscellaneous'];
                                        echo "<td class='students-table-cell'>" . $pending . "</td>";
                                        echo "<td class='students-table-cell'>" . $total - $pending . "</td>";
                                    }
                                }
                            }
                            if($student2['via']=='hostel'){
                                $stu = $student2['regno'];
                                $total = 0;
                                $queryhostel = "SELECT * FROM stu_hostel WHERE regno = '$stu'";
                                $query_hostel = mysqli_query($db, $queryhostel);
                                if (mysqli_num_rows($query_hostel) > 0) {
                                    foreach ($query_hostel as $studenthostel) {
                                        $total = $studenthostel['mess']+$studenthostel['hostel']+$studenthostel['college']+$studenthostel['miscellaneous'];
                                        echo "<td class='students-table-cell'>" . $total . "</td>";
                                    }
                                }
                                $queryhostel2 = "SELECT * FROM hostel_paid WHERE regno = '$stu'";
                                $query_hostel2 = mysqli_query($db, $queryhostel2);
                                if (mysqli_num_rows($query_hostel2) > 0) {
                                    foreach ($query_hostel2 as $studenthostel2) {
                                        $pending = $studenthostel2['mess']+$studenthostel2['hostel']+$studenthostel2['college']+$studenthostel2['miscellaneous'];
                                        echo "<td class='students-table-cell'>" . $pending . "</td>";
                                        echo "<td class='students-table-cell'>" . $total - $pending . "</td>";
                                    }
                                }
                            }
                            echo "</tr>";
                            $sno++;
                        }
                    } else {
                        echo "<tr class='students-table-row'><td class='students-table-cell' colspan='5'>No students assigned to you.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>

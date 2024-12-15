<?php
require 'config.php';
include("session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Details</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif; 
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 60%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .tables {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border: 1px solid #ddd;

        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .highlight {
            background-color: #eaf3f3;
        }
        .balance {
            font-weight: bold;
            color: red;
        }
        .table_container {
            max-width: 100%;
            width : 100%;
            border: 1px solid #ddd;

        }
        @media (max-width : 480px){
        .container {
            width: 85%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .table_container {
            max-width: 100%;
            width : 50%;
            border: 1px solid #ddd;

        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 2px;
            text-align: left;
        }
    }
    </style>
</head>
    <header>
        <h1>FeeConnect</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="fees-details.php">Fees Details</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header><br>
<body>
    <div class="container">
        <h2>Fee Details</h2>
        <table class="tables">
            <?php
                $regno = $_SESSION['login_user'];
                $query0 = "SELECT * FROM stu_data where regno = '$regno'";
                $query_run0 = mysqli_query($db, $query0);
                if (mysqli_num_rows($query_run0) > 0) {
                    foreach ($query_run0 as $student0) {
            ?>
            <tr>
                <th>Students Details</th>
                <th>Fees Details</th>
            </tr>
            <tr>
                <th>Name</th>
                <td>
                    <?php echo $student0["name"] ?></td>
            </tr>
            <tr>
                <th>Register Number</th>
                <td>
                    <?php echo $student0["regno"] ?></td>
            </tr>
            <tr>
                <th>Department</th>
                <td>
                    <?php echo $student0["dept"] ?></td>
            </tr>
            <tr>
                <th>Year</th>
                <td>
                    <?php echo $student0["year"] ?></td>
            </tr>
            <?php
                    }
                } 
            ?>
            </table>
            <?php
                $regno = $_SESSION['login_user'];
                $query3 = "SELECT * FROM stu_data where regno = '$regno'";
                $query_run3 = mysqli_query($db, $query3);
                if (mysqli_num_rows($query_run3) > 0) {
                    foreach ($query_run3 as $student3) {
            ?>
            <form id="noDueForm" disabled style="display:none;">
                <input type="text" id="studentName" name="studentName" value="<?php echo $student3["name"] ?>" disabled />
                <input type="text" id="registerNumber" name="registerNumber" value="<?php echo $student3["regno"] ?>" disabled />                
                <input type="text" id="department" name="department" value="<?php echo $student3["dept"] ?>" disabled/>                
                <input type="number" id="year" name="year" value="<?php echo $student3["year"] ?>" disabled />
            </form>
            <?php
                    }
                } 
            ?>
            <table class="table_container">
            <tr>
                <th>Students Fees Details</th>
                <th>Fees to pay</th>
                <th>Paid Details</th>
            </tr>
            <?php
               if($student0["via"]=='hostel'){
                $query1 = "SELECT * FROM stu_hostel where regno = '$regno'";
                $query_run1 = mysqli_query($db, $query1);
                $query11 = "SELECT * FROM hostel_paid where regno = '$regno'";
                $query_run11 = mysqli_query($db, $query11); 
                if (mysqli_num_rows($query_run11) > 0 && mysqli_num_rows($query_run1) > 0) {
                    foreach ($query_run11 as $student11) { 
                        foreach ($query_run1 as $student1) { 
                            ?>
            
            <tr class="highlight">
                <th>Mess Fee</th>
                <td>
                    <?php echo $student1["mess"] ?> <?php echo " /-" ?></td>
                <td>
                    <?php echo $student11["mess"] ?> <?php echo " /-" ?></td>
            </tr>
            <tr class="highlight">
                <th>Hostel Fee</th>
                <td>
                    <?php echo $student1["hostel"] ?> <?php echo " /-" ?></td>
                <td>
                    <?php echo $student11["hostel"] ?> <?php echo " /-" ?></td>
            </tr>
            <tr class="highlight">
                <th>College Fee</th>
                <td>
                    <?php echo $student1["college"] ?> <?php echo " /-" ?></td>
                <td>
                    <?php echo $student11["college"] ?> <?php echo " /-" ?></td>
            </tr>
            <tr class="highlight">
                <th>Miscellaneous Fee</th>
                <td>
                    <?php echo $student1["miscellaneous"] ?> <?php echo " /-" ?></td>
                <td>
                    <?php echo $student11["miscellaneous"] ?> <?php echo " /-" ?></td>
            </tr>
            <tr>
                <th>Total Fee</th>
                <td>
                    <?php echo $student1["mess"]+$student1["hostel"]+$student1["college"]+$student1["miscellaneous"] ?> <?php echo " /-" ?></td>
                <td>
                    <?php echo $student11["mess"]+$student11["hostel"]+$student11["college"]+$student11["miscellaneous"] ?> <?php echo " /-" ?></td>
            </tr>
            <tr class="balance">
                <th>Balance</th>
                <td>
                    <?php echo ($student1["mess"]+$student1["hostel"]+$student1["college"]+$student1["miscellaneous"]) - ($student11["mess"]+$student11["hostel"]+$student11["college"]+$student11["miscellaneous"]) ?> <?php echo " /-" ?></td>
                <input type="number" id="balance" name="balance" value=<?php echo ($student1["mess"]+$student1["hostel"]+$student1["college"]+$student1["miscellaneous"]) - ($student11["mess"]+$student11["hostel"]+$student11["college"]+$student11["miscellaneous"]) ?> disabled style="display:none;"/>
                <td><button onclick="generatePDF2()">Generate No-Due</button></td>
                <script>
                    function generatePDF2() {
                        const balance = document.getElementById("balance").value;
                        if(balance<=0){
                        const { jsPDF } = window.jspdf;
                        const doc = new jsPDF();

                        // Add simple text content to the PDF
                        doc.setFontSize(16);
                        doc.text("M.KUMARASAMY COLLEGE OF ENGINEERING, KARUR - 639113", 10, 10);
                        doc.setFontSize(14);
                        doc.text("No Due Certificate", 10, 20);

                        const studentName = document.getElementById("studentName").value;
                        const registerNumber = document.getElementById("registerNumber").value;
                        const department = document.getElementById("department").value;
                        const year = document.getElementById("year").value;

                        doc.setFontSize(12);
                        doc.text(`Student Name: ${studentName}`, 10, 40);
                        doc.text(`Register Number: ${registerNumber}`, 10, 50);
                        doc.text(`Department: ${department}`, 10, 60);
                        doc.text(`Year: ${year}`, 10, 70);

                        // Save the PDF
                        doc.save('No_Due_Certificate.pdf');
                        }
                        else{
                            alert("Need to pay fees");
                        }
                    }
                </script>
            </tr>
            <?php
                        }
                    }
                } 
            }
            ?>
            <?php
               if($student0["via"]=='bus'){
                $query2 = "SELECT * FROM stu_bus where regno = '$regno'";
                $query_run2 = mysqli_query($db, $query2);
                $query22 = "SELECT * FROM bus_paid where regno = '$regno'";
                $query_run22 = mysqli_query($db, $query22);
                if (mysqli_num_rows($query_run22) > 0  && mysqli_num_rows($query_run2) > 0) {
                    foreach ($query_run2 as $student2) {
                        foreach ($query_run22 as $student22) {
                            ?>
            <tr class="highlight">
                <th>Bus Fee</th>
                <td>
                    <?php echo $student2["bus"] ?> <?php echo " /-" ?></td>
                <td>
                    <?php echo $student22["bus"] ?> <?php echo " /-" ?></td>
            </tr>
            <tr class="highlight">
                <th>College Fee</th>
                <td>
                    <?php echo $student2["college"] ?> <?php echo " /-" ?></td>
                <td>
                    <?php echo $student22["college"] ?> <?php echo " /-" ?></td>
            </tr>
            <tr class="highlight">
                <th>Miscellaneous Fee</th>
                <td>
                    <?php echo $student2["miscellaneous"] ?> <?php echo " /-" ?></td>
                <td>
                    <?php echo $student22["miscellaneous"] ?> <?php echo " /-" ?></td>
            </tr>
            <tr class="highlight">
                <th>Total Fee</th>
                <td>
                    <?php echo $student2["bus"]+$student2["college"]+$student2["miscellaneous"] ?> <?php echo " /-" ?></td>
                <td>
                    <?php echo $student22["bus"]+$student22["college"]+$student22["miscellaneous"] ?> <?php echo " /-" ?></td>
            </tr>
            <tr class="balance">
                <th>Balance to pay</th>
                <td>
                    <?php echo ($student2["bus"]+$student2["college"]+$student2["miscellaneous"]) - ($student22["bus"]+$student22["college"]+$student22["miscellaneous"]) ?><?php echo " /-" ?></td>
                <input type="number" id="balance" name="balance" value=<?php echo ($student2["bus"]+$student2["college"]+$student2["miscellaneous"]) - ($student22["bus"]+$student22["college"]+$student22["miscellaneous"]) ?> disabled style="display:none;"/>
                <td><button onclick="generatePDF()">Generate No-Due</button></td>
                <script>
                    function generatePDF() {
                        const balance = document.getElementById("balance").value;
                        if(balance<=0){
                        const { jsPDF } = window.jspdf;
                        const doc = new jsPDF();

                        // Add simple text content to the PDF
                        doc.setFontSize(16);
                        doc.text("M.KUMARASAMY COLLEGE OF ENGINEERING, KARUR - 639113", 10, 10);
                        doc.setFontSize(14);
                        doc.text("No Due Certificate", 10, 20);

                        const studentName = document.getElementById("studentName").value;
                        const registerNumber = document.getElementById("registerNumber").value;
                        const department = document.getElementById("department").value;
                        const year = document.getElementById("year").value;

                        doc.setFontSize(12);
                        doc.text(`Student Name: ${studentName}`, 10, 40);
                        doc.text(`Register Number: ${registerNumber}`, 10, 50);
                        doc.text(`Department: ${department}`, 10, 60);
                        doc.text(`Year: ${year}`, 10, 70);

                        // Save the PDF
                        doc.save('No_Due_Certificate.pdf');
                        }
                        else{
                            alert("Need to pay fees");
                        }
                    }
                </script>
            </tr>
            <?php
                        }
                    }
                } 
            }
            ?>
        </table>
    </div>
</body>
</html>

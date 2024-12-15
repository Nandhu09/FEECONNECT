<?php
require 'config.php';
include("session.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>No Due Form</title>
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
                width: 50%;
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
            form {
                margin-top: 20px;
            }
            label {
                font-weight: bold;
                display: block;
                margin-bottom: 10px;
                color: #555;
            }
            input[type="text"], input[type="email"], input[type="number"] {
                width: 95%;
                padding: 10px;
                margin-bottom: 20px;
                border-radius: 4px;
                border: 1px solid #ddd;
            }
            input[type="submit"] {
                width: 98%;
                padding: 10px;
                background-color: #28a745;
                border: none;
                border-radius: 4px;
                color: white;
                font-weight: bold;
                cursor: pointer;
            }
            input[type="submit"]:hover {
                background-color: #218838;
            }
            .message {
                text-align: center;
                margin-top: 20px;
                font-size: 18px;
                color: #28a745;
            }
            .certificate {
                margin-top: 40px;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background-color: #fafafa;
            }
            .certificate h3 {
                text-align: center;
                color: #000;
                margin-bottom: 20px;
            }
            .certificate p {
                font-size: 16px;
                line-height: 1.6;
                margin: 10px 0;
            }
            .download {
                text-align: center;
                margin-top: 20px;
            }
            .download a {
                padding: 10px 20px;
                background-color: #007bff;
                color: white;
                text-decoration: none;
                border-radius: 4px;
            }
            .download a:hover {
                background-color: #0056b3;
            }

            @media (max-width : 480px) {
                    .container {
                    width: 85%;
                    margin: auto;
                    background: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                }
                
            }
        </style>
    </head>
    <body>
        <header>
            <h1>FeeConnect</h1>
            <nav>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="fees-details.php">Fees Details</a></li>
                    <li><a href="no-due-form.php">No Due Form</a></li> 
                    <li><a href="Logout.php">Logout</a></li>
                </ul>
            </nav>
        </header><br>
        <div class="container">
            <h2>No Due Form</h2>
            <?php
                $regno = $_SESSION['login_user'];
                $query2 = "SELECT * FROM stu_data where regno = '$regno'";
                $query_run2 = mysqli_query($db, $query2);
                if (mysqli_num_rows($query_run2) > 0) {
                    foreach ($query_run2 as $student2) {
            ?>
            <form id="noDueForm" onsubmit="generatePDF(event)">
                <label for="studentName">Student Name</label>
                <input type="text" id="studentName" name="studentName" value="<?php echo $student2["name"] ?>" disabled />
                
                <label for="registerNumber">Register Number</label>
                <input type="text" id="registerNumber" name="registerNumber" value="<?php echo $student2["regno"] ?>" disabled />
                
                <label for="department">Department</label>
                <input type="text" id="department" name="department" value="<?php echo $student2["dept"] ?>" disabled/>                
                <label for="year">Year</label>
                <input type="number" id="year" name="year" value="<?php echo $student2["year"] ?>" disabled />
                <input type="number" id="balance" name="balance" value=2 disabled style="display:none;"/>
                <br><br>
                <input type="submit" value="Generate No Due Certificate" >
            </form>

            <?php
                    }
                } 
            ?>
            <div class="message" id="message"></div>    
            <script>
                function generatePDF(event) {
                    event.preventDefault(); // Prevent form submission
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
        </div>
    </body>
</html>

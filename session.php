<?php
session_start();
// If the user is not logged in redirect to the login page...

if (!isset($_SESSION['loggedin'])) 
{
	header('Location:index.php');
	exit();
}

	$query = "SELECT name FROM stu_data";
    $query_run = mysqli_query($db, $query);
	if(mysqli_num_rows($query_run) > 0){
	$row = mysqli_fetch_assoc($query_run);
	$dept=$row['name'];
	}


?>
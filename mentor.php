<?php
require 'config.php';
include("session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentor Dashboard - FeeConnect</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>FeeConnect - Mentor Dashboard</h1>
        <nav>
            <ul>
                <li><a href="mentor.html">Dashboard</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section id="mentor-dashboard">
        <h2>Your Mentees</h2>
        <div id="mentor-results"></div>
    </section>
    <script src="scripts.js"></script>
</body>
</html>

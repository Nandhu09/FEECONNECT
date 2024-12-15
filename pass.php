<?php
require 'config.php';
include("session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Password - FeeConnect</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section id="set-password">
        <h2>Set Your Password</h2>
        <form onsubmit="return setPassword(event)">
            <input type="text" id="registerNo" placeholder="Register Number" required>
            <input type="password" id="newPassword" placeholder="New Password" required>
            <input type="password" id="confirmPassword" placeholder="Confirm Password" required>
            <button type="submit">Set Password</button>
        </form>
    </section>
    <script src="scripts.js"></script>
</body>
</html>

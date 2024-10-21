<!-- home.php -->
<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header('Location: sign_in.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Social Media Planner</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="calendar.php">Calendar</a>
        <a href="resources.php">Resources</a>
        <a href="analytics.php">Analytics</a>
        <a href="settings.php">Settings</a>
        <a href="includes/logout.php">Logout</a>
    </div>
    <div class="sidebar">
        <h3>Social Accounts</h3>
        <!-- Fetch linked social accounts using Instagram API -->
        <ul>
            <li>Instagram</li>
            <li>Facebook</li>
        </ul>
    </div>
    <div class="main-content">
        <h2>Today's Scheduled Posts</h2>
        <!-- Display scheduled posts for the day dynamically -->
    </div>
</body>
</html>

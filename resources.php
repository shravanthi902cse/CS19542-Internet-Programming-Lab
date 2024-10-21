<!-- resources.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources - Social Media Planner</title>
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
    <div class="content">
        <h2>Upload Resources</h2>
        <form id="uploadForm" enctype="multipart/form-data">
            <input type="file" name="resource" required>
            <button type="submit">Upload</button>
        </form>
        <div id="uploadStatus"></div>
    </div>

    <script src="script.js"></script>
</body>
</html>

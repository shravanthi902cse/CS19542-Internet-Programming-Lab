<!-- analytics.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - Social Media Planner</title>
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
        <ul>
            <li>Instagram</li>
            <li>Facebook</li>
        </ul>
    </div>
    <div class="content">
        <h2>Instagram Analytics</h2>
        <div class="analytics-container">
            <div class="analytic-block">
                <h3>Total Engagement</h3>
                <p id="engagement">Fetching data...</p>
            </div>
            <div class="analytic-block">
                <h3>Like Count</h3>
                <p id="likeCount">Fetching data...</p>
            </div>
            <div class="analytic-block">
                <h3>Age-based Segmentation</h3>
                <p id="ageSegment">Fetching data...</p>
            </div>
            <div class="analytic-block">
                <h3>Gender-based Segmentation</h3>
                <p id="genderSegment">Fetching data...</p>
            </div>
        </div>
    </div>

    <script src="assets/js/analytics.js"></script>
</body>
</html>

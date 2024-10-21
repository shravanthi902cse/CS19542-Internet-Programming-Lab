<!-- calendar.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar - Social Media Planner</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css' rel='stylesheet' />
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
    <div id="calendar"></div>

    <!-- Event modal to add/edit/delete -->
    <div id="eventModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="eventForm">
                <input type="text" id="eventTitle" name="title" placeholder="Event Title" required>
                <input type="datetime-local" id="eventTime" name="time" required>
                <select id="socialAccount" name="account">
                    <option value="Instagram">Instagram</option>
                    <option value="Facebook">Facebook</option>
                </select>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js'></script>
    <script src="assets/js/script.js"></script>
</body>
</html>

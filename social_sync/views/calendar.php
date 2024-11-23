<?php include 'C:\xampp\htdocs\social_sync\includes\header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Calendar</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2>Calendar View</h2>
    <div id="calendar"></div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: 'api.php?action=get_events',
            eventClick: function(info) {
                window.location.href = info.event.url;
            }
        });
        calendar.render();
    });
</script>
</body>
<?php include 'C:\xampp\htdocs\social_sync\includes\footer.php'; ?>
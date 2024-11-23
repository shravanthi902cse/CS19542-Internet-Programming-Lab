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
    <h2>Upload Media</h2>
    <form action="api.php?action=upload" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" required>
        </div>
        <div class="form-group">
            <label for="caption">Caption:</label>
            <textarea class="form-control" id="caption" name="caption" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="scheduled_time">Scheduled Time:</label>
            <input type="datetime-local" class="form-control" id="scheduled_time" name="scheduled_time" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
</body>
<?php include 'C:\xampp\htdocs\social_sync\includes\footer.php'; ?>
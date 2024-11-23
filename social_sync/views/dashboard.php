<?php 
include 'C:\xampp\htdocs\social_sync\includes\db.php'; // Include your existing database connection
include 'C:\xampp\htdocs\social_sync\includes\header.php'; 

// Assuming you have a session or a way to get the current user's ID
session_start();
$user_id = $_SESSION['user_id']; // Example: Fetching user ID from session

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['media'])) {
    $targetDir = "uploads/";
    $fileName = basename($_FILES["media"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Validate file type
    $allowedTypes = array('jpg', 'png', 'gif', 'mp4', 'avi');
    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["media"]["tmp_name"], $targetFilePath)) {
            // Save file info to database
            $caption = isset($_POST['caption']) ? $_POST['caption'] : ''; // Get caption if provided
            $scheduled_time = date("Y-m-d H:i:s"); // For example, set to now; adjust as needed
            $sql = "INSERT INTO media (user_id, image_path, caption, scheduled_time) VALUES ('$user_id', '$targetFilePath', '$caption', '$scheduled_time')";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>File uploaded successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error saving to database: " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Error uploading your file.</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Sorry, only JPG, PNG, GIF, MP4, and AVI files are allowed.</div>";
    }
}

// Fetch uploaded media from the database for the current user
$query = "SELECT * FROM media WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Media Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: #A53860;"

<div class="container mt-5" style="background-color:#A53860" ;>
    <h1 class="text-center">Media Dashboard</h1>
    <div class="container mt-5">
    <h2 >Upload Media</h2>
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
        <button type="submit" class="btn">Upload</button>
    </form>
    </div>
    <h2>Your Uploaded Media</h2>
    <div class="row">
        <?php if ($result->num_rows > 0) : ?>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="col-md-4">
                    <div class="media-item">
                        <?php if (in_array(pathinfo($row['image_path'], PATHINFO_EXTENSION), ['jpg', 'png', 'gif'])) : ?>
                            <img src="<?php echo $row['image_path']; ?>" alt="<?php echo htmlspecialchars($row['caption']); ?>" class="img-fluid">
                        <?php else: ?>
                            <video controls class="w-100">
                                <source src="<?php echo $row['image_path']; ?>" type="video/<?php echo pathinfo($row['image_path'], PATHINFO_EXTENSION); ?>">
                                Your browser does not support the video tag.
                            </video>
                        <?php endif; ?>
                        <div class="p-2">
                            <p class="mb-0">Caption: <?php echo htmlspecialchars($row['caption']); ?></p>
                            <p class="mb-0">Uploaded on: <?php echo $row['created_at']; ?></p
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">No media uploaded yet.</p>
        <?php endif; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
include 'C:\xampp\htdocs\social_sync\includes\footer.php';
$conn->close(); // Close the connection when done

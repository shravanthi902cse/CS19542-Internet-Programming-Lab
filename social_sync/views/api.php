<?php
session_start();
require 'C:\xampp\htdocs\social_sync\includes\db.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'login':
        // Handle user login
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "User  not found.";
        }
        break;

    case 'register':
        // Handle user registration
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo "Registration failed.";
        }
        break;

    case 'upload':
        // Handle media upload
        $user_id = $_SESSION['user_id'];
        $caption = $_POST['caption'];
        $scheduled_time = $_POST['scheduled_time'];
        $image = $_FILES['image'];

        // Validate and move uploaded file
        $target_dir = "C:\xampp\htdocs\social_sync\assets\images";
        $target_file = $target_dir . basename($image["name"]);
        move_uploaded_file($image["tmp_name"], $target_file);

        $stmt = $conn->prepare("INSERT INTO media (user_id, image_path, caption, scheduled_time) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $target_file, $caption, $scheduled_time);
        $stmt->execute();
        header("Location: dashboard.php");
        break;

    case 'get_events':
        // Fetch events from the database
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM media WHERE user_id = $user_id";
        $result = mysqli_query($conn, $query);
        $events = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = [
                'title' => $row['caption'],
                'start' => $row['scheduled_time'],
                'url' => 'media.php?id=' . $row['id'],
            ];
        }
        echo json_encode($events);
        break;

    default:
        echo "Invalid action.";
        break;
}
?>
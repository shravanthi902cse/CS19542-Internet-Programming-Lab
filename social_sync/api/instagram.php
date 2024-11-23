<?php
require('config/database.php');

// Include the Instagram API client (assuming you're using a library like Instagram's official PHP SDK or a third-party library)
require_once('vendor/autoload.php');

use InstagramAPI\Instagram;

class InstagramAPI {
    private $ig;

    public function __construct($username, $password) {
        $this->ig = new Instagram();

        // Login to Instagram
        try {
            $this->ig->login($username, $password);
        } catch (Exception $e) {
            echo 'Instagram Login Error: ' . $e->getMessage();
        }
    }

    // Function to schedule a post
    public function schedulePost($imagePath, $caption, $scheduledTime) {
        // The scheduled time must be converted to a timestamp
        $timestamp = strtotime($scheduledTime);

        // Scheduling logic could involve setting a cron job or a delay in post publishing
        // For now, we can simulate post publishing
        if ($timestamp < time()) {
            // Publish post immediately
            $this->publishPost($imagePath, $caption);
        } else {
            // Store the post in the database for future publishing
            // Logic to save this scheduled post in the database
            $stmt = $pdo->prepare("INSERT INTO scheduled_posts (image_path, caption, scheduled_time) VALUES (?, ?, ?)");
            $stmt->execute([$imagePath, $caption, $scheduledTime]);
            echo 'Post scheduled for ' . $scheduledTime;
        }
    }

    // Function to publish post immediately
    public function publishPost($imagePath, $caption) {
        try {
            $this->ig->timeline->uploadPhoto($imagePath, ['caption' => $caption]);
            echo 'Post published!';
        } catch (Exception $e) {
            echo 'Error publishing post: ' . $e->getMessage();
        }
    }
}

// Example usage
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = 'your_instagram_username';
    $password = 'your_instagram_password';
    $imagePath = $_FILES['image']['tmp_name']; // Assuming a form upload
    $caption = $_POST['caption'];
    $scheduledTime = $_POST['scheduled_time']; // DateTime for scheduling

    $instagram = new InstagramAPI($username, $password);
    $instagram->schedulePost($imagePath, $caption, $scheduledTime);
}
?>

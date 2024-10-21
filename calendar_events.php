// ajax/calendar_events.php
<?php
// Database connection
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $time = $_POST['time'];
    $account = $_POST['account'];

    $stmt = $pdo->prepare("INSERT INTO events (title, time, account) VALUES (?, ?, ?)");
    if ($stmt->execute([$title, $time, $account])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add event']);
    }
} else {
    $stmt = $pdo->query("SELECT * FROM events");
    $events = [];
    while ($row = $stmt->fetch()) {
        $events[] = [
            'title' => $row['title'],
            'start' => $row['time'],
        ];
    }
    echo json_encode($events);
}
?>

// includes/insta_analytics.php
<?php
require 'vendor/autoload.php'; // Load Instagram API client
// Instagram API setup and authentication here

// Fetch analytics data (engagement, like count, etc.)
$data = [
    'engagement' => '80%', // These values would come from the actual Instagram API
    'likeCount' => '1200',
    'ageSegment' => '18-25: 50%, 26-35: 30%, 36+: 20%',
    'genderSegment' => 'Male: 60%, Female: 40%',
];

echo json_encode($data);
?>

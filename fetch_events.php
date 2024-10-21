<?php
include 'db.php';
session_start();

$events = [];

$result = $conn->query("SELECT * FROM events WHERE user_id = ".$_SESSION['user_id']);
while ($row = $result->fetch_assoc()) {
    $events[] = [
        'title' => $row['title'],
        'start' => $row['event_date']
    ];
}

echo json_encode($events);
?>

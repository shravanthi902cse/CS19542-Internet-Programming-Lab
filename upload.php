<?php
include 'includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file_name = $_FILES['resource']['name'];
    $file_tmp = $_FILES['resource']['tmp_name'];
    $upload_dir = 'uploads/' . $file_name;

    if (move_uploaded_file($file_tmp, $upload_dir)) {
        $conn->query("INSERT INTO resources (user_id, file_name, file_link) VALUES ('".$_SESSION['user_id']."', '$file_name', '$upload_dir')");
        header('Location: resources.php');
    } else {
        echo "File upload failed.";
    }
}
?>

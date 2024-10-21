// ajax/resource_upload.php
<?php
// Google Drive API setup and authentication
if ($_FILES['resource']['name']) {
    // Upload to Google Drive
    $file = $_FILES['resource'];
    $driveService = new Google_Service_Drive($client);
    $fileMetadata = new Google_Service_Drive_DriveFile([
        'name' => $file['name']
    ]);
    $driveFile = $driveService->files->create($fileMetadata, [
        'data' => file_get_contents($file['tmp_name']),
        'mimeType' => $file['type'],
        'uploadType' => 'multipart'
    ]);
    echo json_encode(['success' => true, 'fileId' => $driveFile->id]);
} else {
    echo json_encode(['success' => false, 'message' => 'No file uploaded']);
}
?>

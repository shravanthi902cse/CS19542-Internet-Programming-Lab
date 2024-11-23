<?php
require 'config/database.php';

// Include Google Client Library
require_once 'vendor/autoload.php';

class GoogleDriveAPI {
    private $client;
    private $service;

    public function __construct() {
        // Set up the Google Client
        $this->client = new Google_Client();
        $this->client->setApplicationName('SocialSync');
        $this->client->setScopes(Google_Service_Drive::DRIVE_FILE);
        $this->client->setAuthConfig('google-credentials.json'); // Path to the OAuth credentials file
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');

        // Initialize the Drive API service
        $this->service = new Google_Service_Drive($this->client);
    }

    public function uploadFile($filePath, $fileName) {
        // Create the file metadata
        $fileMetadata = new Google_Service_Drive_DriveFile();
        $fileMetadata->setName($fileName);

        // Upload the file
        $content = file_get_contents($filePath);
        $file = $this->service->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => mime_content_type($filePath),
            'uploadType' => 'multipart'
        ]);

        echo 'File uploaded successfully! File ID: ' . $file->getId();
    }
}

// Example usage
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['media'])) {
    $googleDrive = new GoogleDriveAPI();
    $filePath = $_FILES['media']['tmp_name'];  // Temporary uploaded file path
    $fileName = $_FILES['media']['name'];  // Original file name

    $googleDrive->uploadFile($filePath, $fileName);
}
?>

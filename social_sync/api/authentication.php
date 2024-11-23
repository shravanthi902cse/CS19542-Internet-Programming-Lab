<?php
require '/config/database.php';
require 'vendor/autoload.php';

class GoogleOAuth {
    private $client;
    private $redirectUri = 'http://localhost/socialsync/api/authentication.php';

    public function __construct() {
        if (!class_exists('Google_Client')) {
            throw new Exception('Google Client library not loaded. Ensure google/apiclient is installed.');
        }
        $this->client = new Google_Client();
        $this->client->setApplicationName('SocialSync');
        $this->client->setScopes(Google_ServiceDrive::DRIVE_file);
        $this->client->setAuthConfig('config/google-credentials.json');
        $this->client->setRedirectUri($this->redirectUri);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');
    }
    

    public function getLoginUrl() {
        return $this->client->createAuthUrl();
    }

    public function authenticate($code) {
        $this->client->authenticate($code);
        $_SESSION['access_token'] = $this->client->getAccessToken();
        return $this->client;
    }

    public function getClient() {
        return $this->client;
    }
}

// Initiate authentication flow
if (isset($_GET['code'])) {
    $googleOAuth = new GoogleOAuth();
    $googleOAuth->authenticate($_GET['code']);
    header('Location: ' . filter_var($this->redirectUri, FILTER_SANITIZE_URL));
    exit();
}

?>

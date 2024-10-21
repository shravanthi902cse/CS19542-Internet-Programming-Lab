<?php
require_once 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setClientId('873755566707-r7npbjs3m65olmssa41tnbv7i3lsrhie.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/oauth_callback');
$client->addScope(Google_Service_Drive::DRIVE);

if (!isset($_GET['code'])) {
    header('Location: index.php');
    exit;
} else {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $token;
    header('Location: index.php');
    exit;
}
?>

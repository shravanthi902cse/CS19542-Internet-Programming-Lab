<!-- includes/google_auth.php -->
<?php
require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('873755566707-r7npbjs3m65olmssa41tnbv7i3lsrhie.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/oauth_callback');
$client->addScope("email");
$client->addScope("profile");
$client->addScope("https://www.googleapis.com/auth/drive");

session_start();
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $token;
    $client->setAccessToken($token);

    $google_oauth = new Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $_SESSION['user_email'] = $google_account_info->email;
    $_SESSION['user_name'] = $google_account_info->name;

    // Redirect to Home page after successful login
    header("Location: home.php");
    exit();
}

if (!isset($_SESSION['access_token'])) {
    $authUrl = $client->createAuthUrl();
    header("Location: $authUrl");
}
?>

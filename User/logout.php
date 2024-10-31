<?php
session_start();

require_once 'vendor/autoload.php';
$client = new Google_Client();

if (isset($_SESSION['access_token'])) {
    $client->setAccessToken($_SESSION['access_token']);
    if (!$client->isAccessTokenExpired()) {
        $client->revokeToken();
    }
    unset($_SESSION['access_token']);
}
$_SESSION = array();
session_destroy();
header("Location: ../index.php");
exit();
?>

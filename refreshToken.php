<?php
require_once './googleapi/vendor/autoload.php';
session_start();
$client = new Google_Client();
$client->setAuthConfig('client_secrets.json');
$client->addScope('https://www.googleapis.com/auth/blogger');
$client->addScope('https://www.googleapis.com/auth/youtube');
$client->setAccessType("offline");
$refresh_token = file_get_contents('refresh_token');
$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
$client->setAccessType("offline");

$HDV_token = json_encode($_SESSION['access_token']);
$HDV_token = json_decode($HDV_token,true);

$client->refreshToken($HDV_token['refresh_token']);
$newtoken=$client->getAccessToken();
$_SESSION['access_token'] = $newtoken;

$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));

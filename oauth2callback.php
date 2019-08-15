<?php
require_once './googleapi/vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setAuthConfigFile('client_secrets.json');
$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
$client->addScope('https://www.googleapis.com/auth/blogger');
$client->addScope('https://www.googleapis.com/auth/youtube');
$client->setAccessType("offline");

if (! isset($_GET['code'])) {
  $auth_url = $client->createAuthUrl();
  header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();

	$HDV_refresh_token = json_encode($_SESSION['access_token']);
	$HDV_refresh_token = json_decode($HDV_refresh_token,true);
	$HDV_refresh_token = $HDV_refresh_token['refresh_token'];

  file_put_contents('refresh_token', $HDV_refresh_token);
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

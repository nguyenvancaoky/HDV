




<?php





<?php
require_once __DIR__.'/vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setAuthConfig('client_secrets.json');
$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
  $drive = new Google_Service_Drive($client);
  $files = $drive->files->listFiles(array())->getItems();
  echo json_encode($files);
} else {
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}






















// session_start();
// require_once './googleapi/vendor/autoload.php';

// $scriptUri = "http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];

// $client = new Google_Client();
// $client->setAccessType('online'); // default: offline
// $client->setApplicationName('HDV'); //name of the application
// $client->setClientId('295825200320-mo8n3ci5m3jgrpsd9m121d5scaa7kudh.apps.googleusercontent.com'); //insert your client id
// $client->setClientSecret('G7BnupHQdM0yMBNDiJCeEY_-'); //insert your client secret
// $client->setRedirectUri($scriptUri); //redirects to same url
// $client->setDeveloperKey('AIzaSyCH4hJtpGpLh4FFzzaKM8PXpL4-vtITIsU'); // API key (at bottom of page)
// $client->setScopes(array('https://www.googleapis.com/auth/blogger')); //since we are going to use blogger services

// $blogger = new Google_Service_Blogger($client);

// // if (isset($_GET['logout'])) { // logout: destroy token
// //     unset($_SESSION['token']);
// //  die('Logged out.');
// // }

// // if (isset($_GET['code'])) { // we received the positive auth callback, get the token and store it in session
// //     $client->authenticate();
// //     $_SESSION['token'] = $client->getAccessToken();
// // }

// // if (isset($_SESSION['token'])) { // extract token from session and configure client
// //     $token = $_SESSION['token'];
// //     $client->setAccessToken($token);
// // }

// // if (!$client->getAccessToken()) { // auth call to google
// //     $authUrl = $client->createAuthUrl();
// //     header("Location: ".$authUrl);
// //     die;
// // }
// //you can get the data about the blog by getByUrl
// $data = $blogger->blogs->getByUrl(array('url'=>'http://puwaruwa.blogspot.com/'));

// //creates a post object
// $mypost = new Google_Post();
// $mypost->setTitle('this is a test 1 title');
// $mypost->setContent('this is a test 1 content');

// $data = $blogger->posts->insert('546547654776577', $mypost); //post id needs here - put your blogger blog id
//  var_dump($data);
?>
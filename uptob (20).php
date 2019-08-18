<?php
require_once './googleapi/vendor/autoload.php';
include './lib/html_dom.php';
include './lib/function.php';
set_time_limit(30000);
session_start();
@$id_workshop = $_GET['id'];
$download_start_time = null;

if (isset($id_workshop) && $id_workshop) {
    echo '<!DOCTYPE html>
    <html>
    <head>
      <title>Progress Bar</title>
      <style type="text/css">
      #img img {
          max-width: 500px;
          max-height: 300px;
      }
      </style>
      <link href="https://steamcommunity-a.akamaihd.net/public/css/skin_1/workshop.css?v=wnJDG-79cPpl&amp;l=english" rel="stylesheet" type="text/css" >
    </head>
    <body>
    <div id="img">.....</div>
    <br>
    <div id="progress" style="width:500px;border:1px solid #ccc;"></div>
    <div id="size">0 MB</div>
    <br>
    <div class="workshop_item_header">
      <div class="col_right">
        <div class="rightDetailsBlock">
          <div class="workshopTags">Title:&nbsp;<span id="title"></span></div>
          <div class="workshopTags">Type:&nbsp;<span id="type"></span></div>
          <div class="workshopTags">Rating:&nbsp;<span id="rating"></span></div>
          <div class="workshopTags">Genre:&nbsp;<span id="genre"></span></div>
          <div class="workshopTags">Resolution:&nbsp;<span id="resolution"></span></div>
          <div class="workshopTags">Category:&nbsp;<span id="category"></span></div>
        </div>
        <br>
        <div class="rightDetailsBlock">
          <div class="detailsStatsContainerLeft">
            <div class="detailsStatLeft">File Size </div>
          </div>
          <div>
            <div class="detailsStatLeft" id="file_size"></div>
          </div>
        </div>
        <div class="detailsStatsContainerRight">
          <div class="detailsStatRight">
            <div>Download Link </div>
          </div>
          <div class="detailsStatRight">
            <div id="download_link"></div>
          </div>
        </div>
        <br>
        <div>
          <div>
            <div>BLOGGER LINK :</div>
          </div>
          <div>
            <div id="blogger">.....</div>
          </div>
        </div>
      </div>
    </div>';
}


 ?>


<?php
$client = new Google_Client();
$client->setAuthConfig('client_secrets.json');
$client->addScope('https://www.googleapis.com/auth/blogger');
$client->addScope('https://www.googleapis.com/auth/youtube');
$client->setAccessType("offline");

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
	if ($client->isAccessTokenExpired()) {
	    session_destroy();
        $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php';
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
	}


  if (isset($id_workshop) && $id_workshop) {
      Get_info($id_workshop);
      echo '<script language="javascript">
      document.getElementById("progress").innerHTML="<div style=\"width:100%;background-color:#ddd;\">&nbsp;</div>";
      document.getElementById("size").innerHTML="Download xong.";
      </script>
      </body>
      </html>';

  } else {
	    print("<pre>".print_r($_SESSION['access_token'],true)."</pre>");
  }

} else {
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
?>

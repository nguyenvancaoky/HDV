<?php
session_start();
include './lib/function.php';

$id = $_GET['id'];
$data = Check_post($id);

if ($data == 0) {
  echo 0;
} else {
  echo $data['url'];
}

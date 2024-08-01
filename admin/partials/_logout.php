<?php
require '_connectFile.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $Url = $_POST['current_url'];
  session_destroy();
  header('location: /forum/admin');
} else {
  redirectTo("/forum/");
}



<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'bytebox';
$Technicalerror = '<div class="alert mt-2 alert-warning alert-dismissible fade show" role="alert">
  <strong>Error!</strong> Sorry we are facing some technical issues.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
$successMsg = '<div class="alert mt-2 alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Operation executed successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
$conn = mysqli_connect($servername,$username,$password,$db);
if(!$conn){
    die('Connection was not successful!');
}else{
  // echo $successMsg;
}
$br = '<br>';
$hr = '<hr>';
function myerror($msg){
  echo '<div class="alert mb-0 alert-warning alert-dismissible fade show" role="alert">
  <strong>Error!</strong> '.$msg.'.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
function mysuccess($msg){
  echo '<div class="alert mb-0 alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> '.$msg.'.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
function userSelect($id){
  global $conn;
  $sql = "SELECT * FROM users WHERE id = '$id'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  return $row['username'];
}
function redirectTo($url){
  echo "<script>window.location.href='$url';</script>";
}
function checkThreadActivity($UserId) {
  global $conn;
  $sql = "SELECT * FROM users WHERE id = $UserId";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  if($row['threads_activity'] == '1'){
    return true;
  }
  else
    return false;
  }
function checkCommentsActivity($UserId) {
  global $conn;
  $sql = "SELECT * FROM users WHERE id = $UserId";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  if($row['comments_activity'] == '1'){
    return true;
  }
  else
    return false;
  }
function addThread($UserId){
  global $conn;
  $sql = "SELECT * FROM users WHERE id = $UserId";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $currThreads = $row['threads_posted'];
  $currThreads = (int)$currThreads;
  $currThreads++;
  $sql = "UPDATE `users` SET `threads_posted` = '$currThreads' WHERE `users`.`id` = '$UserId';";  
  $result = mysqli_query($conn,$sql);
  return $currThreads;  
}
function addComment($UserId){
  global $conn;
  $sql = "SELECT * FROM users WHERE id = $UserId";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $currThreads = $row['comments_posted'];
  $currThreads = (int)$currThreads;
  $currThreads++;
  $sql = "UPDATE `users` SET `comments_posted` = '$currThreads' WHERE `users`.`id` = '$UserId';";
  $result = mysqli_query($conn,$sql);
  return $result && 2==2;  
}

?>
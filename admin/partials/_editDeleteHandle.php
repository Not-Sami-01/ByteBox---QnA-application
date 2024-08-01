<?php
require './_connectFile.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Delete actions
  if (isset($_POST['delUrl'], $_POST['delType'], $_POST['delId'])) {
    $url = $_POST['delUrl'];
    $type = $_POST['delType'];
    $id = $_POST['delId'];
    switch ($type) {
      case 'user':
        $sql = "DELETE FROM users WHERE `id` = '$id'";
        break;
      case 'thread':
        $sql = "DELETE FROM threads WHERE `thread_id` = '$id'";
        break;
      case 'comment':
        $sql = "DELETE FROM comments WHERE `comment_id` = '$id'";
        break;
      default:
        redirectTo('/forum/admin');
    }
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $dest = connUrl($url, 'del=true');
      redirectTo($dest);
    } else {
      $dest = connUrl($url, 'del=false');
      redirectTo($dest);
    }
  }
  // Edit User Actions
  if (isset($_POST['newUserId'], $_POST['newUsername'], $_POST['newPassword'], $_POST['url'])) {
    $url = $_POST['url'];
    $currId = $_POST['currUserId'];
    $newUserId = $_POST['newUserId'];
    $newUsername = $_POST['newUsername'];
    $password = $_POST['newPassword'];
    if ($password == null || $password == '' || $password == ' ') {
      $sql = "UPDATE users SET `username` = '$newUsername', `id` = '$newUserId' WHERE `id` = '$currId'";
    }else{
      $password = password_hash($password, PASSWORD_DEFAULT);
      $sql = "UPDATE users SET `username` = '$newUsername', `id` = '$newUserId', `password` = '$password' WHERE `id` = '$currId';";
    }
    $result = mysqli_query($conn, $sql);
    // echo $sql;
    if ($result) {
      $dest = connUrl($url, 'edit=true');
      redirectTo($dest);
    } else {
      $dest = connUrl($url, 'edit=false');
      redirectTo($dest);
    }
  }

  // Edit Thread Actions
  if (isset($_POST['newThreadId'], $_POST['newThreadTitle'], $_POST['newThreadDescription'], $_POST['url'])) {
    $url = $_POST['url'];
    $id = $_POST['id'];
    $newThreadId = $_POST['newThreadId'];
    $newThreadTitle = $_POST['newThreadTitle'];
    $newThreadDescription = $_POST['newThreadDescription'];
    $title = mysqli_real_escape_string($conn, $newThreadTitle);
    $desc = mysqli_real_escape_string($conn, $newThreadDescription);
    $sql = "UPDATE `threads` 
    SET 
      `thread_id` = '$newThreadId', 
      `thread_title` = '$title', 
      `thread_description` = '$desc' 
    WHERE 
      `thread_id` = '$id';";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $dest = connUrl($url, 'edit=true');
      redirectTo($dest);
    } else {
      $dest = connUrl($url, 'edit=false');
      redirectTo($dest);
    }
  }

  // Edit Comment Actions
  if (isset($_POST['newCommentId'], $_POST['newCommentContent'], $_POST['url'])) {
    $url = $_POST['url'];
    $id = $_POST['id'];
    $newCommentId = $_POST['newCommentId'];
    $newCommentContent = $_POST['newCommentContent'];
    $comment = mysqli_real_escape_string($conn, $newCommentContent);
    $sql = "UPDATE `comments` 
    SET 
      `comment_id` = '$newCommentId', 
      `comment_content` = '$comment'
    WHERE 
      `comment_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $dest = connUrl($url, 'edit=true');
      redirectTo($dest);
    } else {
      $dest = connUrl($url, 'edit=false');
      redirectTo($dest);
    }
  }



} else {
  redirectTo('/forum/admin');
}
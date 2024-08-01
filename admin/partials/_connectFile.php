<?php
session_start();


function connUrl($url, $params)
{
    if (substr($url, -1) == '?') {
        $newUrl = $url.$params;
    }elseif(count(explode('?',$url)) > 1){
        $newUrl = "$url&$params";
    }else{
        $newUrl = "$url?$params";
    }
    return $newUrl;
}

//  Login check
function loginCheck()
{
    if (isset($_SESSION['Admin_loggedin']) && isset($_SESSION['Admin_loginType'])) {
        if ($_SESSION['Admin_loginType'] == 'admin') {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

$conn = mysqli_connect('localhost', 'root', '', 'bytebox');
if ($conn) {
} else {
    die('Some error occured!');
}

// Functions and common variables
function myerror($msg)
{
    echo '<div class="alert mb-0 alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $msg . '.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
function mysuccess($msg)
{
    echo '<div class="alert mb-0 alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> ' . $msg . '.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
$br = '<br>';
$hr = '<hr>';
function getUsername($id)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['username'];
}
// Activity switches
function setCommentActivity($id, $val, $selfUrl, $userId = null)
{
    global $conn;
    $sql = "UPDATE `comments` SET `comment_activity` = '$val' WHERE `comments`.`comment_id` = $id;";
    $result = mysqli_query($conn, $sql);
    if ($userId == null) {
        redirectTo($selfUrl . '?comments=all');
    } else {
        redirectTo($selfUrl . '?userdetails=' . $userId . '&type=comments');
    }
}
function setThreadActivity($id, $val, $selfUrl, $userId = null)
{
    global $conn;
    $sql = "UPDATE `threads` SET `thread_activity` = '$val' WHERE `threads`.`thread_id` = $id;";
    $result = mysqli_query($conn, $sql);
    if ($userId == null) {
        redirectTo($selfUrl . '?threads=all');
    } else {
        redirectTo($selfUrl . '?userdetails=' . $userId . '&type=threads');
    }
}
function setUserThreadActivity($id, $val, $selfUrl)
{
    global $conn;
    $sql = "UPDATE `users` SET `threads_activity` = '$val' WHERE `users`.`id` = $id;";
    $result = mysqli_query($conn, $sql);
    redirectTo($selfUrl);
}
function setUserCommentActivity($id, $val, $selfUrl)
{
    global $conn;
    $sql = "UPDATE `users` SET `comments_activity` = '$val' WHERE `users`.`id` = $id;";
    $result = mysqli_query($conn, $sql);
    
    redirectTo($selfUrl);
}
function setUserLoginActivity($id, $val, $selfUrl)
{
    global $conn;
    $sql = "UPDATE `users` SET `login_activity` = '$val' WHERE `users`.`id` = $id;";
    $result = mysqli_query($conn, $sql);
    redirectTo($selfUrl);
}

function activity($currentStatus, $category, $id, $type = null)
{
    $url = $_SERVER['REQUEST_URI'];
    if ($category == 'user') {
        $url = $url . '?';
    } else {
        $url = $url . '&';
    }
    if ($type != null) {
        if ($currentStatus == '1') {
            return '<a href="' . $url . $category . 'Id=' . $id . '&type=' . $type . '&val=false" class="btn btn-primary btn-sm">Active</a>';
        } else {
            return '<a href="' . $url . $category . 'Id=' . $id . '&type=' . $type . '&val=true" class="btn btn-secondary btn-sm">Inactive</a>';
        }
    }
    if ($currentStatus == '1') {
        return '<a href="' . $url . $category . 'Id=' . $id . '&val=false" class="btn btn-primary btn-sm">Active</a>';
    } else {
        return '<a href="' . $url . $category . 'Id=' . $id . '&val=true" class="btn btn-secondary btn-sm">Inactive</a>';
    }
}

// For specific user details
function userDetailsActivity($currentStatus, $category, $id, $udid)
{
    $url = $_SERVER['REQUEST_URI'];
    $url = $url . '&';
    if ($currentStatus == '1') {
        return '<a href="' . $url . $category . 'Id=' . $id . '&val=false&udid=' . $udid . '" class="btn btn-primary btn-sm">Active</a>';
    } else {
        return '<a href="' . $url . $category . 'Id=' . $id . '&val=true&udid=' . $udid . '" class="btn btn-secondary btn-sm">Inactive</a>';
    }
}

function getCategory($id)
{
    global $conn;
    $sql = "SELECT * FROM categories WHERE categories_id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['categories_name'];
}
function redirectTo($url)
{
    echo "<script>window.location.href='$url';</script>";
}
?>
<?php require 'partials/_header.php'; ?>
<?php require 'partials/_sideBar.php'; ?>
<?php require 'partials/_modals.php'; ?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['del'])){
        $del = $_GET['del'];
        if($del == 'true'){
            mysuccess('Entry deleted successfully');
        }else{
            myerror('Cannot delete the entry');
        }
    }
    if(isset($_GET['edit'])){
        $edit = $_GET['edit'];
        if($edit == 'true'){
            mysuccess('Entry updated successfully');
        }else{
            myerror('Cannot update the entry');
        }
    }
    
}




$url = $_SERVER['REQUEST_URI'];
$CurrUrl = $_SERVER['PHP_SELF'];

if (!loginCheck()) {
    redirectTo('/forum/admin/login.php');
}



if ($_SERVER['REQUEST_METHOD'] == "GET") {

    // Activity Actions~

    // User Activity Actions
    if (isset($_GET['userId'], $_GET['type'], $_GET['val'])) {
        $userId = $_GET['userId'];
        $type = $_GET['type'];
        if ($_GET['val'] == 'true') {
            $val = '1';
        } else if ($_GET['val'] == 'false') {
            $val = '0';
        } else
            redirectTo($_SERVER['PHP_SELF']);
        if ($type == '1') {
            setUserLoginActivity($userId, $val, $CurrUrl);
        } else if ($type == '2') {
            setUserThreadActivity($userId, $val, $CurrUrl);
        } else if ($type == '3') {
            setUserCommentActivity($userId, $val, $CurrUrl);
        }
    }

    // Thread Activity Actions
    if (isset($_GET['threadId'], $_GET['val'])) {
        $threadId = $_GET['threadId'];
        if ($_GET['val'] == 'true') {
            $val = '1';
        } else if ($_GET['val'] == 'false') {
            $val = '0';
        } else {
            redirectTo($_SERVER['PHP_SELF']);
        }
        if (isset($_GET['udid'])) {
            setThreadActivity($threadId, $val, $CurrUrl, $_GET['udid']);
        } else {
            setThreadActivity($threadId, $val, $CurrUrl);
        }
    }

    // Comment Activity Actions
    if (isset($_GET['commentId'], $_GET['val'])) {
        $commentId = $_GET['commentId'];
        if ($_GET['val'] == 'true') {
            $val = '1';
        } else if ($_GET['val'] == 'false') {
            $val = '0';
        } else {
            redirectTo($_SERVER['PHP_SELF']);
        }

        if (isset($_GET['udid'])) {
            setCommentActivity($commentId, $val, $CurrUrl, $_GET['udid']);
        } else {
            setCommentActivity($commentId, $val, $CurrUrl);
        }
    }

// Tables display

    // For threads display
    if (isset($_GET['threads'])) {
        $threadType = $_GET['threads'];
        if ($threadType == 'all') {
            $condition = "";
            $heading = 'All Threads';
        } else if ($threadType == 'active') {
            $condition = "WHERE `thread_activity` = '1'";
            $heading = 'Active Threads';
        } else if ($threadType == 'inactive') {
            $heading = 'Inactive Threads';
            $condition = "WHERE `thread_activity` = '0'";
        } else {
            redirectTo($_SERVER['PHP_SELF']);
        }

        // Table Query
        $sql = "SELECT * FROM threads $condition";
        $result = mysqli_query($conn, $sql);
        echo
            '<div class="container" id="content">
<h3 class="text-center mt-4">
    ' . $heading . '
</h3>
<div class="container">
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Thread title</th>
                <th scope="col">Thread Content</th>
                <th scope="col">Thread user</th>
                <th scope="col">Thread Activity</th>
                <th scope="col">DateTime</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <tr>
                <th scope="row">' . $row['thread_id'] . '</th>
                <td>' . $row['thread_title'] . '</td>
                <td>' . $row['thread_description'] . '</td>
                <td>' . getUsername($row['thread_user_id']) . '</td>
                <td class="text-center">' . activity($row['thread_activity'], 'thread', $row['thread_id']) . '</td>
                <td>' . $row['datetime'] . '</td>
                <td class="text-center">
                    <button type="button" class="btn btn-outline-primary btn-sm edit-thread" data-bs-toggle="modal" data-bs-target="#EditThreadModal">Edit</button>
                    <button type="button" class="btn btn-outline-danger btn-sm delete-thread" data-bs-toggle="modal" data-bs-target="#DeleteEntry">Del</button>
                </td>
            </tr>
            ';
        }
    }


    // For Comments display
    else if (isset($_GET['comments'])) {
        $commentType = $_GET['comments'];
        if ($commentType == 'all') {
            $condition = "";
            $heading = 'All comments';
        } else if ($commentType == 'active') {
            $condition = "WHERE `comment_activity` = '1'";
            $heading = 'Active comments';
        } else if ($commentType == 'inactive') {
            $heading = 'Inactive comments';
            $condition = "WHERE `comment_activity` = '0'";
        } else {
            redirectTo($_SERVER['PHP_SELF']);
        }

        // Table Query
        $sql = "SELECT * FROM comments $condition";
        $result = mysqli_query($conn, $sql);
        echo
            '<div class="container" id="content">
<h3 class="text-center mt-4">
' . $heading . '
</h3>
<div class="container">
<table class="table" id="myTable">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Comment</th>
            <th scope="col">Comment user</th>
            <th scope="col">Comment Activity</th>
            <th scope="col">DateTime</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
        <tr>
            <th scope="row">' . $row['comment_id'] . '</th>
            <td>' . $row['comment_content'] . '</td>
            <td>' . getUsername($row['comment_user_id']) . '</td>
            <td class="text-center">' . activity($row['comment_activity'], 'comment', $row['comment_id']) . '</td>
            <td>' . $row['comment_time'] . '</td>
            <td class="text-center">
                <button type="button" class="btn btn-outline-primary btn-sm edit-comment" data-bs-toggle="modal" data-bs-target="#EditCommentModal">Edit</button>
                <button type="button" class="btn btn-outline-danger btn-sm delete-comment" data-bs-toggle="modal" data-bs-target="#DeleteEntry">Del</button>
            </td>
        </tr>
        ';
        }
    }

    // For specific user details
    else if (isset($_GET['userdetails'], $_GET['type'])) {
        $id = $_GET['userdetails'];
        $type = $_GET['type'];
        $username = getUsername($id);
        $heading = strtoupper($username[0]) . substr($username, 1) . " Details";
        $threadsCondition = "WHERE thread_user_id = $id";
        $commentsCondition = "WHERE comment_user_id = $id";
        $threadSql = "SELECT * FROM threads $threadsCondition";
        $commentSql = "SELECT * FROM comments $commentsCondition";
        $threadResult = mysqli_query($conn, $threadSql);
        $commentResult = mysqli_query($conn, $commentSql);

        // Threads Table 
        echo
            '<div class="container" id="content">
    <h2 class="text-center mt-4">
        ' . $heading . '
    </h2>
    <br>';
        if ($type == 'threads') {
            echo '<h4 class="text-center mt-4 fw-bold"> Threads Posted by ' . strtoupper($username[0]) . substr($username, 1) . '</h4>
        <div class="container">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Activity</th>
                        <th scope="col">Date Time</th>
                    </tr>
                </thead>
                <tbody>';
            while ($row = mysqli_fetch_assoc($threadResult)) {
                echo '
                <tr>
                    <td>' . $row['thread_title'] . '</td>
                    <td>' . $row['thread_description'] . '...</td>
                    <td class="text-center">' . userDetailsActivity($row['thread_activity'], 'thread', $row['thread_id'], $id) . '</td>
                    <td>' . $row['datetime'] . '</td>
                </tr>
                ';
            }
        } else if ($type == 'comments') {
            echo '<h4 class="text-center mt-4 fw-bold"> Comments Posted by ' . strtoupper($username[0]) . substr($username, 1) . '</h4>
        <div class="container">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">Coment Content</th>
                        <th scope="col">Activity</th>
                        <th scope="col">Date Time</th>
                    </tr>
                </thead>
                <tbody>';
            while ($row = mysqli_fetch_assoc($commentResult)) {
                echo '
                <tr>
                    <td>' . $row['comment_content'] . '...</td>
                    <td class="text-center">' . userDetailsActivity($row['comment_activity'], 'comment', $row['comment_id'], $id) . '</td>
                    <td>' . $row['comment_time'] . '</td>
                </tr>
                ';
            }
        } else {
            redirectTo('/forum/admin');
        }
    }


    // For users display
    else {
        $heading = 'All Users';
        $table = "users";
        $condition = "";
        if (isset($_GET['users'])) {
            if ($_GET['users'] == 'active') {
                $condition = " WHERE `login_activity` = '1'";
                $heading = 'Active Users';
            } else if ($_GET['users'] == 'inactive') {
                $heading = 'Inactive Users';
                $condition = "WHERE `login_activity` = '0'";
            } else {
                redirectTo($_SERVER['PHP_SELF']);
            }
        }
        echo
            '<div class="container" id="content">
    <h3 class="text-center mt-4">
        ' . $heading . '
    </h3>
    <div class="container">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Username</th>
                    <th scope="col">Threads Posted</th>
                    <th scope="col">Comments Posted</th>
                    <th scope="col">Thread Activity</th>
                    <th scope="col">Comments Activity</th>
                    <th scope="col">Login Activity</th>
                    <th scope="col" class="px-1"> Actions </th>
                </tr>
            </thead>
            <tbody>';

        // Table Query
        $sql = "SELECT * FROM $table $condition";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <th scope="row">' . $row['id'] . '</th>
                    <td><a class="text-dark nav-link" href="' . $CurrUrl . '?userdetails=' . $row['id'] . '&type=threads' . '">' . $row['username'] . '</a></td>
                    <td>' . $row['threads_posted'] . '</td>
                    <td>' . $row['comments_posted'] . '</td>
                    <td class="text-center">' . activity($row['threads_activity'], 'user', $row['id'], '2') . '</td>
                    <td class="text-center">' . activity($row['comments_activity'], 'user', $row['id'], '3') . '</td>
                    <td class="text-center">' . activity($row['login_activity'], 'user', $row['id'], '1') . '</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-primary btn-sm edit-user" data-bs-toggle="modal" data-bs-target="#EditUserModal">Edit</button>
                        <button type="button" class="btn btn-outline-danger btn-sm delete-user" data-bs-toggle="modal" data-bs-target="#DeleteEntry">Del</button>
                    </td>
                </tr>
                    ';
        }
    }
}



echo '</tbody>
</table>
</div>
</div>';

?>
<?php require 'partials/_footer.php'; ?>
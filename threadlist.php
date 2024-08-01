<?php require 'partials/_connfile.php';
if (isset($_GET['catid'])) {
    $pageId = $_GET['catid'];
    if($_GET['catid']==''){
        echo ('<h1 class="text-center mt-5">Bad GateWay! We are unable to connect please try again');
        die('Go to home page and try again</h1>');
    }
        $id = $_GET['catid'];
        $mysql = "SELECT * FROM `categories` WHERE `categories_id`=$id;";
        $result = mysqli_query($conn, $mysql);
        $row = mysqli_fetch_assoc($result);
        $catName = $row['categories_name'];
        $catDesc = $row['categories_description'];
    } else {
    echo ('<h1 class="text-center mt-5">Bad GateWay! We are unable to connect please try again');
    die('Go to home page and try again</h1>');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="https://img.icons8.com/?size=100&id=rc9b7BNSMFwF&format=png&color=000000"
        type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bytebox - Ask anything about coding</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require 'partials/_header.php'; ?>
    <div class="container my-4 bg-secondary text-light rounded p-3">
        <div class="jumbotron">
            <h1 class="display-4">
                Welcome to <?php echo $catName; ?>
            </h1>
            <p class="lead">
                <?php echo $catDesc; ?>
            </p>
            <hr class="my-4">
            <h4>Rules:</h4>
            <ul>
                <li>
                    Never post personal information about another forum participant. Their name if they have done so or
                    providing personal contact information. </li>
                <li>
                    Don't post anything that could be considered intolerant of a person's race, culture, appearance,
                    gender, preference, religion or age.</li>
                <li>
                    Don't be obscene and don't use foul language. Disguising swear words by deliberately misspelling
                    them
                    doesn't make them any less offensive.</li>
                <li>
                    Don't personally insult or harass other participants. Focus on your substantive comments and not on
                    to choose not to enter into debate with you.</li>
            </ul>

            <?php

            echo '<a target="_blank" class="btn btn-primary btn-lg" href="https://en.wikipedia.org/wiki/' . $catName . '" role="button">Learn more</a>'
                ?>

        </div>
    </div>
    <hr>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['threadTitle'], $_POST['threadDescription'])) {
            $threadTitle = $_POST['threadTitle'];
            $threadDescription = $_POST['threadDescription'];
            if ($threadTitle != null && $threadDescription != null) {
                
                $threadTitle = str_replace('<','&lt;',$threadTitle);
                $threadTitle = str_replace('>','&gt;',$threadTitle);
                $threadDescription = str_replace('<','&lt;',$threadDescription);
                $threadDescription = str_replace('>','&gt;',$threadDescription);
                $escapedTitle = mysqli_real_escape_string($conn, $threadTitle);
                $escapedDescription = mysqli_real_escape_string($conn, $threadDescription);
                if($threadActivity = checkThreadActivity($myUserId)){
                    $activity = '1';
                }else{
                    $activity = '0';
                }
                
                $sql = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_user_id`, `thread_cat_id`, `thread_activity`) VALUES ('$escapedTitle', '$escapedDescription', '$myUserId', '$id',$activity)";
                $result = mysqli_query($conn, $sql);
                addThread($myUserId);
                if ($result) {
                    if($threadActivity){
                        mysuccess('Thread posted successfully, Please wait for the community to response');
                    }else{
                        myerror('Access denied, Your threads will not be visible publically!');
                    }
                } else {
                    myerror('Some error occured');
                }
            } else {
                myerror('Form fields are not set!');

            }

        }
    }
    echo '<div class="container">
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
    <h1 class=" p-1">Ask a question:</h1>
    <div class="mb-3">
    <div class="form-floating">
    <input class="form-control" autocomplete="off" name="threadTitle" placeholder="Leave a comment here"
    id="floatingTextarea">
    <label for="floatingTextarea" class="text-muted">Title...</label>
    </div>
    <div id="emailHelp" class="form-text">Keep your question short and crisp.</div>
    </div>
    <div class="mb-3">
    <div class="form-floating">
    <textarea class="form-control" name="threadDescription" placeholder="Leave a comment here"
    id="floatingTextarea"></textarea>
    <label for="floatingTextarea" class="text-muted">Elaborate your concern...</label>
    </div>
    </div>';
    if ($check) {
        echo '<button type="submit" class="btn btn-primary">Submit</button>';
    } else {
        echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#LoginpopupModal">Submit</button>';

    }
    echo '</form>
        </div>';
    ?>
    <hr>
    <div class="container" style="min-height:233px;">
        <h1 class=" p-1">Problems and solutions:</h1>
        <?php
        $i = true;
        $result = mysqli_query($conn, "SELECT * FROM `threads` WHERE `thread_cat_id` ='$id' AND thread_activity = '1'");
        while ($row = mysqli_fetch_assoc($result)) {
            if(!$i){
                echo $hr;
            }
            $i = false;
            $id = $row['thread_user_id'];
            echo '<div class="media">
                <div class="media-body">
                    <img src="https://picsum.photos/300/300?random=' . $id . '" data-bs-toggle="modal" data-bs-target="#userInfo" style="border-radius:50%;float:left;margin-right:8px;"width="28px" class="mr-3" alt="@' . userSelect($id) . '" title="@' . userSelect($id) . '">
                    <h5 class="ml-3 mt-0 pt-1" ><a class="text-dark" href="thread.php?threadid=' . $row['thread_id'] . '&ud=' . $id . '">' . $row['thread_title'] . '</a></h5>
                    ' . substr($row['thread_description'], 0, 400) . '...
                </div>
            </div>';
        }
        echo '<br>';
        if ($i) {
            echo '<div class="container  p-1"><h3 class="text-center mt-2">No questions found!</h3>';
            echo '<p class="text-center fs-6">Be the one to share your problems</p> </div>';
        }
        ?>

    </div>
    <?php require 'partials/_footer.php' ?>

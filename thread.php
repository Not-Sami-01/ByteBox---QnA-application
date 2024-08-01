<?php require 'partials/_connfile.php'; ?>
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
    <link rel="stylesheet" href="mystyle.css">
</head>

<body>
    <?php require 'partials/_header.php';
    // if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['threadid']) && isset($_GET['ud'])) {
            $id = $_GET['threadid'];
            $ud = $_GET['ud'];
            $sql = "SELECT * FROM threads WHERE thread_id = $id;";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $thread_title = $row['thread_title'];
            $thread_description = $row['thread_description'];
        }else{
            echo ('<h1 class="text-center mt-5">Bad GateWay! We are unable to connect please try again');
            die('Go to home page and try again</h1>');
        }
    // }else{
    //     echo ('<h1 class="text-center mt-5">Bad GateWay! We are unable to connect please try again');
    //     die('Go to home page and try again</h1>');
    // }
    ?>
    <div class="container my-4 bg-secondary text-light rounded p-3">
        <div class="jumbotron">
            <img src="https://picsum.photos/300/300?random=1" class=""
                style="border-radius:50%;float:left;margin-right:8px;" width="30px" class="mr-3"
                title="@<?php echo userSelect($ud); ?>" alt="@<?php echo userSelect($ud); ?>">
            <h6 class="pt-2"><a class="text-light" href="#">@<?php echo userSelect($ud); ?></a></h6>
            <h1 class="display-4 ml-0">
                <!-- Problem: -->
                <?php echo $thread_title; ?>
            </h1>
            <h5 class="lead">
                <?php echo $thread_description; ?>
            </h5>
            <hr class="my-4">
            <h6>Note:</h6>
            <p>
                When answering questions on Bytebox, focus on providing accurate, well-informed responses backed by
                credible sources or personal knowledge. Adhere to community guidelines by avoiding plagiarism and citing
                sources when necessary.
            </p>
        </div>
    </div>
    <hr>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['comment'])) {
            $comment = $_POST['comment'];
            if ($comment != null) {
                $comment = str_replace('<','&lt;',$comment);
                $comment = str_replace('>','&gt;',$comment);
                $commentContent = mysqli_real_escape_string($conn, $comment);
                if($commentActivity = checkCommentsActivity($myUserId)){
                    $activity = '1';
                }else{
                    $activity = '0';
                }
                $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_user_id`, `comment_activity`) VALUES ('$commentContent', '$id', '$myUserId', $activity);";
                $result = mysqli_query($conn, $sql);
                addComment($myUserId);
                if ($result) {
                    if($commentActivity){
                        mysuccess('Comment posted successfully!');
                    }else{
                        myerror('Access denied, Your comments will not be visible publically!');
                    }
                } else {
                    myerror('Some error occured');
                }
            } else {
                myerror('Form fields are empty!');
            }
        } else {
            myerror('Form fields are empty!');
        }
    }



    ?>
    <div class="container">
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <h1 class=" p-1">Post a comment:</h1>
            <div class="my-3">
                <div class="form-floating">
                    <textarea class="form-control" name="comment" placeholder="Leave a comment here"
                        id="floatingTextarea"></textarea>
                    <label for="floatingTextarea" class="text-muted">Enter comment...</label>
                </div>
            </div><?php
            if ($check)
                echo '<button type="submit" class="btn btn-primary">Submit</button>';
            else
                echo '<button type="button" data-bs-toggle="modal" data-bs-target="#LoginpopupModal" class="btn btn-primary">Submit</button>';
            ?>
        </form>
    </div>
    <hr>
    <div class="container" style="min-height:233px;">
        <h1 class="text-dark p-1">Discussion:</h1>
        <?php
        $threadid = $_GET['threadid'];
        // echo $threadid;
        $sql = "SELECT * FROM comments WHERE thread_id = $threadid AND comment_activity = '1';";
        $result = mysqli_query($conn, $sql);
        $i = true;
        while ($row = mysqli_fetch_assoc($result)) {

            $id = $row['comment_user_id'];
            if(!$i){
                echo $hr;
            }
            $i = false;
            echo '<div class="media">
                <div class="media-body">
                    <img src="https://picsum.photos/300/300?random=' . $id . '" style="border-radius:50%;float:left;margin-right:8px;"width="28px" class="mr-3 pt-1" title = "@' . userSelect($id) . '" alt="@' . userSelect($id) . '" >
                    <a href="" type="button"  data-bs-toggle="modal" data-bs-target="#userInfo" class=" my-0 text-secondary">@' . userSelect($id) . '</a>
                    <p>' . $row['comment_content'] . '</p>
                </div>
            </div>';
        }
        if($i){
            echo '<div class="container  p-1"><h3 class="text-center mt-2">No comments found!</h3>';
            echo '<p class="text-center fs-6">Be the one to start the discussion</p> </div>';
        }

        ?>


    </div>
    <?php require 'partials/_footer.php' ?>

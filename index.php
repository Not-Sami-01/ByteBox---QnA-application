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
    <?php
    if (session_status() === PHP_SESSION_NONE)
    session_start();

require 'partials/_header.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['signup'])) {
        if ($_GET['signup'] == 'true') {
            mysuccess('Account created successfully, now you can login to our website');
            redirectTo($_SERVER['PHP_SELF']);
        } else if ($_GET['signup'] == 'false') {
            $error = $_GET['error'];
            switch ($error) {
                case '0':
                    myerror('Some error occured');
                    break;
                    case '1':
                        myerror('Username has already been taken');
                        break;
                        case '2':
                            myerror('Passwords do not match');
                            break;
                            case 'sp':
                                myerror('You are logged in with an Admin account so you can\'t signup here');
                                break;
                                default:
                                myerror('Some error occured');
                                break;
                            }
                        }
                    } else if (isset($_GET['login'])) {
            if ($_GET['login'] == 'true' && $_SESSION['loggedin'] = true && isset($_SESSION['username'])) {
                mysuccess('Logged in successfully');
            } else if ($_GET['login'] == 'false' && isset($_GET['access'])) {
                myerror('Access denied, Your account has been deactivated');
            } else if ($_GET['login'] == 'false') {
                myerror('Invalid credentials');
            } else if ($_GET['login'] == 'sp') {
                myerror('You are logged in with an Admin account so you can\'t login here');
            }
        }
    }
    ?>

    <!-- Carausal - Slider -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://picsum.photos/2400/900?random=1" class="d-block w-100" alt="Carausel Image 1">
            </div>
            <div class="carousel-item">
                <img src="https://picsum.photos/2400/900?random=2" class="d-block w-100" alt="Carausel Image 2">
            </div>
            <div class="carousel-item">
                <img src="https://picsum.photos/2400/900?random=3" class="d-block w-100" alt="Carausel Image 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Using a for loop to iterate between categories -->
    <div class="container">
        <div class="row">


            <?php
            $sql = 'SELECT * FROM categories';
            $result = mysqli_query($conn, $sql);
            $i = 4;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col my-3">
                <div class=" card mx-auto" style="width: 18rem;">
                <img src="https://picsum.photos/1600/1000?random=' . $i . '" class=" card-img-top" alt="'. $row['categories_name'] .'">
                <div class="card-body ">
                <h5 href="threads.php" class=" card-title">' . $row['categories_name'] . '</h5>
                <p class="card-text ">' . substr($row['categories_description'], 0, 60) . '...</p>
                <a href="threadlist.php?catid=' . $row['categories_id'] . '" class=" btn btn-primary">View Threads</a>
                </div>
                </div>
                </div>
                ';
                $i++;
            }
            
            ?>
        </div>
    </div>
    <?php require 'partials/_footer.php' ?>

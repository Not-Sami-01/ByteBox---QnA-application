<?php require 'partials/_connectFile.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="https://img.icons8.com/?size=100&id=rc9b7BNSMFwF&format=png&color=000000"
        type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="../mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Bytebox</title>
</head>

<body>
    <header>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/forum/admin">Bytebox - Admin</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <?php if (loginCheck()) {
                            echo '<a href="/forum/admin/addAdmin.php" class="nav-link active">Add admin</a>';
                        } ?>

                    </li>
                    
                </ul>
                <span class="nav-item">
                        <?php
                        if($_SERVER['REQUEST_METHOD'] == 'GET'){
                            if(isset($_GET['type'],$_GET['userdetails'])){
                                $id = $_GET['userdetails'];
                                $type = $_GET['type'];
                                if($type == 'comments'){
                                    echo '<a class="btn btn-sm btn-outline-primary " href="'.$_SERVER['PHP_SELF'].'?userdetails='.$id.'&type=threads">Threads</a>';
                                }else if($type == 'threads'){
                                    echo '<a class="btn btn-sm btn-outline-primary " href="'.$_SERVER['PHP_SELF'].'?userdetails='.$id.'&type=comments">Comments</a>';
                                }
                            }
                        }
                        ?>
                    </span>
                <?php

                if (loginCheck()) {
                    echo '<button class="btn btn-sm btn-outline-danger mx-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Logout</button>';
                    echo '<h6 class="mt-1" title="username" > | ' . strtoupper($_SESSION['Admin_username'][0]) . substr($_SESSION['Admin_username'], 1) . '</h6>';
                }


                ?>

            </div>
        </nav>
    </header>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Are you sure?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    You want to logout from this website?
                    <form action="partials/_logout.php" method="post">
                        <input type="hidden" name="current_url" value="' . $_SERVER['REQUEST_URI'] . '">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
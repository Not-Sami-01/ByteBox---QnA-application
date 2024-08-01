<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    if (session_status() === PHP_SESSION_NONE){session_start();}
    $url = $_POST['current_url'];
    $des = session_destroy();
    session_unset();
    header('location: '.$url);

}
else{
    header('location: ../');
}

?>
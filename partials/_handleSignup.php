<?php
try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require '_connfile.php';
        // if(isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['cpass'])){
        $username = strtolower($_POST['username']);
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];
        if ($pass == $cpass) {
            $sql = "SELECT * FROM users WHERE username = '$username';";
            $result = mysqli_query($conn, $sql);
            $exists = false;
            if (mysqli_num_rows($result) == 1) {
                $exists = true;
            }
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            if (!$exists) {
                $sql = "INSERT INTO `users` (`username`, `password`,`datetime`) VALUES ( '$username', '$hash', current_timestamp());";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    header('location: ../index.php?signup=true');
                } else {
                    header('location: ../index.php?signup=false&error=0');
                    // Some error occured
                }
            } else {
                header('location: ../index.php?signup=false&error=1');
                // Username has already been taken!
            }
        } else {
            header('location: ../index.php?signup=false&error=2');
            // Passwords do not match
        }
    } else {
        header('location: ../index.php?signup=false&error=3');
        // Some error occured
    }
}catch(Exception $e){
    header('location: ../index.php?signup=false&error=69');
}
// }else{
//     myerror('Error no 5');
// }


?>
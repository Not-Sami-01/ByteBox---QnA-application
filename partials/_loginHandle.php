<?php
try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require '_connfile.php';
        if (isset($_POST['myusername']) && isset($_POST['mypassword'])) {
            $username = strtolower($_POST['myusername']);
            $pass = $_POST['mypassword'];
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $verPass = $row['password'];
                $verify = password_verify($pass, $verPass);
                echo var_dump($verify);
                if ($verify) {
                    if($row['login_activity'] == '1'){
                        if (session_status() === PHP_SESSION_NONE)
                            session_start();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['username'] = $username;
                        $_SESSION['usernameId'] = $row['id'];
                        // session_unset();
                        header('location: ../index.php?login=true');
                    }else{
                        header('location: ../index.php?login=false&access=false');
                        // myerror('Access denied');
                    }
                } else {
                    // myerror('error 1');
                    header('location: ../index.php?login=false');
                }
            } else {
                // myerror('error 2');
                header('location: ../index.php?login=false');
            }
        }
    }

} catch (Exception $e) {
    header('location: ../index.php?login=false');
}

?>
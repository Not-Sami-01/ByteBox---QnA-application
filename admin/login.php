<?php require 'partials/_header.php'; ?>
<?php
if (isset($_SESSION['Admin_loggedin']) && isset($_SESSION['Admin_loginType'])) {
    if ($_SESSION['loginType'] == 'admin') {
        header('location: /forum/admin');
    } else {
        session_destroy();
        redirectTo('/forum/admin/login.php');
    }
} else {
    session_destroy();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['adminUsername'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM admins WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == '1') {
        $row = mysqli_fetch_assoc($result);
        $hash = $row['password'];
        $verify = password_verify($password, $hash);
        if ($verify) {
            if (session_status() === PHP_SESSION_NONE)
                session_start();
            $_SESSION['Admin_loggedin'] = true;
            $_SESSION['Admin_loginType'] = 'admin';
            $_SESSION['Admin_username'] = $username;
            header('location: /forum/admin');
        } else {
            myerror('Invalid password');
        }
    } else {
        myerror('Invalid username');
    }
}


?>

<div class="container">
    <h1 class="text-center mt-4">Login to continue</h1>
    <form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="adminUsername" id="username" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Never share your username or password with anyone.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control password" >
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input showPassword">
            <label class="form-check-label" for="exampleCheck1">Show Password</label>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>


<?php require 'partials/_footer.php'; ?>
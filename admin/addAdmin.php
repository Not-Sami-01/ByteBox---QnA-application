<?php require 'partials/_header.php'; ?>
<?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['adminUsername'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $sql = "SELECT * FROM admins WHERE `username` = '$username'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == '1'){
            myerror('Username is already in use');
        }else{
            if($cpassword == $password){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `admins` (`username`, `password`, `activity`) VALUES ('$username', '$hash', '1');";
                $result = mysqli_query($conn, $sql);
                if($result){
                    mysuccess('Admin added successfully');
                }else{
                    myerror('Some error occured');
                }
            }else{
                myerror('Passwords do not match');
            }
        }
    }
    
    
?>

<div class="container">
    <h1 class="text-center mt-4">Add a new admin</h1>
    <form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="adminUsername" id="username" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Never share this username or password with unauthorized person.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control password" id="">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
            <input type="password" name="cpassword" class="form-control password" id="signupConfirmPassword">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input showPassword" id="">
            <label class="form-check-label" for="exampleCheck1">Show Password</label>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<?php require 'partials/_footer.php'; ?>

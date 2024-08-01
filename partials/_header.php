<?php
// $pageId = "";   
if (session_status() === PHP_SESSION_NONE)
    session_start();
function checkLoginActivity(){
    global $conn;
$check = 
    $check = isset($_SESSION['username']) && $_SESSION['loggedin'] == true;
    if($check){
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if($row['login_activity'] == '1'){
            return true;
        }else{
            session_destroy();
            myerror('Your account has been disabled');
            return false;
        }
    }
}
$check = checkLoginActivity();
if ($check && isset($_SESSION['usernameId'])) {
    $username = $_SESSION['username'];
    $myUserId = $_SESSION['usernameId'];
}else{
    // session_destroy();
}
if(isset($pageId)){
    $val = $pageId;
}else{
    $val = "";
}

$lsbuttons = '<button type="button" class="btn btn-sm btn-outline-success mx-2"  data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
<button type="button" class="btn btn-sm btn-outline-success mr-2"  data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>';
$logoutbtn = '<button class="btn btn-sm btn-outline-danger mx-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Logout</button>';

echo '<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="/forum">Bytebox</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="max-height:40px;">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/forum">Home</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Categories
        </a>
        <ul class="dropdown-menu">';
$sql = 'SELECT * FROM categories';
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo '<li><a class="dropdown-item" href="threadlist.php?catid=' . $row['categories_id'] . '">' . $row['categories_name'] . '</a></li>';
}
echo '</ul>
    </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="contact.php" >Contact</a>
                </li>
                </ul>';
                // Search bar
echo '<form class="d-flex" role="search" method="get" action="search.php">
<input class="p-0 m-0" value="'.$val.'" name="idofpage" type="hidden" >
<input class="form-control px-2 me-2"style="min-width:180px;" name="query" type="query" placeholder="Search" aria-label="Search">
<button class="btn btn-success" type="reset">Search</button>
</form>';
if ($check) {
    echo $logoutbtn;
    echo '<strong title="Username" class="text-light fs-6 m-1">|&nbsp; ';
    echo strtoupper(substr($username, 0, 1)) . substr($username, 1, strlen($username));
    echo '</strong>';

}

if (!$check) {
    echo $lsbuttons;
}
echo '</div>
    </div>
</nav>';
include '_loginModal.php';
include '_signupModal.php';
// Logout modal
echo '<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Are you sure?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                You want to logout from this website?
                <form action ="partials/_logout.php" method="post">
                <input type="hidden" name="current_url" value="' . $_SERVER['REQUEST_URI'] . '">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit"  class="btn btn-danger">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>';
// Login Popup modal
echo '<div class="modal fade" id="LoginpopupModal" tabindex="-1" aria-labelledby="LoginpopupModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="LoginpopupModal">You are not logged in!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                Login is required to post something on our website
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            </div>
        </div>
    </div>
</div>';

?>


<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="signupModalLabel">Signup </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- signup Form -->
                <form action="partials/_handleSignup.php" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" required name="username" autocomplete="off" class="form-control"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" required autocomplete="off" name="pass" class="form-control password">
                    </div>
                    <div class="mb-1">
                        <label for="exampleInputPassword1" class="form-label">Confirm password</label>
                        <input type="password" required autocomplete="off" name="cpass" class="form-control password">
                        <div id="emailHelp" class="form-text">Make sure both passwords match.</div>
                    </div>
                    <div class="mb-1 form-check">
                        <input type="checkbox" class="form-check-input showPassword">
                        <label class="form-check-label" for="">Show password</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Signup</button>
            </div>
            </form>
        </div>
    </div>
</div>
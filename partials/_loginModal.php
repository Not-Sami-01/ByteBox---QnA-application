<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="loginModalLabel">Login</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="partials/_loginHandle.php">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control" autocomplete="on" name="myusername"  aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">If you don't have an account then click on signup.</div>
                    </div>
                    <div class="mb-1">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="mypassword" autocomplete="off" class="form-control password">
                    </div>
                    <div class="mb-1 form-check">
                        <input type="checkbox" class="form-check-input showPassword">
                        <label class="form-check-label" for="exampleCheck1">Show password</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            </form>
        </div>
    </div>
</div>
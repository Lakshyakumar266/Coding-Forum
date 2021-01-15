<!-- Modal -->
<div class="modal fade" id="signupmodal" tabindex="-1" aria-labelledby="signupmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupmodalLabel">Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/forum/parcials/_handelsignup.php" method="post" class="modal-body">
                <div class="flex mb-3">
                    <label for="inputName3" class="form-label">Name</label>
                    <div class="col-sm-15">
                        <input type="Name" name="SignupName" class="form-control" id="inputName3">
                    </div>
                </div>
                <div class="flex mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-20">
                        <input type="password" name="SignupPassword" class="form-control" id="password">
                    </div>
                </div>
                <div class="flex mb-3">
                    <label for="cpassword" class="form-label">cenform Password</label>
                    <div class="col-sm-20">
                        <input type="password" name="SignupCpassword" class="form-control" id="cpassword">
                    </div>
                </div>
                <div class="flex mb-3">
                    <div class="col-sm-20">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck1">
                            <label class="form-check-label" for="gridCheck1">
                                Rember Me.
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
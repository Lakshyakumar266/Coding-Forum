<!-- Modal -->
<div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginmodalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/forum/parcials/_handlelogin.php" method="post">
                <div class="modal-body">
                    <div class="flex mb-3">
                        <label for="loginname" class="form-label">Name</label>
                        <div class="col-sm-15">
                            <input type="Name" class="form-control" name="loginname" id="loginname">
                        </div>
                    </div>
                    <div class="flex mb-3">
                        <label for="loginpass" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-20">
                            <input type="password" class="form-control" name="loginpass" id="loginpass">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">LogIn</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
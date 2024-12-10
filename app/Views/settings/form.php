<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-body">
                <h5 class="card-title">Update Password</h5>
                <?php
                $msg = session()->getFlashdata('msg');
                if (isset($msg)) {
                ?>


                    <div class="card-header">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <?php echo $msg ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>

                <?php } ?>
                <form action="<?php echo base_url() . 'update' ?>" method="post">

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Current Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="current" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="new" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="confirm" required>
                        </div>
                    </div>

                    <div class="d-flex flex-row mt-5 mb-2 border-top py-2">
                        <button class="btn btn-primary btn-sm" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
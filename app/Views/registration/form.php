<div class="row">
    <div class="col-lg-12">
        <div class="card">
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

            <div class="card-body" id="pdfContent">
                <h5 class="card-title">Register Student</h5>

                <form action="<?php echo base_url() . 'register' ?>" method="post">


                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Juan" name="fname" required>
                                <label for="floatingInput">First Name</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Dela Cruz" name="lname" required>
                                <label for="floatingInput">Last Name</label>
                            </div>
                        </div>

                        <div class="col-1">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Juan" name="mname">
                                <label for="floatingInput">MI</label>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-2 mb-4 border-top border-bottom py-3">

                        <div class="col">
                            <div class="form-floating mt-3">
                                <select class="form-select" id="floatingSelect" name="courseID">

                                    <?php foreach ($courses as $d) { ?>
                                        <option value="<?php echo $d->id ?>"><?php echo $d->name ?></option>
                                    <?php } ?>
                                </select>
                                <label for="floatingSelect">Course</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mt-3">
                                <select class="form-select" id="floatingSelect" name="nstpID">
                                    <?php
                                    $f = $nstp_courses[0];

                                    ?>
                                    <?php foreach ($nstp_courses as $d) { ?>
                                        <option value="<?php echo $d->id ?>"><?php echo $d->name ?></option>
                                    <?php } ?>

                                </select>
                                <label for="floatingSelect">NSTP</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-floating mt-3">
                                <select class="form-select" id="floatingSelect" name="platoon">
                                    <option value="0">N/A</option>
                                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php  } ?>

                                </select>
                                <label for="floatingSelect">Platoon</label>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-floating mt-3">
                                <select class="form-select" id="floatingSelect" name="gender">
                                    <option value="1" selected>Male</option>
                                    <option value="0">Female</option>
                                </select>
                                <label for="floatingSelect">Gender</label>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-floating mt-3">
                                <select class="form-select" id="floatingSelect" name="section">

                                    <option selected="A">A</option>
                                    <?php for ($i = ord('A'); $i <= ord('Z'); $i++) { ?>
                                        <option value="<?php echo chr($i) ?>"><?php echo chr($i) ?></option>
                                    <?php  } ?>

                                </select>
                                <label for="floatingSelect">Section</label>
                            </div>
                        </div>





                    </div>

                    <div class="row mt-3">
                        <div class="col-6 ">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" name="rfid" required>
                                <label for="floatingInput">RFID</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label for="inputDate" class="col-sm-2 col-form-label">Birthdate</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="birthdate" required>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-5">
                        <div class="d-flex flex-row justify-content-center">
                            <button class="btn-sm btn btn-primary p-2">Register</button>
                        </div>
                    </div>
                </form>

            </div>


        </div>
    </div>
</div>
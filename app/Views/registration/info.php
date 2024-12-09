<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-body" id="pdfContent">
                <h5 class="card-title">Personal Information</h5>
                <form action="<?php echo site_url('registration/update') ?>" method="post">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">First</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="fname" value="<?php echo $student->fname ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Middle</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="mname" value="<?php echo $student->mname ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Last</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="lname" value="<?php echo $student->lname ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputDate" class="col-sm-2 col-form-label">Birthdate</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="birthdate" value="<?php echo $birthdate ?>" required>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="gender">
                                <option value="1" <?php echo $student->gender == 1 ? 'selected' : '' ?>> Male </option>
                                <option value="0" <?php echo $student->gender == 0 ? 'selected' : '' ?>> Female </option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Section</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="section">

                                <?php for ($i = ord('A'); $i <= ord('Z'); $i++) { ?>
                                    <option value="<?php echo chr($i) ?>" <?php echo (ord($student->section) == $i) ? 'selected' : '' ?>><?php echo chr($i) ?></option>
                                <?php  } ?>
                            </select>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Course</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="courseID">
                                <?php foreach ($courses as $c) { ?>
                                    <option value="<?php echo $c->id ?>" <?php echo $course->id == $c->id ? 'selected' : '' ?>> <?php echo $c->name ?> </option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">NSTP</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="nstpID">
                                <?php foreach ($nstp_courses as $c) { ?>
                                    <option value="<?php echo $c->id ?>" <?php echo $course->id == $nstp->id ? 'selected' : '' ?>> <?php echo $c->name ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Platoon</label>
                        <div class="col-sm-10">

                            <select class="form-select" name="platoon">

                                <option value="0" <?php echo $student->platoon == null ? 'selected' : '' ?>> N/A </option>
                                <?php for ($i = 1; $i <= 10; $i++) { ?>
                                    <option value="<?php echo $i ?>" <?php echo $student->platoon == $i ? 'selected' : '' ?>> <?php echo $i ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">RFID</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="rfid" value="<?php echo $student->rfid ?>">
                        </div>
                    </div>

                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" name="orig_rfid" value="<?php echo $student->rfid ?>">
                    </div>



                    <div class="container-fluid d-flex flex-row flex-start mt-5">
                        <button class="btn btn-success btn-sm" type="submit">Update</button>
                    </div>
                </form>





            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
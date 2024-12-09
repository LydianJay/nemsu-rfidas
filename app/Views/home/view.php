<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Attendance</h5>
            </div>
            <div class="card-body" id="pdfContent">

                <form action="" method="get" class="my-5">
                    <div class="row">

                        <div class="col-4">
                            <div class="form-floating mt-3">
                                <select class="form-select" id="floatingSelect" name="course">

                                    <?php if (isset($course)) { ?>
                                        <option value="0">Unfilter</option>
                                        <?php foreach ($courses as $c) { ?>
                                            <option value="<?php echo $c->id; ?>" <?php echo $course == $c->id ? 'selected' : '' ?>><?php echo $c->name ?></option>
                                        <?php  } ?>

                                    <?php } else { ?>
                                        <option value="0" selected>Unfilter</option>
                                        <?php foreach ($courses as $c) { ?>
                                            <option value="<?php echo $c->id; ?>"><?php echo $c->name ?></option>
                                        <?php  } ?>

                                    <?php } ?>



                                </select>
                                <label for="floatingSelect">Course</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating mt-3">
                                <select class="form-select" id="floatingSelect" name="nstp">
                                    <option value="0">Unfilter</option>
                                    <?php if (isset($nstp)) { ?>

                                        <?php foreach ($nstp_courses as $c) { ?>
                                            <option value="<?php echo $c->id; ?>" <?php echo $nstp == $c->id ? 'selected' : '' ?>><?php echo $c->name ?></option>
                                        <?php  } ?>

                                    <?php } else { ?>

                                        <?php foreach ($nstp_courses as $c) { ?>
                                            <option value="<?php echo $c->id; ?>"><?php echo $c->name ?></option>
                                        <?php  } ?>

                                    <?php } ?>



                                </select>
                                <label for="floatingSelect">NSTP</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-floating mt-3">
                                <select class="form-select" id="floatingSelect" name="platoon">

                                    <?php if (isset($plat)) { ?>
                                        <option value="0">Unfilter</option>
                                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                                            <option value="<?php echo $i ?>" <?php echo $i == $plat ? 'selected' : '' ?>> <?php echo $i ?></option>
                                        <?php  } ?>

                                    <?php } else { ?>
                                        <option value="0" selected>Unfilter</option>
                                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                                            <option value="<?php echo $i ?>"> <?php echo $i ?></option>
                                        <?php  } ?>

                                    <?php } ?>

                                </select>
                                <label for="floatingSelect">Platoon</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-floating mt-3">
                                <select class="form-select" id="floatingSelect" name="month">
                                    <?php if (isset($month)) { ?>

                                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                                            <option value="<?php echo $i; ?>" <?php echo $month == $i ? 'selected' : ''; ?>> <?php echo date('M', mktime(0, 0, 0, $i)) ?> </option>
                                        <?php  } ?>
                                    <?php } else { ?>

                                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                                            <option value="<?php echo $i; ?>" <?php echo date('n') == $i ? 'selected' : ''; ?> ><?php echo date('M', mktime(0, 0, 0, $i)) ?></option>
                                        <?php  } ?>

                                    <?php } ?>

                                </select>
                                <label for="floatingSelect">Month</label>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <button class="btn btn-primary btn-sm" type="submit">Apply Filter</button>
                        </div>
                    </div>

                </form>



                <table class="table table-striped datatable border-top" id="mytable">
                    <thead>
                        <tr>
                            <?php foreach ($table_head as $head) { ?>
                                <th> <?php echo $head ?> </th>

                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $last = null; ?>
                        <?php foreach ($data as $d) { ?>

                            <?php if ($last != $d->rfid) { ?>
                                <tr>
                                    <th> <?php echo strtoupper(dechex($d->rfid)) ?> </th>
                                    <th> <?php echo $d->lname ?> </th>
                                    <th> <?php echo $d->fname ?> </th>
                                    <th> <?php echo $d->mname ?> </th>
                                    <th> <?php echo $d->gender == 1 ? 'Male' : 'Female' ?> </th>
                                    <th> <?php echo $d->course_name ?> </th>
                                    <th> <?php echo $d->nstp_name ?> </th>
                                    <th> <?php echo $d->platoon ?> </th>
                                    <?php $idx = 0; ?>
                                    <?php foreach ($saturdays as $s) { ?>


                                        <?php if (isset($grouped[$d->rfid][intval($s)])) { ?>
                                            <?php $t = $grouped[$d->rfid][intval($s)]; ?>
                                            <th>
                                                <?php if (isset($t[0])) {  ?>
                                                    <i class="bi bi-check text-success fs-2"></i>
                                                <?php } else { ?>
                                                    <i class="bi bi-x text-danger fs-2"></i>
                                                <?php } ?>
                                            </th>
                                            <th>
                                                <?php if (isset($t[1])) {  ?>
                                                    <i class="bi bi-check text-success fs-2"></i>
                                                <?php } else { ?>
                                                    <i class="bi bi-x text-danger fs-2"></i>
                                                <?php } ?>
                                            </th>
                                        <?php } else { ?>
                                            <th> <i class="bi bi-x text-danger fs-2"></i> </th>
                                            <th> <i class="bi bi-x text-danger fs-2"></i> </th>
                                        <?php } ?>

                                    <?php } ?>





                                    <?php $last = $d->rfid; ?>

                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary btn-sm" onclick="tocsv()">CSV</button>
            </div>
        </div>
    </div>
</div>
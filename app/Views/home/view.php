<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Attendance</h5>
            </div>
            <div class="card-body" id="pdfContent">

                <form action="" method="get" class="my-5">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-floating mt-3">
                                <select class="form-select" id="floatingSelect" name="month">

                                    <?php if (isset($month)) { ?>
                                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                                            <option value="<?php echo $i; ?>" <?php echo $month == $i ? 'selected' : ''; ?>> <?php echo date('M', mktime(0, 0, 0, $i)) ?> </option>
                                        <?php  } ?>
                                    <?php } else { ?>

                                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                                        <option value="<?php echo $i; ?>" <?php echo date('n') === $i ? '' : 'selected'; ?>><?php echo date('M', mktime(0, 0, 0, $i)) ?></option>
                                    <?php  } ?>

                                    <?php } ?>

                                </select>
                                <label for="floatingSelect">Month</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary btn-sm" type="submit"><?php echo $month ?></button>
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

                        <?php foreach ($data as $d) { ?>
                            <tr>
                                <th> <?php echo strtoupper(dechex($d->rfid)) ?> </th>
                                <th> <?php echo $d->lname ?> </th>
                                <th> <?php echo $d->fname ?> </th>
                                <th> <?php echo $d->mname ?> </th>
                                <th> <?php echo $d->gender == 1 ? 'Male' : 'Female' ?> </th>
                                <th> <?php echo $d->course_name ?> </th>
                                <th> <?php echo $d->nstp_name ?> </th>
                                <th> <?php echo $d->platoon ?> </th>
                                <?php
                                for ($i = 0; $i < 12; $i++) {
                                ?>
                                    <th> <?php echo in_array($d->day, $saturdays) ? 'P' : 'A'; ?> </th>
                                <?php } ?>

                            </tr>
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
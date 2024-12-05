<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body" id="pdfContent">
                <h5 class="card-title">Attendance</h5>
                <table class="table table-striped datatable" id="mytable">
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
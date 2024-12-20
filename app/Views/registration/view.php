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
                <h5 class="card-title">Students</h5>
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
                            <tr class="clickable" onclick="window.location.href=`<?php echo site_url('userinfo') . '/' . $d->rfid; ?>`;">
                                <th> <?php echo strtoupper($hex[$d->rfid]) ?> </th>
                                <th> <?php echo $d->lname ?> </th>
                                <th> <?php echo $d->fname ?> </th>
                                <th> <?php echo $d->mname ?> </th>
                                <th> <?php echo $d->gender == 1 ? 'Male' : 'Female' ?> </th>
                                <th> <?php echo $d->course_name ?> </th>
                                <th> <?php echo $d->nstp_name ?> </th>
                                <th> <?php echo $d->section ?> </th>
                            </tr>
                        <?php } ?>

                    </tbody>

                </table>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <button class="btn btn-primary btn-sm" onclick="tocsv()">CSV</button>

                    </div>
                    <div class="col d-flex flex-row justify-content-end">
                        <form action="<?php echo base_url() . 'registration/form' ?>" method="get">
                            <button class="btn btn-info btn-sm" type="submit">Add <span><i class="bi bi-person-plus"></i></span> </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
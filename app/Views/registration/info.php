<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body" id="pdfContent">
                <h5 class="card-title">Personal Information</h5>

                <div class="row">
                    <div class="col border border-dark rounded mx-5">
                        <p class="fs-5 fw-bold mb-0">NAME: <span class="fw-normal opacity-7"><?php echo $student->fname . ' ' . $student->mname . ' ' . $student->lname;  ?></span> </p>
                    </div>
                    <div class="col border border-dark rounded mx-5">
                        <p class="fs-5 fw-bold">Gender: <span class="fw-normal opacity-7"><?php echo $student->gender == 1 ? 'Male' : 'Female';  ?></span> </p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col border border-dark rounded mx-5">
                        <p class="fs-5 fw-bold mb-0">Course: <span class="fw-normal opacity-7"><?php echo $course->name;  ?></span> </p>
                    </div>
                    <div class="col border border-dark rounded mx-5">
                        <p class="fs-5 fw-bold">NSTP: <span class="fw-normal opacity-7"><?php echo $nstp->name;  ?></span> </p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col border border-dark rounded mx-5">
                        <p class="fs-5 fw-bold mb-0">Birthdate: <span class="fw-normal opacity-7"><?php echo $student->bmonth . '/' . $student->bday . '/' . $student->byear;  ?></span> </p>
                    </div>
                    <div class="col border border-dark rounded mx-5">
                        <p class="fs-5 fw-bold">Section: <span class="fw-normal opacity-7"><?php echo $student->section;  ?></span> </p>
                    </div>
                </div>


            </div>
            <div class="card-footer">
                
            </div>
        </div>
    </div>
</div>
</section>
        </main><!-- End #main -->

        <!-- ======= Footer ======= -->
        <footer id="footer" class="footer">
            <!-- <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
            </div>
        </footer><!-- End Footer -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="<?php echo base_url() . 'niceadmin' ?>/assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="<?php echo base_url() . 'niceadmin' ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url() . 'niceadmin' ?>/assets/vendor/chart.js/chart.umd.js"></script>
        <script src="<?php echo base_url() . 'niceadmin' ?>/assets/vendor/echarts/echarts.min.js"></script>
        <script src="<?php echo base_url() . 'niceadmin' ?>/assets/vendor/quill/quill.js"></script>
        <script src="<?php echo base_url() . 'niceadmin' ?>/assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="<?php echo base_url() . 'niceadmin' ?>/assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="<?php echo base_url() . 'niceadmin' ?>/assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="<?php echo base_url() . 'niceadmin' ?>/assets/js/main.js"></script>

        <script>
            document.getElementById('download').addEventListener('click', async function() {
                console.log('Clicked!');
                let elem = document.getElementById('pdfContent');


                let fname = "form";
                let fileName = fname.concat('.pdf');

                var opt = {
                    margin: 0,
                    pagebreak: {
                        mode: ['avoid-all', 'css', 'legacy']
                    },
                    filename: fileName,
                    image: {
                        type: 'png'
                    },
                    html2canvas: {
                        scale: 2,
                        scrollY: 0,
                        scrollX: 0,
                    },
                    jsPDF: {
                        unit: 'mm',
                        format: 'a4',
                        orientation: 'p'
                    }
                };
                await html2pdf().set(opt).from(elem).toPdf().save();
            });
        </script>

        </body>

        </html>
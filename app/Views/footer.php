<!-- <p class="fs-5 fw-bold text-secondary text-center">This project is still in development</p> -->
</section>
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <!-- <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
    <!-- </div> -->
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
        let elem = document.getElementById('mytable');


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


    function tocsv(table_id = "mytable", separator = ",") {
        // Select rows from table_id
        var rows = document.querySelectorAll("table#" + table_id + " tr");
        // Construct csv
        var csv = [];
        // Looping through the table
        for (var i = 0; i < rows.length; i++) {
            var row = [],
                cols = rows[i].querySelectorAll("td, th");
            // Looping through the tr
            for (var j = 0; j < cols.length; j++) {
                var cell = cols[j];
                var data = "";

                // Check for icons and replace them with appropriate text
                if (cell.querySelector("i") || cell.querySelector("svg")) {
                    // Example logic to handle font-awesome or custom icons
                    if (cell.innerHTML.includes("bi-check") || cell.innerHTML.includes("checkmark")) {
                        data = "O";
                    } else if (cell.innerHTML.includes("bi-x") || cell.innerHTML.includes("x")) {
                        data = "X";
                    } else {
                        data = ""; // Default for unrecognized icons
                    }
                } else {
                    // If no icons, get text content
                    data = cell.innerText;
                }

                // Remove extra whitespace and escape double quotes
                data = data.replace(/(\r\n|\n|\r)/gm, "").replace(/(\s\s)/gm, " ");
                data = data.replace(/"/g, `""`);

                // Push escaped string
                row.push(`"` + data + `"`);
            }
            csv.push(row.join(separator));
        }
        var csv_string = csv.join("\n");

        // Download it
        var filename = "attendance_" + "<?php echo date('F-Y') ?>" + ".csv";
        var link = document.createElement("a");
        link.style.display = "none";
        link.setAttribute("target", "_blank");
        link.setAttribute("href", "data:text/csv;charset=utf-8," + encodeURIComponent(csv_string));
        link.setAttribute("download", filename);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>

</body>

</html>
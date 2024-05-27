<div class="box-card mb-4">
    <button type="button" onclick="window.location = '<?= base_url('view_result.php') ?>'" style="float:left;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Back</button>
    <center>
        <h3><?= $title ?></h3>
    </center>
    <button type="button" onclick="printDi('printarea')" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
</div>
<div class="box-card">
    <div id="printarea">
        <div style="color:#1c5fa8;">
            <center>
                <h3 style="font-family: Montserrat;font-weight: bold;">Northern University</h3>
                <h6 style="font-family: Montserrat;font-weight: bold;">Result of <?=$type?></h6>
            </center>
        </div><br>
        <table class="table table-bordered">
            <tr>
                <td><span><b>Department</b>: <b><?= $department ?></b></span></td>
                <td><span><b>Program</b>: <b><?= $program ?></b></span></td>
                <td><span><b>Session</b>: <b><?= $session ?></b></span></td>
                <td><span><b>Semester</b>: <b><?= $semester ?></b></span></td>
                <td><span><b>Section</b>: <b><?= $section ?></b></span></td>
            </tr>
        </table>
        <table class="table table-striped table-bordered">

        </table>
    </div>
</div>
<script type="text/javascript">
    function printDi(printarea) {
        var printContents = document.getElementById(printarea).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<script>
    $(document).ready(function () {
        $('#view_result').addClass('activemenu');
    });
</script>
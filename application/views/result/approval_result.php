<div class="box-card mb-4">
    <h3><?= $title ?></h3>
    <button type="button" onclick="window.location = '<?= base_url('semester_result_information.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Back</button>
</div>
<div class="box-card">
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="<?= base_url('admin/approved_semester_result_information') ?>">
                <input type="hidden" name="result_id" value="<?= $ranscript->result_id ?>">
                <table class="table table-bordered">
                    <tr>
                        <td><span><b>Department</b>: <b><?= $ranscript->department ?></b></span></td>
                        <td><span><b>Program</b>: <b><?= $ranscript->program ?></b></span></td>
                        <td><span><b>Session</b>: <b><?= $ranscript->session ?></b></span></td>
                        <td><span><b>Semester</b>: <b><?= $ranscript->semester ?></b></span></td>
                        <td><span><b>Section</b>: <b><?= $ranscript->section ?></b></span></td>
                    </tr>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Credit Hour</th>
                            <th>Grade Letter</th>
                            <th>Grade Point</th>
                            <th>TGP</th>
                            <th>Result For</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#</td>
                            <td><?= $ranscript->student_no ?><br><?= $ranscript->student_name ?></td>
                            <td><?= $ranscript->subject_code ?></td>
                            <td><?= $ranscript->subject_title ?></td>
                            <td><?= $ranscript->subject_credit ?></td>
                            <td><?= $ranscript->letter ?></td>
                            <td><?= $ranscript->point ?></td>
                            <td><?= $ranscript->cgpa ?></td>
                            <td><?= $ranscript->result_type ?></td>
                        </tr>
                    </tbody>
                </table><br>
                <?php
                if ($ranscript->approved_status == 0) {
                    ?>
                    <center>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure ?')" style="border-radius:20px"><i class="fa fa-check-circle"></i> Approve</button>
                    </center> 
                <?php } ?>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#result_information').addClass('activemenu');
    });
</script>
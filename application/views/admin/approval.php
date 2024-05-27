<?php
if (@$semester_reg_info->is_approve == 1) {
    @$advisorinfo = $this->Universal_model->get_advisor_info($semester_reg_info->sem_reg_info_id);
    @$advisor_name = @$advisorinfo->name;
    @$advisor_contact = @$advisorinfo->contact;
} else {
    @$advisor_name = '';
    @$advisor_contact = '';
}
?>
<div class="box-card mb-4">
    <h3><?= $title ?></h3>
    <?php
    if ($this->session->userdata('role') == 1) {
        ?>
        <button type="button" onclick="window.location = '<?= base_url('semester_registrations.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Back</button>
    <?php } ?>
</div>
<div class="box-card">
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="<?= base_url('admin/approved_semester_registration') ?>" name="getformdata">
                <div class="row">
                    <div class="col-md-3">
                        <input type="hidden" name="sem_reg_info_id" value="<?= $semester_reg_info->sem_reg_info_id ?>">
                        <p>Department: <b><?= $semester_reg_info->department ?></b></p>
                    </div>
                    <div class="col-md-3">
                        <p>Program: <b><?= $semester_reg_info->program ?></b></p>
                    </div>
                    <div class="col-md-3">
                        <p>Session: <b><?= $semester_reg_info->session ?></b></p>
                    </div>
                    <div class="col-md-3">
                        <p>Semester: <b><?= $semester_reg_info->semester_no ?></b></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <p>Total Credit Hours: <b><?= $semester_reg_info->total_credit ?></b></p>
                    </div>
                    <div class="col-md-4">
                        <p>Advisor Name: <b><?= @$advisor_name ?></b></p>
                    </div>
                    <div class="col-md-4">
                        <p>Contact Number: <b><?= @$advisor_contact ?></b></p>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover m-b-0 c_list">
                                <tbody>
                                    <tr>
                                        <th>Check</th>
                                        <th>Course Code</th>
                                        <th>Course Title</th>
                                        <th>Credit Hour</th>
                                        <th>Section</th>
                                    </tr>
                                    <?php
                                    $i = 1;
                                    foreach ($registration_subjects as $value) {
                                        ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $value->course_code ?></td>
                                            <td><?= $value->course_title ?></td>
                                            <td><?= $value->credit_hour ?></td>
                                            <?php
                                            if ($semester_reg_info->is_approve == 0) {
                                                ?>
                                                <td>
                                                    <input type="hidden" name="sem_reg_id[]" value="<?= $value->sem_reg_id ?>">
                                                    <select name="section[]" class="form-control">
                                                        <option value="<?= $value->section ?>"><?= $value->section ?></option>
                                                        <?php foreach (get_sections() as $value) { ?>
                                                            <option value="<?= $value->name ?>"><?= $value->name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            <?php } else { ?>
                                                <td><?= $value->section ?></td>
                                            <?php } ?>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><br>
                <?php if ($semester_reg_info->is_approve == 0) { ?>
                    <div class="row">
                        <div class="col-md-4">
                            <p>Is Approved ?</p>
                            <select name="is_approve" class="form-control mb-3" required="">
                                <option value="">Select Status</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <p>Advisor:</p>
                            <select name="approved_by" class="form-control mb-3" required="">
                                <option value="">Select Advisor</option>
                                <?php foreach (get_teachers() as $value) { ?>
                                    <option value="<?= $value->ts_id ?>"><?= $value->name ?> => <?= $value->department ?> => <?= $value->program ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div><br>
                    <center>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure ?')" style="border-radius:20px"><i class="fa fa-check-circle"></i> Approve</button>
                    </center> 
                <?php } ?>
            </form>
        </div>
    </div>
</div>
<?php
if ($this->session->userdata('role') == 1) {
    ?>
    <script>
        $(document).ready(function () {
            $('#semester_registrations').addClass('activemenu');
        });
    </script>
<?php } else { ?>
    <script>
        $(document).ready(function () {
            $('#advised_students').addClass('activemenu');
        });
    </script>
<?php } ?>
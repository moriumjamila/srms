<div class="box-card mb-4">
    <h3><?= $title ?></h3>
    <button type="button" onclick="window.location = '<?= base_url('result_information.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i>Back</button>
</div>
<div class="box-card">
    <form method="get" action="<?= base_url('make_semester_result') ?>" name="getformdata">
        <div class="row">
            <div class="col-md-3">
                <label>Department <span style="color: red">*</span></label>
                <select name="department" class="form-control" required="">
                    <option value="">Select Department</option>
                    <?php foreach (get_departments() as $value) { ?>
                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <label>Program <span style="color: red">*</span></label>
                <select name="program" class="form-control" required="">
                    <option value="">Select Program</option>
                    <?php foreach (get_programs() as $value) { ?>
                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <label>Sessions <span style="color: red">*</span></label>
                <select name="session" class="form-control" required="">
                    <option value="">Select Session</option>
                    <?php foreach (get_sessions() as $value) { ?>
                        <option value="<?= $value->name ?>-<?= date('Y') ?>"><?= $value->name ?>-<?= date('Y') ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <label>Semesters <span style="color: red">*</span></label>
                <select name="semester" class="form-control" required="">
                    <option value="">Select semester</option>
                    <?php foreach (get_semesters() as $value) { ?>
                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-3">
                <label>Result For <span style="color: red">*</span></label>
                <select name="type" class="form-control" required="">
                    <option value="">Select Type</option>
                    <option value="Mid">Mid</option>
                    <option value="Final">Final</option>
                </select>
            </div>
        </div>
        <br>
        <center>
            <button type="submit" name="submit" value="submit" class="btn btn-primary" style="border-radius:20px"><i class="fa fa-search"></i> Search</button>
        </center> 
    </form>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped getTable" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center">SL No.</th>
                            <th style="text-align:center">Student ID</th>
                            <th style="text-align:center">Student Name</th>
                            <th style="text-align:center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($results as $value) {
                            ?>
                            <tr style="text-align:center">
                                <td><?= $i; ?></td>
                                <td><?= $value->id_no ?></td>
                                <td><?= $value->name ?></td>
                                <td>
                                    <a href="<?= base_url('make_student_result/' . $value->sem_reg_info_id) ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.forms['getformdata'].elements['department'].value = '<?= $this->session->userdata('get_department') ?>';
    document.forms['getformdata'].elements['program'].value = '<?= $this->session->userdata('get_program') ?>';
    document.forms['getformdata'].elements['session'].value = '<?= $this->session->userdata('get_session') ?>';
    document.forms['getformdata'].elements['semester'].value = '<?= $this->session->userdata('get_semester') ?>';
    document.forms['getformdata'].elements['type'].value = '<?= $this->session->userdata('get_type') ?>';
</script>
<script>
    $(document).ready(function () {
        $('#result_information').addClass('activemenu');
    });
</script>
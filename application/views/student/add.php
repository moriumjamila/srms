<div class="box-card mb-4">
    <h3>Student Registration</h3>
    <button type="button" onclick="window.location = '<?= base_url('student_list.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i>Back</button>
</div>
<div class="box-card">
    <form method="POST" action="<?= base_url('student/save') ?>">
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Student Name <span style="color: red">*</span></label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" placeholder="Enter Full Name" required="">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Contact Number <span style="color: red">*</span></label>
            <div class="col-sm-10">
                <input type="text" oninput="numberOnly(this.id);" id="contact" name="contact" maxlength="11" class="form-control" placeholder="Enter Contact Number" required="">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Email Address <span style="color: red">*</span></label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" placeholder="Enter Email Address" required="">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Father Name <span style="color: red">*</span></label>
            <div class="col-sm-10">
                <input type="text" name="father" class="form-control" placeholder="Enter Father Name" required="">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Address <span style="color: red">*</span></label>
            <div class="col-sm-10">
                <textarea rows="3" style="padding:10px" name="address" class="form-control" placeholder="Enter Address" required=""></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Department <span style="color: red">*</span></label>
            <div class="col-sm-10">
                <select name="department" class="form-control" required="">
                    <option value="">Select Department</option>
                    <?php foreach (get_departments() as $value) { ?>
                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Sessions <span style="color: red">*</span></label>
            <div class="col-sm-10">
                <select name="session" class="form-control" required="">
                    <option value="">Select Session</option>
                    <?php foreach (get_sessions() as $value) { ?>
                        <option value="<?= $value->name ?>-<?= date('Y') ?>"><?= $value->name ?>-<?= date('Y') ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Program <span style="color: red">*</span></label>
            <div class="col-sm-10">
                <select name="program" class="form-control" required="">
                    <option value="">Select Program</option>
                    <?php foreach (get_programs() as $value) { ?>
                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Semesters <span style="color: red">*</span></label>
            <div class="col-sm-10">
                <select name="semester" class="form-control" required="">
                    <option value="">Select semester</option>
                    <?php foreach (get_semesters() as $value) { ?>
                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Sections <span style="color: red">*</span></label>
            <div class="col-sm-10">
                <select name="section" class="form-control" required="">
                    <option value="">Select Section</option>
                    <?php foreach (get_sections() as $value) { ?>
                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div><br>
        <center>
            <button type="reset" class="btn btn-primary" style="border-radius:20px"><i class="fa fa-resolving"></i> Reset</button>
            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure ?')" style="border-radius:20px"><i class="fa fa-save"></i> Save</button>
        </center> 
    </form>
</div>
<script>
    $(document).ready(function () {
        $('#student_list').addClass('activemenu');
    });
</script>
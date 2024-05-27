<div class="box-card mb-4">
    <h3>Edit Teacher Profile</h3>
    <button type="button" onclick="window.location = '<?= base_url('teacher_list.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i>Back</button>
</div>
<?php
$get_teacher_acads = $this->db->where('uniq_id', $get_teacher->uniq_id)->get('teacher_student_acads')->row();
?>
<div class="box-card">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Profile Information</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">User Access</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#semesterUpgrade" type="button" role="tab" aria-controls="semesterUpgrade" aria-selected="false">Semester Upgrade</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form method="POST" action="<?= base_url('teacher/update') ?>" name="getformdata">
                <div class="row mb-3">
                    <input type="hidden" name="data_id" value="<?= $get_teacher->ts_id ?>">
                    <input type="hidden" name="uniq_id" value="<?= $get_teacher->uniq_id ?>">
                    <label class="col-sm-2 col-form-label">Teacher Name <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" placeholder="Enter Full Name" value="<?= $get_teacher->name ?>" required="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Contact Number <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" oninput="numberOnly(this.id);" id="contact" name="contact" maxlength="11" class="form-control" placeholder="Enter Contact Number" value="<?= $get_teacher->contact ?>" required="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Email Address <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" placeholder="Enter Email Address" value="<?= $get_teacher->email ?>" required="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Father Name <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="father" class="form-control" placeholder="Enter Father Name" value="<?= $get_teacher->father ?>" required="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Address <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <textarea rows="3" name="address" class="form-control" placeholder="Enter Address" required=""><?= $get_teacher->address ?></textarea>
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
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure ?')" style="border-radius:20px"><i class="fa fa-check-circle"></i> Update</button>
                </center> 
            </form>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form method="POST" action="<?= base_url('teacher/user_access_update') ?>" name="getformdata2">
                <div class="row mb-3">
                    <input type="hidden" name="data_id" value="<?= $get_teacher->ts_id ?>">
                    <label class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $get_teacher->id_no ?>" readonly="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Status <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <select name="status" class="form-control mb-3" required="">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div><br>
                <center>
                    <button type="submit" class="btn btn-primary" style="border-radius:20px"><i class="fa fa-check-circle"></i> Update</button>
                </center> 
            </form>
            <form method="POST" action="<?= base_url('teacher/user_password_update') ?>">
                <div class="row mb-3">
                    <input type="hidden" name="data_id" value="<?= $get_teacher->ts_id ?>">
                    <label class="col-sm-3 col-form-label">New Password <span style="color: red">*</span></label>
                    <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Confirm Password <span style="color: red">*</span></label>
                    <div class="col-sm-9">
                        <input type="password" name="c_password" class="form-control" placeholder="Enter Confirm Password" required="">
                    </div>
                </div>
                <center>
                    <button type="submit" class="btn btn-primary" style="border-radius:20px"><i class="fa fa-check-circle"></i> Update</button>
                </center> 
            </form>
        </div>
        <div class="tab-pane fade" id="semesterUpgrade" role="tabpanel" aria-labelledby="profile-tab">
            <form method="POST" action="<?= base_url('teacher/upgrade_teacher_info') ?>">
                <input type="hidden" name="data_id" value="<?= $get_teacher->ts_id ?>">
                <input type="hidden" name="old_uniq_id" value="<?= $get_teacher->uniq_id ?>">
                <input type="hidden" name="id_no" value="<?= $get_teacher->id_no ?>">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Department <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $get_teacher->department ?>" readonly="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Program <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $get_teacher->program ?>" readonly="">
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
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure ?')" style="border-radius:20px"><i class="fa fa-check-circle"></i> Upgrade</button>
                </center> 
            </form>
        </div>
    </div>
</div>
<script>
    document.forms['getformdata'].elements['department'].value = '<?= $get_teacher->department ?>';
    document.forms['getformdata'].elements['program'].value = '<?= $get_teacher->program ?>';
    document.forms['getformdata2'].elements['status'].value = '<?= $get_teacher->status ?>';
    document.forms['getformdata'].elements['session'].value = '<?= $get_teacher_acads->session ?>';
    document.forms['getformdata'].elements['semester'].value = '<?= $get_teacher_acads->semester ?>';
    document.forms['getformdata'].elements['section'].value = '<?= $get_teacher_acads->section ?>';
</script>
<script>
    $(document).ready(function () {
        $('#teacher_list').addClass('activemenu');
    });
</script>
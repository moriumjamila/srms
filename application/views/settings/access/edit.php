<div class="box-card mb-4">
    <h3>Edit User Profile</h3>
    <button type="button" onclick="window.location = '<?= base_url('admin_user.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i>Back</button>
</div>
<div class="box-card">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Profile Information</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">User Access</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form method="POST" action="<?= base_url('admin/update') ?>" name="getformdata">
                <div class="row mb-3">
                    <input type="hidden" name="data_id" value="<?= $get_user->ts_id ?>">
                    <label class="col-sm-2 col-form-label">User Name <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" placeholder="Enter Full Name" value="<?= $get_user->name ?>" required="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Contact Number <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" oninput="numberOnly(this.id);" id="contact" name="contact" maxlength="11" class="form-control" placeholder="Enter Contact Number" value="<?= $get_user->contact ?>" required="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Email Address <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" placeholder="Enter Email Address" value="<?= $get_user->email ?>" required="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Department <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <select name="department" class="form-control" required="">
                            <option value="">Select Department</option>
                            <option value="ALL">All</option>
                            <?php foreach (get_departments() as $value) { ?>
                                <option value="<?= $value->name ?>"><?= $value->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <center>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure ?')" style="border-radius:20px"><i class="fa fa-check-circle"></i> Update</button>
                </center> 
            </form>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form method="POST" action="<?= base_url('admin/user_password_update') ?>">
                <div class="row mb-3">
                    <input type="hidden" name="data_id" value="<?= $get_user->ts_id ?>">
                    <label class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="<?= $get_user->id_no ?>" readonly="">
                    </div>
                </div>
                <div class="row mb-3">
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
    </div>
</div>
<script>
    document.forms['getformdata'].elements['department'].value = '<?= $get_user->department ?>';
    document.forms['getformdata'].elements['program'].value = '<?= $get_user->program ?>';
    document.forms['getformdata2'].elements['status'].value = '<?= $get_user->status ?>';

</script>
<script>
    $(document).ready(function () {
        $('#settings').addClass('activemenu');
    });
</script>
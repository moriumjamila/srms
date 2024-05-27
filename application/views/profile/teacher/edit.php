<div class="box-card mb-4">
    <h3>Edit Teacher Profile</h3>
</div>
<div class="box-card">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Information</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Photo</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab" aria-controls="password" aria-selected="false">Change Password</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form method="POST" action="<?= base_url('common/data_update') ?>" name="getformdata">
                <div class="row mb-3">
                    <input type="hidden" name="task_type" value="teacher">
                    <label class="col-sm-2 col-form-label">Full Name <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" placeholder="Enter Full Name" value="<?= $myprofile->name ?>" required="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Contact Number <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="contact" maxlength="11" class="form-control" placeholder="Enter Contact Number" value="<?= $myprofile->contact ?>" required="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Email Address <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" placeholder="Enter Email Address" value="<?= $myprofile->email ?>" required="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Father Name <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="father" class="form-control" placeholder="Enter Father Name" value="<?= $myprofile->father ?>" required="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Address <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <textarea rows="3" name="address" class="form-control" style="padding:10px" placeholder="Enter Address" required=""><?= $myprofile->address ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Department <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <select name="department" class="form-control mb-3" required="">
                            <option value="">Select Department</option>
                            <option value="CSE">CSE</option>
                            <option value="ECSE">ECSE</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Program <span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <select name="program" class="form-control mb-3" required="">
                            <option value="">Select Program</option>
                            <?php foreach (get_programs() as $value) { ?>
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
            <form method="POST" action="<?= base_url('common/photo_update') ?>" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Photo <span style="color: red">*</span></label>
                    <div class="col-sm-5">
                        <input type="hidden" name="task_type" value="teacher">
                        <input type="hidden" name="old_image_data" value="<?= $myprofile->photo ?>">
                        <input type="file" name="data_photo" onchange="getimageData(this);" class="form-control" required="">
                    </div>
                    <div class="col-sm-5">
                        <?php
                        if (empty($myprofile->photo)) {
                            ?>
                            <img src='<?= base_url('public/img/noimage.jpg') ?>' style="width:100px;height:100px;" alt="" id="blah">
                        <?php } else { ?>
                            <img src='<?= base_url($myprofile->photo) ?>' style="width:100px;height:100px;" alt="" id="blah">
                        <?php } ?>
                    </div>
                </div><br>
                <center>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure ?')" style="border-radius:20px"><i class="fa fa-check-circle"></i> Update</button>
                </center> 
            </form>
        </div>
        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
            <form method="POST" action="<?= base_url('common/password_update') ?>">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="<?= $myprofile->id_no ?>" readonly="">
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
    document.forms['getformdata'].elements['department'].value = '<?= $myprofile->department ?>';
    document.forms['getformdata'].elements['program'].value = '<?= $myprofile->program ?>';
</script>
<script>
    function getimageData(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    $(document).ready(function () {
        $('#teacher_profile').addClass('activemenu');
    });
</script>
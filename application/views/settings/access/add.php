<div class="box-card mb-4">
    <h3>Create New Admin User</h3>
    <button type="button" onclick="window.location = '<?= base_url('admin_user.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i>Back</button>
</div>
<div class="box-card">
    <form method="POST" action="<?= base_url('admin/save') ?>" enctype="multipart/form-data">
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">User Name <span style="color: red">*</span></label>
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
            <label class="col-sm-2 col-form-label">Department <span style="color: red">*</span></label>
            <div class="col-sm-10">
                <select name="department" class="form-control mb-3" required="">
                    <option value="">Select Department</option>
                    <option value="ALL">All</option>
                    <?php foreach (get_departments() as $value) { ?>
                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <center>
            <button type="reset" class="btn btn-primary" style="border-radius:20px"><i class="fa fa-resolving"></i> Reset</button>
            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure ?')" style="border-radius:20px"><i class="fa fa-save"></i> Save</button>
        </center> 
    </form>
</div>
<script>
    $(document).ready(function () {
        $('#teacher_list').addClass('activemenu');
    });
</script>
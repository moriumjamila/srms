<div class="box-card mb-4">
    <h3>Admin Users</h3>
    <button type="button" onclick="window.location = '<?= base_url('create_admin_user.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-primary"><i class="fa fa-plus"></i> Create User</button>
</div>
<div class="box-card">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped getTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>ID Number</th>
                            <th>Full Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($get_authorities as $value) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $value->id_no ?></td>
                                <td><?= $value->name ?></td>
                                <?php if ($value->status == 1) { ?>
                                    <td style="text-align: center"><span style="border-radius:10px;background: green;color: #fff;padding: 5px">Active</span></td>
                                <?php } else { ?>
                                    <td style="text-align: center"><span style="border-radius:10px;background: red;color: #fff;padding: 5px">Inactive</span></td>
                                <?php } ?>
                                <td>
                                    <?php if ($value->is_delete == 1) { ?>
                                        <?php if ($value->status == 1) { ?>
                                            <button class="btn btn-o btn-success manageaccess" style="border-radius:20px!important;text-align: center;" id="<?= $value->ts_id ?>" value="0" data-toggle="tooltip" title="Inactive"><i class="fa fa-lock"></i></button>
                                        <?php } else { ?>
                                            <button class="btn btn-o btn-danger manageaccess" style="border-radius:20px!important;text-align: center" id="<?= $value->ts_id ?>" value="1" data-toggle="tooltip" title="Active"><i class="fa fa-unlock"></i></button>
                                        <?php } ?>
                                    <?php } ?>
                                    <a href="<?= base_url('edit_user_profile/' . $value->ts_id) ?>" class="btn btn-info" style="border-radius:20px!important;"><i class="fa fa-pencil"></i></a>
                                    <?php if ($value->is_delete == 1) { ?>
                                        <button type="button" class="btn btn-danger delete_user_profile" id="<?= $value->ts_id ?>" style="border-radius:20px!important;"><i class="fa fa-trash"></i></button>
                                    <?php } ?>
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
    $(document).ready(function () {
        $('body').on('click', '.manageaccess', function () {
            var id = $(this).attr('id');
            var value = $(this).val();
            swal({
                title: "Are you sure ?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    swal(window.location.href = "<?= base_url('admin/manage_user_access') ?>" + '/' + id + '/' + value);
                } else {
                    swal("Cancelled");
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.delete_user_profile', function () {
            var id = $(this).attr('id');
            swal({
                title: "Are you sure ?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    swal(window.location.href = "<?= base_url('delete_user_profile/') ?>" + +id);
                } else {
                    swal("Cancelled");
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#settings').addClass('activemenu');
    });
</script>
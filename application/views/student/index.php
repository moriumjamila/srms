<div class="box-card mb-4">
    <h3>Student List</h3>
    <button type="button" onclick="window.location = '<?= base_url('add_student_list.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-primary"><i class="fa fa-plus"></i> Registration</button>
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
                            <th>Contact</th>
                            <th>Department</th>
                            <th>Program</th>
                            <th>Login Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($get_students as $value) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $value->id_no ?></td>
                                <td><?= $value->name ?></td>
                                <td><?= $value->contact ?></td>
                                <td><?= $value->department ?></td>
                                <td><?= $value->department ?> <?= $value->program ?></td>
                                <?php if ($value->status == 1) { ?>
                                    <td style="text-align: center"><span style="border-radius:10px;background: green;color: #fff;padding: 5px">Active</span></td>
                                <?php } else { ?>
                                    <td style="text-align: center"><span style="border-radius:10px;background: red;color: #fff;padding: 5px">Inactive</span></td>
                                <?php } ?>
                                <td>
                                    <a href="<?= base_url('view_student_profile/' . $value->ts_id) ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-eye"></i></a>
                                    <a href="<?= base_url('edit_student_profile/' . $value->ts_id) ?>" class="btn btn-info" style="border-radius:20px!important;"><i class="fa fa-pencil"></i></a>
                                    <button type="button" class="btn btn-danger delete_student_profile" id="<?= $value->ts_id ?>" style="border-radius:20px!important;"><i class="fa fa-trash"></i></button>
                                    <!--<a href="<?= base_url('semester_registrations') ?>" class="btn" style="background:purple;color:#fff;border-radius:20px!important;" title="Semester Registration"><i class="fa fa-window-restore"></i></a>-->
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
        $(document).on('click', '.delete_student_profile', function () {
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
                    swal(window.location.href = "<?= base_url('delete_student_profile/') ?>" + +id);
                } else {
                    swal("Cancelled");
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#student_list').addClass('activemenu');
    });
</script>
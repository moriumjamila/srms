<div class="box-card mb-4">
    <h3><?= $title ?></h3>
</div>
<div class="box-card">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped getTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>ID No.</th>
                            <th>Student</th>
                            <th>Department</th>
                            <th>Program</th>
                            <th>Session</th>
                            <th>Semester</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($advised_registers as $value) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $value->id_no ?></td>
                                <td><?= $value->name ?></td>
                                <td><?= $value->department ?></td>
                                <td><?= $value->department ?> <?= $value->program ?></td>
                                <td><?= $value->session ?></td>
                                <td><?= $value->semester_no ?></td>
                                <td><?= $value->reg_date ?></td>
                                <td>
                                    <a href="<?= base_url('view_advising_students/' . $value->sem_reg_info_id) ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-eye"></i></a>
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
        $(document).on('click', '.delete_teacher_profile', function () {
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
                    swal(window.location.href = "<?= base_url('delete_teacher_profile/') ?>" + +id);
                } else {
                    swal("Cancelled");
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#advised_students').addClass('activemenu');
    });
</script>
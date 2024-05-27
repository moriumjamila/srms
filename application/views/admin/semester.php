<div class="box-card mb-4">
    <h3><?= $title ?></h3>
    <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-whatever="@mdo" style="background:purple;color: #fff;float: right;margin-top: -35px;border-radius: 20px !important;" class="btn"><i class="fa fa-plus"></i> Add Student</button>
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
                        foreach ($semester_reg_info as $value) {
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
                                    <a href="<?= base_url('semester_registration?id=' . $value->student_id) ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-eye"></i></a>
                                    <!--<a href="<?= base_url('view_semester_registration/' . $value->sem_reg_info_id) ?>" class="btn btn-<?= $value->is_approve == 0 ? 'danger blink' : 'primary' ?>" style="border-radius:20px!important;"><i class="fa fa-eye"></i></a>-->
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
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="get" action="<?= base_url('new_semester_registration') ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select style="border: 2px solid #9eeaf9;" name="id" class="form-control mb-3" required="">
                                    <option value="">Select Student</option>
                                    <?php foreach ($get_students as $value) { ?>
                                        <option value="<?= $value->ts_id ?>"><?= $value->name ?> => <?= $value->department ?> => <?= $value->program ?></option>
                                    <?php } ?>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <select name="session" style="border: 2px solid #9eeaf9;" class="form-control" required="">
                                <option value="">Session</option>
                                <?php foreach (get_sessions() as $value) { ?>
                                    <option value="<?= $value->name ?>-<?= date('Y') ?>"><?= $value->name ?> <?= date('Y') ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="semester" style="border: 2px solid #9eeaf9;" class="form-control" required="">
                                <option value="">Semester</option>
                                <?php foreach (get_semesters() as $value) { ?>
                                    <option value="<?= $value->name ?>"><?= $value->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="section" style="border: 2px solid #9eeaf9;" class="form-control" required="">
                                <option value="">Section</option>
                                <?php foreach (get_sections() as $value) { ?>
                                    <option value="<?= $value->name ?>"><?= $value->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div><br>
                    <div style="text-align: center">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close" style="border-radius: 10px;"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary" style="border-radius: 10px;"><i class="fa fa-send-o"></i> Next</button>
                    </div> 
                </form>
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
        $('#semester_registrations').addClass('activemenu');
    });
</script>
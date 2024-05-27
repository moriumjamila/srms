<div class="box-card mb-4">
    <h3><?= $title ?></h3>
    <a href="<?= base_url('add_semester_subjects.php') ?>" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-primary"><i class="fa fa-plus"></i> Add Subject</a>
</div>
<div class="box-card">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped getTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Department</th>
                            <th>Program</th>
                            <th>Session</th>
                            <th>Semester</th>
                            <th>Total Section</th>
                            <th>Total Subject</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($get_semester_subjects as $value) {
                            $total_section = $this->db->select('section')->distinct()->where('sem_sbject_id', $value->sem_sub_id)->get('semester_subject_list')->num_rows();
                            $total_subject = $this->db->select('subject_id')->where('sem_sbject_id', $value->sem_sub_id)->get('semester_subject_list')->num_rows();
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $value->department ?></td>
                                <td><?= $value->program ?></td>
                                <td><?= $value->session ?></td>
                                <td><?= $value->semester ?></td>
                                <td style="text-align:center"><?= $total_section ?></td>
                                <td style="text-align:center"><?= $total_subject ?></td>
                                <td>
                                    <a href="<?= base_url('view_semester_subjects/' . $value->sem_sub_id) ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-eye"></i></a>
                                    <a href="<?= base_url('edit_semester_subjects/' . $value->sem_sub_id) ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-edit"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Add Subject Wise Teacher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('subjct/subject_teacher') ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="subject_id" id="set_data_id">
                                <select name="teacher_id" class="form-control mb-3" required="">
                                    <option value="">Select Teacher</option>
                                    <?php foreach (get_teachers() as $value) { ?>
                                        <option value="<?= $value->ts_id ?>"><?= $value->name ?> => <?= $value->department ?> => <?= $value->program ?></option>
                                    <?php } ?>
                                </select>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="department" class="form-control mb-3" required="">
                                    <option value="">Select Department</option>
                                    <?php foreach (get_departments() as $value) { ?>
                                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                                    <?php } ?>
                                </select>
                            </div> 
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="session" class="form-control" required="">
                                    <option value="">Select Session</option>
                                    <?php foreach (get_sessions() as $value) { ?>
                                        <option value="<?= $value->name ?>-<?= date('Y') ?>"><?= $value->name ?>-<?= date('Y') ?></option>
                                    <?php } ?>
                                </select>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="program" class="form-control mb-3" required="">
                                    <option value="">Select Program</option>
                                    <?php foreach (get_programs() as $value) { ?>
                                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                                    <?php } ?>
                                </select>
                            </div> 
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="semester" class="form-control" required="">
                                    <option value="">Select Semester</option>
                                    <?php foreach (get_semesters() as $value) { ?>
                                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                                    <?php } ?>
                                </select>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="section" class="form-control" required="">
                                    <option value="">Select Section</option>
                                    <?php foreach (get_sections() as $value) { ?>
                                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                                    <?php } ?>
                                </select>
                            </div> 
                        </div>
                    </div><br>
                    <div style="text-align: center">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close" style="border-radius: 10px;"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-primary" style="border-radius: 10px;"><i class="fa fa-save"></i> Save</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('body').on('click', '.add_data', function () {
            $("#set_data_id").val($(this).attr('id'));
            $("#addModal").modal('show');
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#semester_subjects').addClass('activemenu');
    });
</script>
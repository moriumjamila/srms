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
                            <th>Department</th>
                            <th>Session</th>
                            <th>Program</th>
                            <th>Semester</th>
                            <th>Section</th>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Result</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($result_information as $value) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $value->department ?></td>
                                <td><?= $value->session ?></td>
                                <td><?= $value->program ?></td>
                                <td><?= $value->semester ?></td>
                                <td><?= $value->section ?></td>
                                <td><?= $value->student_name ?><br>(<?= $value->student_no ?>)</td>
                                <td><?= $value->subject_title ?><br>(<?= $value->subject_code ?>)</td>
                                <td><?= $value->result_type ?></td>
                                <td>
                                    <?php
                                    if ($value->approved_status == 0) {
                                        ?>
                                        <a href="<?= base_url('view_semester_result_information/' . $value->result_id) ?>" class="btn btn-warning blink" style="border-radius:20px!important;"><i class="fa fa-eye"></i></a>
                                    <?php } else { ?>
                                        <a href="<?= base_url('view_semester_result_information/' . $value->result_id) ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-eye"></i></a>
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
        $('#result_information').addClass('activemenu');
    });
</script>
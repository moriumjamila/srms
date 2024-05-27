<div class="box-card mb-4">
    <h3><?= $title ?></h3>
    <button type="button" onclick="window.location = '<?= base_url('advised_students.php') ?>'" style="border-radius: 20px !important;float: right;margin-top: -35px;" class="btn btn-dark"><i class="fa fa-arrow-left"></i>Back</button> 
</div>
<div class="box-card">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <p>Student: <b><?= $semester_reg_info->id_no ?> => <?= $semester_reg_info->name ?></b></p>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-3">
                    <p>Department: <b><?= $semester_reg_info->department ?></b></p>
                </div>
                <div class="col-md-3">
                    <p>Program: <b><?= $semester_reg_info->program ?></b></p>
                </div>
                <div class="col-md-3">
                    <p>Session: <b><?= $semester_reg_info->session ?></b></p>
                </div>
                <div class="col-md-3">
                    <p>Semester: <b><?= $semester_reg_info->semester_no ?></b></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p>Total Credit Hours: <b><?= $semester_reg_info->total_credit ?></b></p>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover m-b-0 c_list">
                            <tbody>
                                <tr>
                                    <th>Check</th>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Credit Hour</th>
                                    <th>Section</th>
                                </tr>
                                <?php
                                $i = 1;
                                foreach ($registration_subjects as $value) {
                                    ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $value->course_code ?></td>
                                        <td><?= $value->course_title ?></td>
                                        <td><?= $value->credit_hour ?></td>
                                        <td><?= $value->section ?></td>
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
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#advised_students').addClass('activemenu');
    });
</script>

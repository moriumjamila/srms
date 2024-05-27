<div class="box-card mb-4">
    <h3><?= @$title ?></h3>
    <button type="button" onclick="window.location = '<?= base_url('student_attendance.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Back</button>
    <?php
    $get_students = $this->db
            ->join('teacher_students', 'teacher_students.ts_id = semester_registrations.student_id')
            ->select('reg_info_id')
            ->select('student_id')
            ->select('id_no')
            ->select('name')
            ->distinct()
            ->where('semester_registrations.department', $subject_teacher->department)
            ->where('semester_registrations.session', $subject_teacher->session)
            ->where('semester_registrations.program', $subject_teacher->program)
            ->where('semester_registrations.semester', $subject_teacher->semester)
            ->where('semester_registrations.section', $subject_teacher->section)
            ->get('semester_registrations')
            ->result();
    ?>
</div>
<div class="box-card">
    <form method="POST" action="<?= base_url('teacher/make_student_attendance') ?>">
        <div class="row">
            <input type="hidden" name="subject_id" value="<?= $subject_teacher->subject_id ?>">
            <input type="hidden" name="section" value="<?= $subject_teacher->section ?>">
            <input type="hidden" name="type" value="<?= $type ?>">
            <div class="col-md-2">
                <p>Department: <b><?= $subject_teacher->department ?></b></p>
            </div>
            <div class="col-md-2">
                <p>Program: <b><?= $subject_teacher->program ?></b></p>
            </div>
            <div class="col-md-3">
                <p>Session: <b><?= $subject_teacher->session ?></b></p>
            </div>
            <div class="col-md-2">
                <p>Semester: <b><?= $subject_teacher->semester ?></b></p>
            </div>
            <div class="col-md-2">
                <p>Section: <b><?= $subject_teacher->section ?></b></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p>Course Code: <b><?= $subject_teacher->course_code ?></b></p>
            </div>
            <div class="col-md-4">
                <p>Course Title: <b><?= $subject_teacher->course_title ?></b></p>
            </div>
            <div class="col-md-4">
                <p>Credit Hour: <b><?= $subject_teacher->credit_hour ?></b></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <input type="date" style="border:2px solid #0062cc" class="form-control" name="present_date" placeholder="Select Attendance Date" required="">
            </div>
            <div class="col-md-4">
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover m-b-0 c_list" id="marksTable">
                        <tbody>
                            <tr>
                                <th>SL. No</th>
                                <th>Student</th>
                                <th>Present</th>
                            </tr>
                            <?php
                            $i = 1;
                            foreach ($get_students as $value) {
                                $get_regsemester = $this->db
                                        ->select('sem_reg_id')
                                        ->where('reg_info_id', $value->reg_info_id)
                                        ->where('student_id', $value->student_id)
                                        ->where('subject_id', $subject_teacher->subject_id)
                                        ->get('semester_registrations')
                                        ->row();
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td>
                                        <?= $value->name ?> (<?= $value->id_no ?>)
                                        <input type="hidden" name="sem_reg_id[]" value="<?= $get_regsemester->sem_reg_id ?>">
                                        <input type="hidden" name="student_id[]" value="<?= $value->student_id ?>">
                                    </td>
                                    <td>
                                        <input type="hidden" name="get_present[]" id="set_present_<?= $i ?>" value="0">
                                        <input type="checkbox" class="big getcheckbox" data-id="<?= $i ?>" value="1">
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
        </div><br>
        <center>
            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure ?')" style="border-radius:20px"><i class="fa fa-save"></i> Save</button>
        </center> 
    </form>
</div>
<script>
    $(document).ready(function () {
        $(".getcheckbox").click(function () {
            var id = $(this).data('id');
            if ($(this).is(':checked')) {
                var value = 1;
            } else {
                var value = 0;
            }
            $("#set_present_" + id).val(value);
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#student_attendance').addClass('activemenu');
    });
</script>
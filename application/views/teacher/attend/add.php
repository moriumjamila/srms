<div class="box-card mb-4">
    <h3>Make Students Attendance</h3>
    <button type="button" onclick="window.location = '<?= base_url('subject_students.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i>Back</button>
</div>
<div class="box-card">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Department</th>
                        <td><b><?= $subject_teacher->department ?></b></td>
                        <th>Session</th>
                        <td><b><?= $subject_teacher->session ?></b></td>
                        <th>Program</th>
                        <td><b><?= $subject_teacher->program ?></b></td>
                    </tr>
                    <tr>
                        <th>Semester</th>
                        <td><b><?= $subject_teacher->semester ?></b></td>
                        <th>Section</th>
                        <td><b><?= $subject_teacher->section ?></b></td>
                    </tr>
                    <tr>
                        <th>Course Code</th>
                        <td><b><?= $subject_teacher->course_code ?></b></td>
                        <th>Course Title</th>
                        <td><b><?= $subject_teacher->course_title ?></b></td>
                        <th>Credit Hour</th>
                        <td><b><?= $subject_teacher->credit_hour ?></b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="<?= base_url('student/save_semester_registration') ?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover m-b-0 c_list">
                                <tbody>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Student</th>
                                        <th>Present</th>
                                    </tr>

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
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#student_attendance').addClass('activemenu');
    });
</script>
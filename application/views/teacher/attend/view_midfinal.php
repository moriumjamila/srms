<div class="box-card mb-4">
    <button type="button" onclick="window.location = '<?= base_url('student_attendance.php') ?>'" style="float:left;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Back</button>
    <center>
        <h3><?= $title ?></h3>
    </center>
    <button type="button" onclick="printDi('printarea')" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
</div>
<div class="box-card">
    <div id="printarea">
        <div style="color:#1c5fa8;">
            <center>
                <h3 style="font-family: Montserrat;font-weight: bold;">Northern University</h3>
                <h6 style="font-family: Montserrat;font-weight: bold;">Attendance of <?= $type ?></h6>
            </center>
        </div><br>
        <table class="table table-bordered">
            <tr>
                <td><span><b>Department</b>: <b><?= $subject_teacher->department ?></b></span></td>
                <td><span><b>Program</b>: <b><?= $subject_teacher->program ?></b></span></td>
                <td><span><b>Session</b>: <b><?= $subject_teacher->session ?></b></span></td>
                <td><span><b>Semester</b>: <b><?= $subject_teacher->semester ?></b></span></td>
                <td><span><b>Section</b>: <b><?= $subject_teacher->section ?></b></span></td>
            </tr>
        </table>
        <table class="table table-bordered">
            <tr>
                <td><p><b>Course Code: <?= $subject_teacher->course_code ?></b></p></td>
                <td><p><b>Course Title: <?= $subject_teacher->course_title ?></b></p></td>
                <td><p><b>Credit Hour: <?= $subject_teacher->credit_hour ?></b></p></td>
            </tr>
        </table>
        <table class="table table-hover m-b-0 c_list" id="marksTable">
            <tbody>
                <tr>
                    <th>SL. No</th>
                    <th>Student</th>
                    <th>Present</th>
                    <th>Date</th>
                </tr>
                <?php
                $i = 1;
                $results = $this->db->select('at.*, 
                              ts.id_no as student_no, 
                              ts.name as student_name')
                        ->from('attendances as at')
                        ->join('teacher_students as ts', 'ts.ts_id = at.student_id')
                        ->join('subjects as s', 's.sub_id = at.subject_id')
                        ->where('at.teacher_id', $this->session->userdata('user_id'))
                        ->where('at.attend_type', $type)
                        ->where('at.subject_id', $subject_teacher->subject_id)
                        ->get()
                        ->result();
                foreach ($results as $value) {
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td>
                            <?= $value->student_name ?> (<?= $value->student_no ?>)
                        </td>
                        <td>
                            <?php
                            if ($value->present == 1) {
                                echo 'Present';
                            } else {
                                echo 'Absent';
                            }
                            ?>
                        </td>
                        <td>
                            <?= $value->attend_date ?>
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
<script type="text/javascript">
    function printDi(printarea) {
        var printContents = document.getElementById(printarea).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<script>
    $(document).ready(function () {
        $('#student_attendance').addClass('activemenu');
    });
</script>
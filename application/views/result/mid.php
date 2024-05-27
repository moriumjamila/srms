<div class="box-card mb-4">
    <h3><?= @$title ?></h3>
    <button type="button" onclick="window.location = '<?= base_url('result_information.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Back</button>
</div>
<div class="box-card">
    <form method="POST" action="<?= base_url('result/make_mid_semester_result') ?>">
        <div class="row">
            <div class="col-md-3">
                <input type="hidden" name="sem_reg_info_id" value="<?= $semester_reg_info->sem_reg_info_id ?>">
                <input type="hidden" name="student_id" value="<?= $semester_reg_info->student_id ?>">
                <input type="hidden" name="result_type" value="<?= $this->session->userdata('get_type') ?>">
                <input type="hidden" name="session_name" value="<?= $semester_reg_info->session ?>">
                <input type="hidden" name="avg_marks" id="set_avg_marks">
                <p>Student ID: <b><?= $semester_reg_info->id_no ?></b></p>
            </div>
            <div class="col-md-3">
                <p>Student Name: <b><?= $semester_reg_info->name ?></b></p>
            </div>
            <div class="col-md-3">
                <p>Department: <b><?= $semester_reg_info->department ?></b></p>
            </div>
            <div class="col-md-3">
                <p>Program: <b><?= $semester_reg_info->program ?></b></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p>Session: <b><?= $semester_reg_info->session ?></b></p>
            </div>
            <div class="col-md-3">
                <p>Semester: <b><?= $semester_reg_info->semester_no ?></b></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover m-b-0 c_list" id="marksTable">
                        <tbody>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Credit Hour</th>
                                <th>Mid CT</th>
                                <th>Mid MCQ</th>
                                <th>Mid CQ</th>
                                <th>Mid Attend</th>
                                <th>Total Marks</th>
                            </tr>
                            <?php
                            $i = 1;
                            foreach ($get_subjects as $value) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $value->course_code ?>
                                        <input type="hidden" name="sem_reg_id[]" value="<?= $value->sem_reg_id ?>">
                                        <input type="hidden" name="subject_id[]" value="<?= $value->subject_id ?>">
                                    </td>
                                    <td><?= $value->course_title ?></td>
                                    <td>
                                        <?= $value->credit_hour ?>
                                        <input type="hidden" name="credit_hour[]" value="<?= $value->credit_hour ?>">
                                    </td>
                                    <td><input type="number" min="1" name="mid_ct[]" class="form-control midCT" placeholder="Enter" required=""></td>
                                    <td><input type="number" min="1" name="mid_mcq[]" class="form-control midMCQ" placeholder="Enter" required=""></td>
                                    <td><input type="number" min="1" name="mid_cq[]" class="form-control midCQ" placeholder="Enter" required=""></td>
                                    <td><input type="number" min="1" name="mid_attend[]" class="form-control midAttend" placeholder="Enter" required=""></td>
                                    <td><input type="number"  name="total_mid_marks[]" class="form-control totalMarks" readonly=""></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b><span>Average Marks</span></b></td>
                                <td><b><span id="setavgMarks"></span></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><br>
        <center>
            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure ?')" style="border-radius:20px"><i class="fa fa-recycle"></i> Make</button>
        </center> 
    </form>
</div>
<script>
    $(document).ready(function () {
        $('.letter_grade').change(function () {
            var id = $(this).data('id');
            var value = $(this).val();
            var letter_grade = value.split('$$');
            $("#set_mid_letter_" + id).val(letter_grade[0]);
            $("#set_mid_grade_" + id).val(letter_grade[1]);
        });
    }
    );
    $(document).ready(function () {
        $('#marksTable').on('keyup', 'input', function () {
            var row = $(this).closest('tr');
            var midCT = parseFloat(row.find('.midCT').val());
            var midMCQ = parseFloat(row.find('.midMCQ').val());
            var midCQ = parseFloat(row.find('.midCQ').val());
            var midAttend = parseFloat(row.find('.midAttend').val());
            var totalMarks = midCT + midMCQ + midCQ + midAttend;

            if (!isNaN(midCT) && !isNaN(midMCQ) && !isNaN(midCQ) && !isNaN(midAttend)) {
                var totalMarks = midCT + midMCQ + midCQ + midAttend;
                row.find('.totalMarks').val(totalMarks);
            } else {
                row.find('.totalMarks').val(0);
            }
            calculateTotalTotalMarks();
        });

        function calculateTotalTotalMarks() {
            var totalTotalMarks = 0;
            var totalRows = 0;
            $('#marksTable tbody tr').each(function () {
                var row = $(this);
                var totalMarks = parseFloat(row.find('.totalMarks').val());
                if (!isNaN(totalMarks)) {
                    totalTotalMarks += totalMarks;
                    totalRows++;
                }
            });
            var averageMarks = parseFloat(totalTotalMarks / totalRows);
            var round_figure_value = Math.round(averageMarks);
            $('#setavgMarks').html(round_figure_value);
            $('#set_avg_marks').val(round_figure_value);
        }
    });
</script>

<script>
    $(document).ready(function () {
        $('#result_information').addClass('activemenu');
    });
</script>
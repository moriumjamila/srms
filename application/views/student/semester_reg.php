<?php
$student_acads = $this->db->where('uniq_id', $student_info->uniq_id)->where('status', 1)->get('teacher_student_acads')->row();
?>
<button type="button" onclick="window.location = '<?= base_url('semester_registrations.php') ?>'" style="border-radius: 20px !important;float: right;margin-top: 20px;" class="btn btn-dark"><i class="fa fa-arrow-left"></i>Back</button> 
<div class="box-card mb-4">
    <h3><?= @$title ?></h3><br>
    <?php if ($session && count($semester_subjects) == 0) { ?>
        <div class="row">
            <div class="col-md-12">
                <h2 style="color: red;text-align:center">Results Not Found</h2>
            </div>
        </div><br>
    <?php } ?>
</div>
<div class="box-card">
    <?php if (count($semester_subjects) > 0) { ?>
        <form method="POST" action="<?= base_url('admin/save_semester_registration') ?>">
            <div class="row">
                <div class="col-md-3">
                    <p>Total Credit Hours: <span id="totalCreditHours">0</span></p>
                    <input type="hidden" name="total_credit_taken" id="set_total_credit_taken">
                    <input type="hidden" name="student_id" value="<?= $student_id ?>">
                    <input type="hidden" name="department" value="<?= $student_info->department ?>">
                    <input type="hidden" name="program" value="<?= $student_info->program ?>">
                    <input type="hidden" name="session" value="<?= $session ?>">
                    <input type="hidden" name="semester" value="<?= $semester ?>">
                    <input type="hidden" name="section" value="<?= $section ?>">
                    <input type="hidden" name="tsacd_id" value="<?= $student_acads->tsacd_id ?>">
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
                                </tr>
                                <?php
                                $i = 1;
                                foreach ($semester_subjects as $value) {
                                    ?>
                                    <tr>
                                        <td><input class="big checkbox" type="checkbox" name="subject_id[]" value="<?= $value->subject_id ?>"></td>
                                        <td><?= $value->course_code ?></td>
                                        <td><?= $value->course_title ?></td>
                                        <td><?= $value->credit_hour ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-4">
                    <select name="adviser_id" class="form-control mb-3" required="">
                        <option value="">Select Advisor</option>
                        <?php foreach (get_teachers() as $value) { ?>
                            <option value="<?= $value->ts_id ?>"><?= $value->name ?> => <?= $value->department ?> => <?= $value->program ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div><br>
            <center>
                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure ?')" style="border-radius:20px"><i class="fa fa-save"></i> Save</button>
            </center> 
        </form>
    <?php } ?>
</div>
<script>
    $(document).ready(function () {
        $('input[type="checkbox"]').change(function () {
            var $tr = $(this).closest('tr');
            var $select = $tr.find('select[name="section[]"]');
            if ($(this).is(':checked')) {
                $select.prop('required', true);
            } else {
                $select.prop('required', false);
            }
        });
    }
    );
</script>
<script>
    $(document).ready(function () {
        $('.checkbox, .section-select').change(function () {
            calculateTotalCreditHours();
        });
        function calculateTotalCreditHours() {
            var totalCreditHours = 0;
            $('.checkbox:checked').each(function () {
                var creditHour = $(this).closest('tr').find('td:eq(3)').text();
                totalCreditHours += parseInt(creditHour);
            });
            $('#totalCreditHours').text(totalCreditHours);
            $('#set_total_credit_taken').val(totalCreditHours);
        }
    }
    );
</script>
<script>
    $(document).ready(function () {
        $('#semester_registrations').addClass('activemenu');
    });
</script>
<?php
$student_acads = $this->db->where('uniq_id', $student_info->uniq_id)->where('status', 1)->get('teacher_student_acads')->row();

if (@$last_semreg_info->is_approve == 1) {
    @$advisorinfo = $this->Universal_model->get_advisor_info($last_semreg_info->sem_reg_info_id);
    @$advisor_name = @$advisorinfo->name;
    @$advisor_contact = @$advisorinfo->contact;
} else {
    @$advisor_name = '';
    @$advisor_contact = '';
}
?>
<div class="box-card mb-4">
    <h3><?= @$title ?></h3>
    <?php if ($session && count($semester_subjects) == 0) { ?>
        <div class="row">
            <div class="col-md-12">
                <h2 style="color: red;text-align:center">Results Not Found</h2>
            </div>
        </div><br>
    <?php } ?>
</div>
<div class="box-card">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#LastRegistration" type="button" role="tab" aria-controls="home" aria-selected="true">Last Registration</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#NewRegistration" type="button" role="tab" aria-controls="profile" aria-selected="false">New Registration</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#AllRegistration" type="button" role="tab" aria-controls="password" aria-selected="false">All Registration</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="LastRegistration" role="tabpanel" aria-labelledby="home-tab"><br>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Semester</th>
                            <td><?= @$last_semreg_info->session ?></td>
                            <th>Semester No</th>
                            <td><?= @$last_semreg_info->semester_no ?></td>
                        </tr>
                        <tr>
                            <th>Total Credit Taken</th>
                            <td><?= @$last_semreg_info->total_credit ?></td>
                            <th>Is Approved By Advisor</th>
                            <td><?= @$last_semreg_info->is_approve == 1 ? 'Yes' : 'No' ?></td>
                        </tr>
                        <tr>
                            <th>Advisor Name</th>
                            <td><?= $advisor_name ?></td>
                            <th>Contact Number</th>
                            <td><?= $advisor_contact ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h5 class="alert alert-info">Registered Courses</h5>
            <div class="table-responsive">
                <table class="table table-hover m-b-0 c_list">
                    <tbody>
                        <tr>
                            <th>Serial</th>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Section</th>
                            <th>Credit Hour</th>
                        </tr>
                        <?php
                        $i = 1;
                        $semester_registrationst = $this->db->select('*')
                                ->join('subjects', 'subjects.sub_id = semester_registrations.subject_id')
                                ->where('reg_info_id', @$last_semreg_info->sem_reg_info_id)
                                ->get('semester_registrations')
                                ->result();
                        foreach ($semester_registrationst as $regvalue) {
                            ?>
                            <tr>
                                <td><?= @$i ?></td>
                                <td><?= @$regvalue->course_code ?></td>
                                <td><?= @$regvalue->course_title ?></td>
                                <td><?= @$regvalue->section ?></td>
                                <td><?= @$regvalue->credit_hour ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="NewRegistration" role="tabpanel" aria-labelledby="profile-tab">
            <form method="get" action="<?= base_url('student_semester_registration') ?>" name="getformdata">
                <div class="row">
                    <div class="col-md-3">
                        <input type="hidden" name="id" value="<?= $student_id ?>">
                        <select name="session" style="border: 2px solid #9eeaf9;" class="form-control" required="">
                            <option value="">Select Session</option>
                            <?php foreach (get_sessions() as $value) { ?>
                                <option value="<?= $value->name ?>-<?= date('Y') ?>"><?= $value->name ?> <?= date('Y') ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="semester" style="border: 2px solid #9eeaf9;" class="form-control" required="">
                            <option value="">Select Semester</option>
                            <?php foreach (get_semesters() as $value) { ?>
                                <option value="<?= $value->name ?>"><?= $value->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="section" style="border: 2px solid #9eeaf9;" class="form-control" required="">
                            <option value="">Select Section</option>
                            <?php foreach (get_sections() as $value) { ?>
                                <option value="<?= $value->name ?>"><?= $value->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary" style="border-radius:20px"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div><br>
            </form>
            <?php if (count($semester_subjects) > 0) { ?>
                <form method="POST" action="<?= base_url('student/save_semester_registration') ?>">
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
                            <select name="approved_by" class="form-control mb-3" required="">
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
        <div class="tab-pane fade" id="AllRegistration" role="tabpanel" aria-labelledby="password-tab">
            <div class="tab-pane fade show active" id="LastRegistration" role="tabpanel" aria-labelledby="home-tab"><br>
                <?php foreach ($semester_reg_info as $value) { ?>
                    <div>
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <tbody>
                                    <tr class="alert alert-primary">
                                        <th>
                                            Semester
                                        </th>
                                        <td>
                                            <span class="property-value">
                                                <?= @$value->session ?>
                                            </span>
                                        </td>

                                        <th>
                                            Semester No
                                        </th>
                                        <td>
                                            <span class="property-value"><?= @$value->semester_no ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h5 class="alert alert-info">Registered Courses</h5>
                        <div class="table-responsive">
                            <table class="table table-hover m-b-0 c_list">
                                <tbody>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Course Code</th>
                                        <th>Course Title</th>
                                        <th>Section</th>
                                        <th>Credit Hour</th>
                                    </tr>
                                    <?php
                                    $i = 1;
                                    $semester_registrationst = $this->db->select('*')
                                            ->join('subjects', 'subjects.sub_id = semester_registrations.subject_id')
                                            ->where('reg_info_id', @$value->sem_reg_info_id)
                                            ->get('semester_registrations')
                                            ->result();
                                    foreach ($semester_registrationst as $regvalue) {
                                        ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $regvalue->course_code ?></td>
                                            <td><?= $regvalue->course_title ?></td>
                                            <td><?= $regvalue->section ?></td>
                                            <td><?= $regvalue->credit_hour ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
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
    document.forms['getformdata'].elements['session'].value = '<?= $session ?>';
    document.forms['getformdata'].elements['semester'].value = '<?= $semester ?>';
    document.forms['getformdata'].elements['section'].value = '<?= $section ?>';
</script>
<script>
    $(document).ready(function () {
        $('#student_semester_registration').addClass('activemenu');
    });
</script>
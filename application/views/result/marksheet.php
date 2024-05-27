<div class="box-card mb-4">
    <h3><?= $title ?></h3>
    <button type="button" onclick="window.location = '<?= base_url('result_information.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Back</button>
</div>
<div class="box-card">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link <?= $session_value == 0 ? 'active' : '' ?>" id="home-tab" data-bs-toggle="tab" data-bs-target="#LastRegistration" type="button" role="tab" aria-controls="home" aria-selected="true">Academic Transcript</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#NewRegistration" type="button" role="tab" aria-controls="profile" aria-selected="false">Semester Wise Transcript</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade <?= $session_value == 0 ? 'show active' : '' ?>" id="LastRegistration" role="tabpanel" aria-labelledby="home-tab"><br>
            <h5 class="alert alert-info">Transcript Copy</h5>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th>Credit Hour</th>
                        <th>Grade Letter</th>
                        <th>Grade Point</th>
                        <th>TGP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_credit_hour = 0;
                    $total_tgp = 0;
                    $i = 1;
                    foreach ($academic_ranscripts as $ranscript) {
                        $total_credit_hour += $ranscript->credit_hour;
                        $total_tgp += $ranscript->tgp;
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $ranscript->course_code ?></td>
                            <td><?= $ranscript->course_title ?></td>
                            <td><?= $ranscript->credit_hour ?></td>
                            <td><?= $ranscript->letter_grade ?></td>
                            <td><?= $ranscript->grade_point ?></td>
                            <td><?= $ranscript->tgp ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                    <tr>
                        <td colspan="3" style="text-align:right">
                            <strong>Total</strong>
                        </td>
                        <td>
                            <?= number_format($total_credit_hour, 2, '.', ',') ?>
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
                            <?= number_format($total_tgp, 2, '.', ',') ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h4 class="alert alert-info" style="float: right">Total Credit: <?= number_format($total_credit_hour, 2, '.', ',') ?> ,  Your CGPA:- <?= number_format($total_tgp / $total_credit_hour, 2, '.', ',') ?></h4>
        </div>
        <div class="tab-pane fade" id="NewRegistration" role="tabpanel" aria-labelledby="profile-tab"><BR>
            <?php foreach ($student_result_info as $value) { ?>
                <div>
                    <h4 class="alert alert-info"><?= $value->session_name ?> </h4>      
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Credit Hour</th>
                                <th>Grade Letter</th>
                                <th>Grade Point</th>
                                <th>TGP</th>
                                <th>Result For</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $academic_ranscripts = $this->db->select('*')
                                    ->join('subjects', 'subjects.sub_id = semester_registrations.subject_id')
                                    ->where('student_id', @$value->student_id)
                                    ->get('semester_registrations')
                                    ->result();
                            $total_credit_hour = 0;
                            $total_tgp = 0;
                            $i = 1;
                            foreach ($academic_ranscripts as $ranscript) {
                                $total_credit_hour += $ranscript->credit_hour;
                                $total_tgp += $ranscript->tgp;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $ranscript->course_code ?></td>
                                    <td><?= $ranscript->course_title ?></td>
                                    <td><?= $ranscript->credit_hour ?></td>
                                    <td><?= $ranscript->letter_grade ?></td>
                                    <td><?= $ranscript->grade_point ?></td>
                                    <td><?= $ranscript->tgp ?></td>
                                    <td><?= $ranscript->result_for ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                            <tr>
                                <td colspan="3" style="text-align:right">
                                    <strong>Total</strong>
                                </td>
                                <td>
                                    <?= number_format($total_credit_hour, 2, '.', ',') ?>
                                </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>
                                    <?= number_format($total_tgp, 2, '.', ',') ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h4 class="alert alert-info" style="float: right">Total Credit: <?= number_format($total_credit_hour, 2, '.', ',') ?> ,  Your CGPA:- <?= number_format($total_tgp / $total_credit_hour, 2, '.', ',') ?></h4>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    document.forms['getformdata'].elements['session'].value = '<?= $session_name ?>';
</script>
<script>
    $(document).ready(function () {
        $('#result_information').addClass('activemenu');
    });
</script>
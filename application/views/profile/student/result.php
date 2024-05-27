<div class="box-card mb-4">
    <h3><?= @$title ?></h3>
</div>
<div class="box-card">
    <form action="<?= base_url('student_result_information') ?>" method="post" name="getformdata">
        <select class="alert alert-info alert-block" name="session" required="">
            <option value="">Please Select Semester</option>
            <?php foreach ($academic_ranscripts as $value) { ?>
                <option value="<?= $value->session ?>"><?= $value->session ?></option>
            <?php } ?>
        </select>
        <select class="alert alert-info alert-block" name="type" required="">
            <option value="">Please Select Type</option>
            <option value="Mid">Mid</option>
            <option value="Final">Final</option>
        </select>
        <button type="submit" class="btn btn-primary" style="margin-left: 30px;"><i class="fa fa-search"></i> Search</button>
    </form>
    <?php if ($session_value != 0) { ?>
        <div>
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
                    $i = 1;
                    foreach ($session_wise_result as $ranscript) {
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $ranscript->subject_code ?></td>
                            <td><?= $ranscript->subject_title ?></td>
                            <td><?= $ranscript->subject_credit ?></td>
                            <td><?= $ranscript->letter ?></td>
                            <td><?= $ranscript->point ?></td>
                            <td><?= $ranscript->cgpa ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>
<script>
    document.forms['getformdata'].elements['session'].value = '<?= @$session_name ?>';
    document.forms['getformdata'].elements['type'].value = '<?= @$type ?>';
</script>
<script>
    $(document).ready(function () {
        $('#student_result_information').addClass('activemenu');
    });
</script>
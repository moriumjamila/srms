<div class="box-card mb-4">
    <h3><?= $title ?></h3>
    <button type="button" onclick="window.location = '<?= base_url('semester_subjects.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Back</button>
</div>
<div class="box-card">
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="<?= base_url('Subjct/update_semester_subjects') ?>">
                <div class="row">
                    <div class="col-md-3">
                        <label>Department</label>
                        <input type="hidden" name="sem_sub_id" value="<?= $get_semester->sem_sub_id ?>">
                        <input type="text" class="form-control" value="<?= $get_semester->department ?>" readonly="">
                    </div>
                    <div class="col-md-3">
                        <label>Program</label>
                        <input type="text" class="form-control" value="<?= $get_semester->program ?>" readonly="">
                    </div>
                    <div class="col-md-3">
                        <label>Sessions</label>
                        <input type="text" class="form-control" value="<?= $get_semester->session ?>" readonly="">
                    </div>
                    <div class="col-md-3">
                        <label>Semesters</label>
                        <input type="text" class="form-control" value="<?= $get_semester->semester ?>" readonly="">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="">S/N</th>
                                        <th class="text-center" style="">Subject</th>
                                        <th class="text-center" style="">Section</th>
                                        <th class="text-center" style="">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="moreItems">
                                    <?php
                                    $i = 1;
                                    foreach ($semester_subjects as $getsubject) {
                                        ?>
                                        <tr>
                                            <td class="serial_no"><?= $i ?></td>
                                            <td class="text-center" style="width:70%">
                                                <select name="subject_id[]" class="form-control" required="">
                                                    <option value="<?= $getsubject->subject_id ?>"><?= $getsubject->course_code ?> => <?= $getsubject->course_title ?> => <?= $getsubject->credit_hour ?></option>
                                                    <?php foreach ($get_subjects as $subject) { ?>
                                                        <option value="<?= $subject->sub_id ?>"><?= $subject->course_code ?> => <?= $subject->course_title ?> => <?= $subject->credit_hour ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td class="text-center" style="width:20%">
                                                <select name="section[]" class="form-control" required="">
                                                    <option value="<?= $getsubject->section ?>"><?= $getsubject->section ?></option>
                                                    <?php foreach (get_sections() as $value) { ?>
                                                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                if ($i != 1) {
                                                    ?>
                                                    <button  class="btn btn-danger remCF"><i class="fa fa-times"></i></button>
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
                </div><br>
                <center>
                    <button type="button" id="addSubject" class="btn btn-primary"><i class="fa fa-plus"></i>Add More</button>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure ?')" style="border-radius:20px"><i class="fa fa-check-circle"></i> Update</button>
                </center> 
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#addSubject").click(function () {
            var n = ($('#moreItems tr').length - 0) + 1;
            var tr = '<tr>' +
                    '<td class="serial_no">' + n + '</td>' +
                    '<td class="text-center" style="width:70%">' +
                    '<select name="subject_id[]" class="form-control">' +
                    '<option value="">Select</option>' +
<?php foreach ($get_subjects as $subject) { ?>
                '<option value="<?= $subject->sub_id ?>"><?= $subject->course_code ?> => <?= $subject->course_title ?> => <?= $subject->credit_hour ?></option>' +
<?php } ?>
            '</select>' +
                    '</td>' +
                    '<td class="text-center" style="width:20%">' +
                    '<select name="section[]" class="form-control">' +
                    '<option value="">Select</option>' +
<?php foreach (get_sections() as $value) { ?>
                '<option value="<?= $value->name ?>"><?= $value->name ?></option>' +
<?php } ?>
            '</select>' +
                    '</td>' +
                    '<td class="text-center"><button  class="btn btn-danger remCF"><i class="fa fa-times"></i></button></td>' +
                    '</tr>';
            $("#moreItems").append(tr);
        });
        $(document).delegate('button.remCF', 'click', function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();
            return true;
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#semester_subjects').addClass('activemenu');
    });
</script>
<div class="box-card mb-4">
    <h3><?= $title ?></h3>
    <button type="button" onclick="window.location = '<?= base_url('semester_subjects.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Back</button>
</div>
<div class="box-card">
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="<?= base_url('save_semester_subjects') ?>">
                <div class="row">
                    <div class="col-md-3">
                        <label>Department <span style="color: red">*</span></label>
                        <select name="department" class="form-control" required="">
                            <option value="">Select</option>
                            <?php foreach (get_departments() as $value) { ?>
                                <option value="<?= $value->name ?>"><?= $value->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Program <span style="color: red">*</span></label>
                        <select name="program" class="form-control" required="">
                            <option value="">Select</option>
                            <?php foreach (get_programs() as $value) { ?>
                                <option value="<?= $value->name ?>"><?= $value->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Sessions <span style="color: red">*</span></label>
                        <select name="session" class="form-control" required="">
                            <option value="">Select</option>
                            <?php foreach (get_sessions() as $value) { ?>
                                <option value="<?= $value->name ?>-<?= date('Y') ?>"><?= $value->name ?>-<?= date('Y') ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Semesters <span style="color: red">*</span></label>
                        <select name="semester" class="form-control" required="">
                            <option value="">Select</option>
                            <?php foreach (get_semesters() as $value) { ?>
                                <option value="<?= $value->name ?>"><?= $value->name ?></option>
                            <?php } ?>
                        </select>
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
                                    <tr>
                                        <td class="serial_no">1</td>
                                        <td class="text-center" style="width:70%">
                                            <select name="subject_id[]" class="form-control" required="">
                                                <option value="">Select</option>
                                                <?php foreach ($get_subjects as $subject) { ?>
                                                    <option value="<?= $subject->sub_id ?>"><?= $subject->course_code ?> => <?= $subject->course_title ?> => <?= $subject->credit_hour ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td class="text-center" style="width:20%">
                                            <select name="section[]" class="form-control" required="">
                                                <option value="">Select</option>
                                                <?php foreach (get_sections() as $value) { ?>
                                                    <option value="<?= $value->name ?>"><?= $value->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><br>
                <center>
                    <button type="button" id="addSubject" class="btn btn-primary"><i class="fa fa-plus"></i>Add More</button>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure ?')" style="border-radius:20px"><i class="fa fa-save"></i> Save</button>
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
<div class="box-card mb-4">
    <h3><?= $title ?></h3>
    <button type="button" onclick="window.location = '<?= base_url('subject_teachers.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Back</button>
</div>
<div class="box-card">
    <div class="box tableborder">
        <div class="box-body" style="position: relative">
            <form method="post" action="<?= base_url('Subjct/subject_teacher') ?>">
                <input type="hidden" name="assign_from" value="<?= $get_semester->sem_sub_id ?>">
                <input type="hidden" name="department" value="<?= $get_semester->department ?>">
                <input type="hidden" name="program" value="<?= $get_semester->program ?>">
                <input type="hidden" name="session" value="<?= $get_semester->session ?>">
                <input type="hidden" name="semester" value="<?= $get_semester->semester ?>">
                <table class="table table-bordered" style="">
                    <tr>
                        <td><span><b>Department</b> :</span></td>
                        <td><span><?= $get_semester->department ?></span></td>
                        <td><span><b>Program</b> :</span></td>
                        <td><span><?= $get_semester->program ?></span></td>
                    </tr>
                    <tr>
                        <td><span><b>Session</b> :</span></td>
                        <td><span><?= $get_semester->session ?></span></td>
                        <td><span><b>Semester</b> :</span></td>
                        <td><span><?= $get_semester->semester ?></span></td>
                    </tr>
                </table>
                <?php
                $get_section = $this->db->select('section')
                        ->distinct()
                        ->where('sem_sbject_id', $get_semester->sem_sub_id)
                        ->order_by('section', 'asc')
                        ->get('semester_subject_list')
                        ->result();
                foreach ($get_section as $value) {
                    ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Section: <?= $value->section ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL No.</th>
                                                <th>Course Code</th>
                                                <th>Course Title</th>
                                                <th>Credit Hour</th>
                                                <th>Assign Teacher</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $get_subjects = $this->db->join('subjects', 'subjects.sub_id = semester_subject_list.subject_id')->where('section', $value->section)->get('semester_subject_list')->result();
                                            $i = 1;
                                            foreach ($get_subjects as $subject) {
                                                ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $subject->course_code ?></td>
                                                    <td><?= $subject->course_title ?></td>
                                                    <td><?= $subject->credit_hour ?></td>
                                                    <td>
                                                        <input type="hidden" name="subject_id[]" value="<?= $subject->sub_id ?>">
                                                        <select name="teacher_id[]" class="form-control mb-3">
                                                            <option value="">Select Teacher</option>
                                                            <?php foreach (get_teachers() as $teacher) { ?>
                                                                <option value="<?= $teacher->ts_id ?>"><?= $teacher->name ?> => <?= $teacher->department ?> => <?= $teacher->program ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <input type="hidden" name="section[]" value="<?= $subject->section ?>">
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
                <div style="text-align: center">
                    <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-primary" style="border-radius: 10px;"><i class="fa fa-save"></i> Save</button>
                </div> 
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#subject_teachers').addClass('activemenu');
    });
</script>
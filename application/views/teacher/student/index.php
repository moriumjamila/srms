<div class="box-card mb-4">
    <h3><?= $title ?></h3>
</div>
<div class="box-card">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped getTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Credit</th>
                            <th>Department</th>
                            <th>Session</th>
                            <th>Program</th>
                            <th>Semester</th>
                            <th>Section</th>
                            <th>Students</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($subject_students as $value) {
                            $result = $this->db->where('subject_id', $value->subject_id)->get('semester_registrations')->num_rows();
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $value->course_code ?></td>
                                <td><?= $value->course_title ?></td>
                                <td><?= $value->credit_hour ?></td>
                                <td><?= $value->department ?></td>
                                <td><?= $value->session ?></td>
                                <td><?= $value->program ?></td>
                                <td><?= $value->semester ?></td>
                                <td><?= $value->section ?></td>
                                <td><span style="background: #0d6efd;padding:10px;color:#fff"><?=$result ?></span></td>
                                <td>
                                    <a href="<?= base_url('view_subject_students/'.$value->subt_id)?>" class="btn btn-primary add_data" id="<?= $value->subt_id ?>" style="border-radius:20px!important;"><i class="fa fa-eye"></i></a>
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
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#subject_students').addClass('activemenu');
    });
</script>
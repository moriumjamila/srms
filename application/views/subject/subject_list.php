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
                            <th>Department</th>
                            <th>Program</th>
                            <th>Session</th>
                            <th>Semester</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($get_semesters as $value) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $value->department ?></td>
                                <td><?= $value->program ?></td>
                                <td><?= $value->session ?></td>
                                <td><?= $value->semester ?></td>
                                <td>
                                    <a href="<?= base_url('assign_subject_wise_teacher/' . $value->sem_sub_id) ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-eye"></i></a>
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
        $('#subject_teachers').addClass('activemenu');
    });
</script>
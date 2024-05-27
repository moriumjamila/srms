<div class="box-card mb-4">
    <h3><?= $title ?></h3>
    <button type="button" onclick="window.location = '<?= base_url('make_semester_result.php') ?>'" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-primary"><i class="fa fa-plus"></i> Make Result</button>
</div>
<div class="box-card">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped getTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Program</th>
                            <th>Session</th>
                            <th>Semester</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($results as $value) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $value->id_no ?></td>
                                <td><?= $value->name ?></td>
                                <td><?= $value->department ?> <?= $value->program ?></td>
                                <td><?= $value->session ?></td>
                                <td><?= $value->semester_no ?></td>
                                <td>
                                    <a href="<?= base_url('view_result_status_information/' . $value->stu_result_id.'/'.$value->student_id) ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-eye"></i></a>
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
        $('#result_information').addClass('activemenu');
    });
</script>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($get_subjects as $value) {
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
                                <td>
                                    <button type="button" class="btn btn-primary add_data" id="<?= $value->subt_id ?>" style="border-radius:20px!important;"><i class="fa fa-cubes"></i></button>
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
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Subject Wise Teacher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="get" action="<?= base_url('make_subject_result') ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="sub_id" id="set_data_id">
                                <select name="type" class="form-control" required="">
                                    <option value="">Result For</option>
                                    <option value="Mid">Mid</option>
                                    <option value="Final">Final</option>
                                </select>
                            </div> 
                        </div>
                    </div><br>
                    <div style="text-align: center">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close" style="border-radius: 10px;"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary" style="border-radius: 10px;"><i class="fa fa-send-o"></i> Next</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('body').on('click', '.add_data', function () {
            $("#set_data_id").val($(this).attr('id'));
            $("#addModal").modal('show');
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#subject_result').addClass('activemenu');
    });
</script>
<div class="box-card mb-4">
    <h3><?= $title ?></h3>
    <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-whatever="@mdo" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-primary"><i class="fa fa-plus"></i> Add Subject</button>
</div>
<div class="box-card">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped getTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Credit Hour</th>
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
                                <td>
                                    <button type="button" class="btn btn-primary edit_data" id="<?= $value->sub_id ?>" style="border-radius:20px!important;"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger delete_data" id="<?= $value->sub_id ?>" style="border-radius:20px!important;"><i class="fa fa-trash"></i></button>
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
                <h5 class="modal-title" id="exampleModalLabel">Add New Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('subjct/save') ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Course Code :<span style="color: red">*</span></label>
                            <div class="form-group">
                                <input type="text" name="course_code" class="form-control inputnumber" placeholder="Course Code" required="">
                            </div> 
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Course Title :<span style="color: red">*</span></label>
                            <div class="form-group">
                                <input type="text" name="course_title" class="form-control inputnumber" placeholder="Course Title" required="">
                            </div> 
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Credit Hour :<span style="color: red">*</span></label>
                            <div class="form-group">
                                <input type="text" name="credit_hour" class="form-control inputnumber" placeholder="Credit Hour" required="">
                            </div> 
                        </div>
                    </div><br>
                    <div style="text-align: center">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close" style="border-radius: 10px;"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-primary" style="border-radius: 10px;"><i class="fa fa-save"></i> Save</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('subjct/update') ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="data_id" id="set_data_id">

                            <label>Course Code :<span style="color: red">*</span></label>
                            <div class="form-group">
                                <input type="text" name="course_code" id="set_course_code" class="form-control inputnumber" placeholder="Course Code" required="">
                            </div> 
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Course Title :<span style="color: red">*</span></label>
                            <div class="form-group">
                                <input type="text" name="course_title" id="set_course_title" class="form-control inputnumber" placeholder="Course Title" required="">
                            </div> 
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Credit Hour :<span style="color: red">*</span></label>
                            <div class="form-group">
                                <input type="text" name="credit_hour" id="set_credit_hour" class="form-control inputnumber" placeholder="Credit Hour" required="">
                            </div> 
                        </div>
                    </div><br>
                    <div style="text-align: center">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close" style="border-radius: 10px;"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-primary" style="border-radius: 10px;"><i class="fa fa-check-circle"></i> Update</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('body').on('click', '.edit_data', function () {
            var currow = $(this).closest("tr");
            $("#set_data_id").val($(this).attr('id'));
            $("#set_course_code").val(currow.find('td:eq(1)').html());
            $("#set_course_title").val(currow.find('td:eq(2)').html());
            $("#set_credit_hour").val(currow.find('td:eq(3)').html());
            $("#updateModal").modal('show');
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.delete_data', function () {
            var id = $(this).attr('id');
            swal({
                title: "Are you sure ?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    swal(window.location.href = "<?= base_url('subjct/delete/') ?>" + +id);
                } else {
                    swal("Cancelled");
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#settings').addClass('activemenu');
    });
</script>
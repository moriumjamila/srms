<button type="button" onclick="window.location = '<?= base_url('subject_teachers.php') ?>'" style="float:right;border-radius: 20px !important;" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Back</button>
<br><br>
<div class="box-card">
    <div class="box tableborder">
        <div class="box-body" style="position: relative">
            <div id="printarea">
                <div style="position:relative;top:10px">
                    <center>
                        <h2 style="font-family: Montserrat;font-weight: bold"><span style="border-bottom:2px solid #000"><?= $title ?></span></h2>
                    </center>
                </div><br>
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
                                                <th>Teacher</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($subject_teachers as $value) {
                                                ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $value->course_code ?></td>
                                                    <td><?= $value->course_title ?></td>
                                                    <td><?= $value->credit_hour ?></td>
                                                    <td><?= $value->name ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger delete_data" id="<?= $value->subt_id ?>" style="border-radius:20px!important;" title="Delete"><i class="fa fa-trash"></i></button>
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
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.delete_data', function () {
            var id = $(this).attr('id');
            var $redid = '<?= $data_id ?>';
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
                    swal(window.location.href = "<?= base_url('subjct/delete_subject_teacher/') ?>" + id + '/' + $redid);
                } else {
                    swal("Cancelled");
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#subject_teachers').addClass('activemenu');
    });
</script>
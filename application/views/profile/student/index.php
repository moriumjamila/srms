<div class="box-card">
    <div class="box tableborder">
        <div class="box-body" style="position: relative">
            <div id="printarea">
                <div style="color:#1c5fa8;">
                    <center>
                        <h3 style="font-family: Montserrat;font-weight: bold;">Student Result Management System</h3>
                    </center>
                </div><br>
                <div style="height:2px !important;background:#000 !important;position: relative;top:5px"></div>
                <div style="position:relative;top:10px">
                    <center>
                        <h4 style="font-family: Montserrat;font-size:14px;font-weight: bold">Student Profile Information</h4>
                    </center>
                </div><br>
                <table class="table table-bordered" style="">
                    <tr>
                        <td><span><b>Photo</b> :</span></td>
                        <?php
                        if (empty($myprofile->photo)) {
                            ?>
                            <td><img src='<?= base_url('public/img/noimage.jpg') ?>' style="width:100px;height:100px;" alt=""></td>
                        <?php } else { ?>
                            <td><img src='<?= base_url($myprofile->photo) ?>' style="width:100px;height:100px;" alt=""></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td><span><b>Name</b> :</span></td>
                        <td><span><?= $myprofile->name ?></span></td>
                    </tr>
                    <tr>
                        <td><span><b>ID Number</b> :</span></td>
                        <td><span><?= $myprofile->id_no ?></span></td>
                    </tr>
                    <tr>
                        <td><span><b>Contact Number</b> :</span></td>
                        <td><span><?= $myprofile->contact ?></span></td>
                    </tr>
                    <tr>
                        <td><span><b>Email Address</b> :</span></td>
                        <td><span><?= $myprofile->email ?></span></td>
                    </tr>
                    <tr>
                        <td><span><b>Father Name</b> :</span></td>
                        <td><span><?= $myprofile->father ?></span></td>
                    </tr>
                    <tr>
                        <td><span><b>Address</b> :</span></td>
                        <td><span><?= $myprofile->address ?></span></td>
                    </tr>
                    <tr>
                        <td><span><b>Department</b> :</span></td>
                        <td><span><?= $myprofile->department ?></span></td>
                    </tr>
                    <tr>
                        <td><span><b>Program</b> :</span></td>
                        <td><span><?= $myprofile->department ?> <?= $myprofile->program ?></span></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Session</th>
                                        <th>Semester</th>
                                        <th>Section</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($get_student_acads as $value) {
                                        ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $value->session ?></td>
                                            <td><?= $value->semester ?></td>
                                            <td><?= $value->section ?></td>
                                            <?php if ($value->status == 1) { ?>
                                                <td style="text-align: center"><span style="border-radius:10px;background: green !important;color: #fff;padding: 5px">Running</span></td>
                                            <?php } else { ?>
                                                <td style="text-align: center"><span style="border-radius:10px;background:gray !important;color: #fff;padding: 5px">Closed</span></td>
                                            <?php } ?>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <center>
                <a href="<?= base_url('edit_profile_information') ?>" class="btn btn-primary">Edit Info</a>
            </center>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#student_profile').addClass('activemenu');
    });
</script>
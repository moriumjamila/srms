<div class="box-card mb-4">
    <h3><?= $title ?></h3>
</div>
<div class="box-card">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Sub Menu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td>Departments</td>
                            <td>
                                <a href="<?= base_url('manage_departments.php') ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-tasks"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Programs</td>
                            <td>
                                <a href="<?= base_url('manage_programs.php') ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-tasks"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Sessions</td>
                            <td>
                                <a href="<?= base_url('manage_sessions.php') ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-tasks"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Subjects</td>
                            <td>
                                <a href="<?= base_url('manage_subjcts.php') ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-tasks"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Semesters</td>
                            <td>
                                <a href="<?= base_url('manage_semesters.php') ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-tasks"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Sections</td>
                            <td>
                                <a href="<?= base_url('manage_sections.php') ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-tasks"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Grades</td>
                            <td>
                                <a href="<?= base_url('view_grades.php') ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-tasks"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Admin User</td>
                            <td>
                                <a href="<?= base_url('admin_user.php') ?>" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-tasks"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="color:red">Clear Specific Data</td>
                            <td>
                                <button onclick="clear_specific_data()" class="btn btn-danger" style="border-radius:20px!important;"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function clear_specific_data() {
        if (confirm('Are you sure to delete ?')) {
            window.location.href='<?= base_url('clear_specific_data')?>';
        }
    }

    $(document).ready(function () {
        $('#settings').addClass('activemenu');
    });
</script>
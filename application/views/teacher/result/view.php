<div class="box-card mb-4">
    <h3>View Student's Results By Search</h3>
</div>
<div class="box-card">
    <form method="get" action="<?= base_url('search_student_result') ?>">
        <div class="row">
            <div class="col-md-3">
                <select name="department" class="form-control" required="">
                    <option value="">Select Department</option>
                    <?php foreach (get_departments() as $value) { ?>
                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <select name="program" class="form-control" required="">
                    <option value="">Select Program</option>
                    <?php foreach (get_programs() as $value) { ?>
                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <select name="session" class="form-control" required="">
                    <option value="">Select Session</option>
                    <?php foreach (get_sessions() as $value) { ?>
                        <option value="<?= $value->name ?>-<?= date('Y') ?>"><?= $value->name ?>-<?= date('Y') ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <select name="semester" class="form-control" required="">
                    <option value="">Select semester</option>
                    <?php foreach (get_semesters() as $value) { ?>
                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-3">
                <select name="section" class="form-control" required="">
                    <option value="">Select Section</option>
                    <?php foreach (get_sections() as $value) { ?>
                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <select name="type" class="form-control" required="">
                    <option value="">Select Type</option>
                    <!--<option value="All">All</option>-->
                    <option value="Mid">Mid</option>
                    <option value="Final">Final</option>
                </select>
            </div>
        </div>
        <br>
        <center>
            <button type="submit" class="btn btn-primary" style="border-radius:20px"><i class="fa fa-search"></i> Search</button>
        </center> 
    </form>
</div>
<script>
    $(document).ready(function () {
        $('#view_result').addClass('activemenu');
    });
</script>
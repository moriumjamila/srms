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
                            <th>Total Section</th>
                            <th>Total Subject</th>
                            <th>Total Teacher</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($get_semesters as $value) {
                            $total_teacher = $this->db->where('assign_from', $value->sem_sub_id)->get('subject_teachers')->num_rows();
                            $total_section = $this->db->select('section')->distinct()->where('sem_sbject_id', $value->sem_sub_id)->get('semester_subject_list')->num_rows();
                            $total_subject = $this->db->select('subject_id')->where('sem_sbject_id', $value->sem_sub_id)->get('semester_subject_list')->num_rows();
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $value->department ?></td>
                                <td><?= $value->program ?></td>
                                <td><?= $value->session ?></td>
                                <td><?= $value->semester ?></td>
                                <td style="text-align:center"><?= $total_section ?></td>
                                <td style="text-align:center"><?= $total_subject ?></td>
                                <td style="text-align:center"><?= $total_teacher ?></td>
                                <td>
                                    <a href="<?= base_url('assign_subject_wise_teacher/' . $value->sem_sub_id) ?>" class="btn btn-primary" style="border-radius:20px!important;" title="Assign Teacher"><i class="fa fa-plus"></i></a>
                                    <a href="<?= base_url('view_subject_wise_teachers/' . $value->sem_sub_id) ?>" class="btn btn-primary" style="border-radius:20px!important;" title="View Teachers"><i class="fa fa-eye"></i></a>
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
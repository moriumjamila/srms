<div class="box-card mb-4">
    <h3><?= $title ?></h3>
</div>
<div class="box-card">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Letter</th>
                            <th>Point</th>
                            <th>Credit Hour</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($get_grades as $value) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $value->letter ?></td>
                                <td><?= $value->point ?></td>
                                <td><?= $value->scroes ?></td>
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
        $('#settings').addClass('activemenu');
    });
</script>
<div class="box-card mb-4">
    <h3>Teacher's Profile</h3>
    <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" style="float: right;margin-top: -35px;border-radius: 20px !important;" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
</div>
<div class="box-card">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped getTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Donna Snider</td>
                            <td>Customer Support</td>
                            <td>New York</td>
                            <td>27</td>
                            <td>2011-01-25</td>
                            <td>
                                <a href="#" class="btn btn-primary" style="border-radius:20px!important;"><i class="fa fa-eye"></i></a>
                                <a href="#" class="btn btn-info" style="border-radius:20px!important;"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="btn btn-danger" style="border-radius:20px!important;"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content tableborder">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center">Add Setting Data</h3>
            </div>
            <div class="modal-body">
                <form method="POST" action="#">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Data Type <span style="color: red">*</span></label>
                            <select name="data_type" class="form-control inputnumber">
                                <option value="" selected="" disabled="">Select Type</option>
                                <option value="department">Department</option>
                                <option value="semester">Semester</option>
                            </select> 
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Upload Gallery Image <span style="color: red">*</span></label>
                            <span><b>(Size will be: 800*800px)</b></span>
                            <input type="file" name="image" onchange="getimageData(this);" class="form-control inputnumber">
                            <div class="text-danger" id="required_gallery_image"></div>
                        </div>
                    </div><br>
                    <div style="text-align: center">
                        <button type="button" class="btn btn-warning" data-dismiss="modal" style="border-radius: 10px;"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" id="submeetButton" class="btn btn-success make_form_submit" style="border-radius: 10px;"><i class="fa fa-save"></i> Save</button>
                    </div>     
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#settingsActive').addClass('activemenu');
    });
</script>
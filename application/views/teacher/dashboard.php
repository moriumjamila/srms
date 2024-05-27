<style>
    .box_card{
        background: #fff;
        padding: 20px;
        border-radius: 4px !important;
        border: none;
        font-weight: 400;
    }
    .box_card i{
        font-size: 160px !important;
    }
    .box_card span{
        font-size: 20px !important;
    }
</style>
<div class="row g-4">
    <div class="col-sm-6 col-lg-4 col-xxl-3">
        <div class="card box_card"> <a href="#" class="d-flex flex-column text-center gap-2"> <i class="fa-solid fa-users"></i> <span>Student List</span> </a> </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xxl-3">
        <div class="card box_card"> <a href="#" class="d-flex flex-column text-center gap-2"> <i class="fa fa-pencil"></i> <span>Result Information</span> </a> </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#teacher_list').addClass('activemenu');
    });
</script>
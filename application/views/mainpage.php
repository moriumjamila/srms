<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="<?= base_url('/') ?>public/favicon.ico">
        <title><?= $title ?> || NUB Teacher Portal</title>
        <link href="<?= base_url('/') ?>public/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link href="<?= base_url('/') ?>public/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?= base_url('/') ?>public/css/tagmanager.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('/') ?>public/css/sweetalert.css">
        <link rel="stylesheet" href="<?= base_url('/') ?>public/css/select2.min.css">
        <link href="<?= base_url('/') ?>public/css/style.css" rel="stylesheet">
        <style>
            .activemenu{
                background-color: #3eacff;
                color: #fff;
            }
            .big{
                width:1.5em;
                height:1.5em;
                cursor: pointer;
            }
            #postloader {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                width: 100%;
                background: rgba(0,0,0,0.75) url("{{asset('/')}}public/images/loader.gif") no-repeat center center;
                z-index: 99999;
            }
            .table td, .table th {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
                /*                color: #444;
                                font-weight: 400;*/
            }
            .blink {
                animation: blinker 1.8s linear infinite;
                /*        color: #1c87c9;*/
                font-size:15px;
                font-weight: bold;
                font-family: sans-serif;
            }
            @keyframes blinker {
                50% {
                    opacity: 0;
                }
            }
            .modal.fade {
                z-index: 10000000 !important;
            }
        </style>
        <script src="<?= base_url('/') ?>public/js/jquery-3.6.3.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div class="content-wrapper">
                <div class="top-navigation">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid no-padding pe-4">
                            <div id="aside-toggler" class="bars pull-left"> <i class="fa fa-bars"></i> </div>
                            <ul class="parent-ul pull-right d-flex gap-3 align-items-center">
                                <?php
                                if ($this->session->userdata('role') == 1) {
                                    ?>
                                    <li class="parent-li">
                                        <a href="<?= base_url('semester_registrations.php') ?>" class="parent-a"> <i class="fa-solid fa-bell"></i><span style=" color: red;position: relative;bottom: 8px;right: 3px;font-weight: bold" id="allNoti"></span></a>
                                    </li>
                                    <li class="parent-li">
                                        <a href="<?= base_url('semester_result_information.php') ?>" class="parent-a"> <i class="fa-solid fa-certificate"></i><span style=" color: red;position: relative;bottom: 8px;right: 3px;font-weight: bold" id="allNoti2"></span></a>
                                    </li>
                                <?php } ?>
                                <li class="parent-li">
                                    <a href="javascript:void(0)" class="user_thumb">
                                        <img src="<?= base_url('/') ?><?= get_user_avatar() ?>" alt="img"> 
                                    </a> 
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <style>
                    table thead tr th {
                        font-weight: 600;
                    }
                </style>
                <aside>
                    <div class="fixed-sidebar" id="according"> <a href="javascript:void(0)" class="logo"><img src="<?= base_url('/') ?>public/img/icon.png" alt=""> <span>NUB PORTAL</span></a>
                        <ul class="nav admin mt-4">
                            <?php $this->load->view('menu') ?>
                        </ul>
                        <ul class="nav mt-5">
                            <li class="parent-li"> <a href="<?= base_url('logout.php') ?>" class="parent-a"> <i class="fa fa-sign-out"></i> Log Out </a> </li>
                        </ul>
                    </div>
                </aside>
                <div class="main_page">
                    <div class="content-area">
                        <div class="container-fluid">
                            <?= $maincontent ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= base_url('/') ?>public/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url('/') ?>public/js/tagmanager.js"></script>
        <script src="<?= base_url('/') ?>public/js/main.js"></script>
        <script src="<?= base_url('/') ?>public/js/sweetalert.min.js"></script>
        <script src="<?= base_url('/') ?>public/js/select2.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
        </script>
        <?php
        if ($this->session->userdata('role') == 1) {
            ?>
            <script>
                window.onload = function () {
                    getallnotification();
                    getresultnotification();
                };
                function getallnotification() {
                    $.ajax({
                        type: "GET",
                        url: "<?= base_url('admin/get_reg_notification') ?>",
                        success: function (data) {
                            $('#allNoti').html(data);
                        }
                    });
                }
                function getresultnotification() {
                    $.ajax({
                        type: "GET",
                        url: "<?= base_url('admin/get_result_notification') ?>",
                        success: function (data) {
                            $('#allNoti2').html(data);
                        }
                    });
                }
            </script>
        <?php } ?>
        <script>
            $(function () {
                $('.getTable').DataTable();
                $('.allTable').DataTable({
                    "paging": false,
                    "ordering": false,
                    "info": false
                });
                $('.getSelect').select2();
            });
            $(document).ready(function () {
                $('form').attr('autocomplete', 'off');
            });
        </script>
        <script type="text/javascript">
<?php if ($this->session->flashdata('success')) { ?>
                toastr.success("<?php echo $this->session->flashdata('success') ?>");
<?php } ?>
<?php if ($this->session->flashdata('error')) { ?>
                toastr.error("<?php echo $this->session->flashdata('error') ?>");
<?php } ?>
        </script>
        <script>
            function numberOnly(id) {
                var element = document.getElementById(id);
                var regex = /[^0-9]/gi;
                element.value = element.value.replace(regex, "");
            }
        </script>
    </body>
</html>
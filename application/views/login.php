<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>NUB ERP || Login</title>
        <link rel="shortcut icon" href="<?= base_url('/') ?>public/favicon.ico" type="image/x-icon"/>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>
        <link rel="stylesheet" href="<?= base_url('/') ?>public/login/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?= base_url('/') ?>public/login/css/style.css"/>
        <link rel="stylesheet" href="<?= base_url('/') ?>public/login/css/custom.css"/>
        <script src='https://www.google.com/recaptcha/api.js'></script>

    </head>
    <body oncontextmenu="return false">
        <div class="preloader preloader-dark">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div id="main-wrapper" class="oxyy-login-register">
            <div class="container">
                <div class="row no-gutters min-vh-1001 py-5">
                    <div class="col-lg-6 shadow-lg left_side" style="background-image:url(<?= base_url('/') ?>public/img/bgimage_two.png);">
                        <div class="hero-wrap d-flex align-items-center rounded-lg rounded-right-0 h-100">
                            <div class="hero-mask opacity-9 bg-primary"></div>
                            <div class="hero-bg hero-bg-scroll"></div>
                            <div class="hero-content mx-auto w-100 h-100 d-flex flex-column">
                                <div class="row no-gutters">
                                    <div class="col-10 col-lg-10 mx-auto">
                                        <div class="logo mt-5 mb-5 mb-lg-0">
                                            <h1 class="text-white">Hello,</h1>
                                            <h1 style="font-weight: 800;" class="text-white">Welcome!</h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters my-auto">
                                    <div class="col-10 col-lg-10 mx-auto">
                                        <a href="javascript:void(0)"><img src="<?= base_url('/') ?>public/img/logo.png" class="logo_image" alt=""/></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 shadow-lg d-flex align-items-center rounded-lg rounded-left-0 bg-dark">
                        <div class="container my-auto py-5">
                            <div class="row">
                                <div class="col-11 col-lg-10 mx-auto">
                                    <h4 class="text-center mb-4">Student Result Management System (SRMS)</h4>
                                    <form action="<?= base_url('authenticateuser') ?>" method="post" name="loginForm" class="form-dark" id="loginForm" >
                                        <div class="form-group">
                                            <input type="text" class="form-control"  id="username" name="username" required placeholder="Enter Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="loginPassword" name="password" required placeholder="Enter Password">
                                        </div>
                                        <!--                                        <div class="row">
                                                                                    <div class="col-sm">
                                                                                        <div class="form-check custom-control custom-checkbox">
                                                                                            <input id="remember-me" name="remember" class="custom-control-input1" type="checkbox">
                                                                                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm text-2 text-right">
                                                                                        <a href="#" class="btn-link">Forgot Password ?</a>
                                                                                    </div>
                                                                                </div>-->
                                        <div class="form-group">
                                            <!-------- Local Host---------->
                                            <div class="g-recaptcha" data-sitekey="6LeNcsYpAAAAAM_slM6fBilNxzkIYQQuY7hBnQnC"></div>
                                            <!-------- Live Host---------->
                                            <!--<div class="g-recaptcha" data-sitekey="6LfNc8YpAAAAAMFqD2GfeMf7M7uYl01VebAZa3we"></div>-->
                                        </div>
                                        <button class="btn btn-primary btn-block my-4 to-disable" type="submit"><i class="fa fa-sign"></i>Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body" style="border: 5px solid #3c8dbc">
                        <?php
                        $message = $this->session->flashdata('message');
                        if (isset($message)) {
                            echo $message;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= base_url('/') ?>public/login/js/jquery.min.js" type="text/javascript" ></script>
        <script src="<?= base_url('/') ?>public/login/js/bootstrap.bundle.min.js" type="text/javascript" ></script>
        <script src="<?= base_url('/') ?>public/login/js/theme.js" type="text/javascript" ></script>
        <script>
        </script>
        <?php
        $message2 = $this->session->flashdata('message');
        if (isset($message2)) {
            ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    $("#message").modal("show");
                    setTimeout(function () {
                        $('#message').modal('hide');
                    }, 4000);
                });
            </script>
        <?php } ?>
        <script>
            document.onkeydown = function (e) {
                if (e.ctrlKey &&
                        (e.keyCode === 85)) {
                    return false;
                }
            };
        </script>
    </body>
</html>

















